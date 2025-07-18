<x-app-layout>
    <div class="w-full h-16 bg-slate-100 px-3 py-2">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center">
                <div>
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'buat_absen' }))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </button>
                </div>
                <div class="ml-5">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex justify-end items-center">
                <div class="flex justify-center items-center">
                    <input type="text" id="searchInput" class="rounded-lg py-2.5 focus:border-blue-500 hover:bg-slate-200 shadow-none border-gray-300" placeholder="cari">
                </div>
            </div>
        </div>
    </div>

    <div class="w-full md:block overflow-y-scroll hidden max-h-[470px]">
        <table class="table-auto" id="data_absen">
            <thead class="bg-gray-100 sticky top-0">
            <tr>
                <th class="px-3 py-2 font-medium border">No</th>
                <th class="px-3 py-2 font-medium border">NIS</th>
                <th class="px-3 py-2 font-medium border">Nama Lengkap</th>
                <th class="px-3 py-2 font-medium border">Hari, Tanggal</th>
                <th class="px-3 py-2 font-medium border">Kelas</th>
                <th class="px-3 py-2 font-medium border">Status</th>
                <th class="px-3 py-2 font-medium border">Keterangan</th>
                <th class="px-3 py-2 font-medium border">Aksi</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            @php
                $no = 1;
            @endphp
            @foreach ($data_absen as $absen)
                <tr>
                    <td class="px-3 py-2 border">{{$no++}}</td>
                    <td class="px-3 py-2 border">{{$absen->nis}}</td>
                    <td class="px-3 py-2 border">{{$absen->nama}}</td>
                    <td class="px-3 py-2 border">{{$absen->hari}}, {{$absen->tanggal}}</td>
                    <td class="px-3 py-2 border">{{$absen->kelas}}</td>
                    <td class="px-3 py-2 border">{{$absen->status}}</td>
                    <td class="px-3 py-2 border">{{$absen->keterangan}}</td>
                    <td class="px-3 py-2 border">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{route('update_data_kelas', $absen->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="{{route('deleted_data_kelas', $absen->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            <!-- Duplikasikan baris di atas sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
    <div id="data_kelas" class="md:hidden block overflow-auto h-[650px] p-3">
        @foreach ($data_absen as $absensi)
            <div class="grid grid-cols-5 gap-0 justify-center items-start bg-white rounded-lg p-1 mb-1">
                <div class="flex justify-center items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <div class="col-span-4">
                    <div class="grid grid-cols-[auto_min-content_1fr] gap-x-2 text-sm w-full max-w-md">
                        <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                            <div class="w-1/3 font-medium">NIS</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">{{$absensi->nis}}</div>
                        </div>


                        <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                            <div class="w-1/3 font-medium">Nama</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">{{$absensi->nama}}</div>
                        </div>

                        <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                            <div class="w-1/3 font-medium">Kelas</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">
                                 {{$absensi->kelas}}
                            </div>
                        </div>
                        <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                            <div class="w-1/3 font-medium">Hari</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">
                                 {{$absensi->hari}}
                            </div>
                        </div>
                        <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                            <div class="w-1/3 font-medium">Tanggal</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">
                                 {{$absensi->tanggal}}
                            </div>
                        </div>
                        <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                            <div class="w-1/3 font-medium">Status</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">
                                 {{$absensi->status}}
                            </div>
                        </div>
                        <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                            <div class="w-1/3 font-medium">Keterangan</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">
                                 {{$absensi->keterangan}}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <div>
                            <a href="{{route('deleted_data_kelas', $absensi->id)}}" class="py-0.5 px-1.5 text-xs bg-red-400 hover:bg-red-500 rounded">Delete</a>
                        </div>
                        <div class="ml-2">
                            <a href="{{route('update_data_kelas', $absensi->id)}}" class="py-0.5 px-1.5 text-xs bg-blue-400 hover:bg-blue-500 rounded">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
     <!-- Modal Insert -->
     @php
                            //misal url yang di dapat
        if($update_absen == null){
            $url = 'guru/update/data/kelas';
        }else{
            $url = url("guru/update/data/kelas/$update_absen->id");
        }
         $ambil_url = url()->current();
         if($ambil_url == $url) {
            $show = true;
            $action = route('updated_data_kelas', $update_absen->id);
            $method = method_field('patch'); 
            $id = $update_absen->id;
            $nis = $update_absen->nis;
            $nama = $update_absen->nama;
            $kelas = $update_absen->kelas;
            $guru = $update_absen->guru;
            $jenis_absen = $update_absen->jenis_absen;
            $hari = $update_absen->hari;
            $tanggal = $update_absen->tanggal;
            $status = $update_absen->status;
            $keterangan = $update_absen->keterangan;
         }else{
            $show = false;
            $action = route('create_data_kelas');
            $method = "";
            $id = '';
            $nis = '';
            $nama = '';
            $kelas = '';
            $guru = '';
            $jenis_absen = '';
            $hari = '';
            $tanggal = '';
            $status = '';
            $keterangan = '';
         }
         
     @endphp
    <x-modal name="buat_absen" :show="$show" max-width="lg">
        <form method="POST" action="{{$action}}">
            @csrf
            {{$method}}
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                    Data Absen
                </h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">NIS</label>
                    <input type="text" name="nis" value="{{$nis}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Nama</label>
                    <input type="text" disabled name="nama" value="{{$nama}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <select name="status" class="form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                        <option value="{{$status}}">{{$status}}</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpa">Alpa</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Tanggal</label>
                    <input type="date" name="tanggal" value="{{$tanggal}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Jumlah Siswi</label>
                    <textarea name="keterangan" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                        {{$keterangan}}
                    </textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'buat_absen' }))" class="mr-2 px-4 py-2 border rounded">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </x-modal>
</x-app-layout>

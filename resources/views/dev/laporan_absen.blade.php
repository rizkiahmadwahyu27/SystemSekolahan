<x-app-layout>
    <div class="w-full h-16 bg-slate-100 px-3 py-2">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center mr-2">
                <div class="ml-5">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                    </button>
                </div>
                <div class="ml-5">
                    <a href="{{route('laporan_bulanan_siswa')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                    </a>
                </div>
                @if (Auth::user()->level != 'siswa')
                    <div class="ml-5">
                        <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'filter_absen' }))">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
            <div class="flex justify-end items-center">
                <div class="flex justify-center items-center">
                    <input type="text" id="searchInput" class="rounded-lg w-full py-1.5 md:py-2.5 focus:border-blue-500 hover:bg-slate-200 shadow-none border-gray-300" placeholder="cari">
                </div>
            </div>
        </div>
    </div>

    <div class="w-full overflow-y-scroll md:block hidden max-h-[470px]">
        <table class="table-auto" id="lapAbsenSiswa">
            <thead class="bg-gray-100 sticky top-0">
            <tr>
                <th class="px-3 py-2 font-medium border">No</th>
                <th class="px-3 py-2 font-medium border">NIS</th>
                <th class="px-3 py-2 font-medium border">Nama</th>
                <th class="px-3 py-2 font-medium border">Nama Guru</th>
                <th class="px-3 py-2 font-medium border">Kelas</th>
                <th class="px-3 py-2 font-medium border">Jenis Absen</th>
                <th class="px-3 py-2 font-medium border">Hari</th>
                <th class="px-3 py-2 font-medium border">Tanggal</th>
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
                    <td class="px-3 py-2 border">{{$absen->guru}}</td>
                    <td class="px-3 py-2 border">{{$absen->kelas}}</td>
                    <td class="px-3 py-2 border">{{$absen->jenis_absen}}</td>
                    <td class="px-3 py-2 border">{{$absen->hari}}</td>
                    <td class="px-3 py-2 border">{{$absen->tanggal}}</td>
                    <td class="px-3 py-2 border">{{$absen->status}}</td>
                    <td class="px-3 py-2 border">{{$absen->keterangan}}</td>
                    <td class="px-3 py-2 border">
                        @if (Auth::user()->level != 'siswa')
                            <div class="flex justify-between items-center">
                                <div>
                                    <a href="{{route('update_data_absen_siswa', $absen->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" onclick="confirmRedirectDelete('{{route('deleted_data_absen_siswa', $absen->id)}}'); return false;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            <!-- Duplikasikan baris di atas sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
    <div id="lapAbsenSiswa" class="md:hidden block overflow-auto h-[650px]">
        @foreach ($data_absen as $absen)
            <div class="w-full rounded-lg bg-white p-1 mb-1">
                <div class="flex justify-center items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <div class="grid grid-cols-[auto_min-content_1fr] gap-x-2 text-sm w-full max-w-md">
                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">NIS</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$absen->nis}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Nama</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$absen->nama}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Nama Guru</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$absen->guru}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Kelas</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$absen->kelas}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Jenis Absen</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$absen->jenis_absen}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Hari, Tanggal</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$absen->hari}}, {{ $absen->tanggal }}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Keterangan</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">
                            {{$absen->keterangan}}
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    @if (Auth::user()->level != 'siswa')
                        <div>
                            <a href="#" onclick="confirmRedirectDelete('{{route('deleted_data_absen_siswa', $absen->id)}}'); return false;"  class="py-0.5 px-1.5 text-xs bg-red-400 hover:bg-red-500 rounded">Delete</a>
                        </div>
                        <div class="ml-2">
                            <a href="{{route('update_data_absen_siswa', $absen->id)}}" class="py-0.5 px-1.5 text-xs bg-blue-400 hover:bg-blue-500 rounded">Update</a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @php
                            //misal url yang di dapat
        if($update_absen == null){
            $url = '/laporan/data/absen/siswa';
        }else{
            $url = url("/update/data/absen/siswa/$update_absen->id");
        }
         $ambil_url = url()->current();
         if($ambil_url == $url) {
            if (Auth::user()->level == 'siswa') {
                $show = false;
                $show1 = false;
            } else {
                 $show = false;
                $show1 = true;
            }
            
            $action = route('updated_data_absen', $update_absen->id);
            $method = method_field('patch'); 
            $id = $update_absen->id;
            $nis = $update_absen->nis;
            $nama = $update_absen->nama;
            $kelas = $update_absen->kelas;
            $guruku = $update_absen->guru;
            $jenis_absen = $update_absen->jenis_absen;
            $hari = $update_absen->hari;
            $tanggal = $update_absen->tanggal;
            $status = $update_absen->status;
            $keterangan = $update_absen->keterangan;
         }else{
            
            if (Auth::user()->level == 'siswa') {
                $show = false;
                $show1 = false;
            } else {
                $show = true;
                $show1 = false;
            }
            $action = '';
            $method = ''; 
            $id = '';
            $nis = '';
            $nama = '';
            $kelas = '';
            $guruku = '';
            $jenis_absen = '';
            $hari = '';
            $tanggal = '';
            $status = '';
            $keterangan = '';
         }
         
     @endphp
    <x-modal name="filter_absen" :show="$show" max-width="lg">
        <form method="POST" action="{{route('filter_absen_siswa')}}">
            @csrf
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Filter Absen Siswa
                </h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Pilih Kelas</label>
                    <select name="kelas" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        @foreach ($data_kelas as $d_kelas)
                            <option value="{{$d_kelas->nama_kelas}}">{{$d_kelas->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Nama Guru</label>
                    <select name="nama_guru" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        @if (Auth::user()->level == 'guru')
                            <option value="{{$data_guru->nama_pegawai}}">{{$data_guru->nama_pegawai}}</option>
                        @else
                            @foreach ($data_guru as $guru)
                                <option value="{{$guru->nama_pegawai}}">{{$guru->nama_pegawai}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                 <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Pilih Mata Pelajaran</label>
                    <select name="mapel" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        @foreach ($mapel_pegawai as $mapel)
                            @foreach ($mapel->mapel as $m)
                                <option value="{{$m}}">{{$m}}</option>
                            @endforeach
                        @endforeach
                    </select> 
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Jenis Absen</label>
                    <select name="jenis_absen" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        <option value="harian">Harian</option>
                        <option value="mapel">Mapel</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Dari Tanggal</label>
                    <input type="date" name="tgl1" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Sampai Tanggal</label>
                    <input type="date" name="tgl2" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
               
                <div class="mt-6 flex justify-end">
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'filter_absen' }))" class="mr-2 px-4 py-2 border rounded">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </x-modal>
    <x-modal name="update_absen_siswa" :show="$show1" max-width="lg">
        <form method="POST" action="{{ $action }}">
            @csrf
            {{ $method }}
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Update Absen Siswa
                </h2>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Nama Siswa</label>
                    <input type="text" name="nama" value="{{ $nama }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                    <input type="hidden" name="nis" value="{{ $nis }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                    <input type="hidden" name="hari" value="{{ $hari }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                    <input type="hidden" name="guru" value="{{ $guruku }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Pilih Kelas</label>
                    <select name="kelas" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        <option value="{{$kelas}}">{{$kelas}}</option>
                        @foreach ($data_kelas as $d_kelas)
                            <option value="{{$d_kelas->nama_kelas}}">{{$d_kelas->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Jenis Absen</label>
                    <select name="jenis_absen" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        <option value="{{ $jenis_absen }}">{{ $jenis_absen }}</option>
                        <option value="harian">Harian</option>
                        <option value="mapel">Mapel</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Status</label>
                    <select name="status" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                        <option value="{{ $status }}">{{ $status }}</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Alpa">Alpa</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Izin">Izin</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ $keterangan }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-900">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $tanggal }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
               
                <div class="mt-6 flex justify-end">
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'update_absen_siswa' }))" class="mr-2 px-4 py-2 border rounded">
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
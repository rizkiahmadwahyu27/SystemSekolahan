<x-app-layout>
    <div class="w-full h-16 bg-slate-100 px-3 py-2">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center mr-2">
                <div>
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'buat_absen' }))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </button>
                </div>
                <div class="ml-5">
                    <a href="{{route('scan_barcode')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                    </a>
                </div>
                <div class="ml-5">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex justify-end items-center">
                <div class="flex justify-center items-center">
                    <input type="text" id="searchInput" class="rounded-lg w-full py-1.5 md:py-2.5 focus:border-blue-500 hover:bg-slate-200 shadow-none border-gray-300" placeholder="cari">
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
                <th class="px-3 py-2 font-medium border">Guru & Mapel</th>
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
                    <td class="px-3 py-2 border">{{$absen->guru}}</td>
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
            <div class="w-full rounded-lg bg-white p-1">
                <div class="flex justify-center items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
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
                        <div class="w-1/3 font-medium">Guru & Mapel</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">
                                {{$absensi->guru}}
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
        @endforeach
    </div>
     <!-- Modal Insert -->
     @php
                            //misal url yang di dapat
        if($update_absen == null){
            $url = 'guru/update/data/absen';
        }else{
            $url = url("guru/update/data/absen/$update_absen->id");
        }
         $ambil_url = url()->current();
         if($ambil_url == $url) {
            $show = true;
            $action = route('updated_data_absen', $update_absen->id);
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
            $action = route('create_data_absen');
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
    <x-modal name="buat_absen" :show="$show" max-width="4xl">
        <div class="flex justify-center items-center p-2">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">
                Data Absen
            </h2>
        </div>
        <div class="flex justify-between items-center p-2">
            <form action="{{route('get_absen')}}" method="post">
                @csrf
                <div class="flex justify-center items-center">
                    <div>
                        <select name="jenis_absen" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                            @if ($p_jenis == '')
                                <option>Pilih Jenis Absen</option>
                            @else
                                <option value="{{$p_jenis}}">{{$p_jenis}}</option>
                            @endif
                            <option value="harian">Harian</option>
                            <option value="mapel">Mapel</option>
                        </select> 
                    </div>
                    <div>
                        <select name="kelas" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                            @if ($p_kelas == '')
                                <option>Pilih Kelas</option>
                            @else
                                <option value="{{$p_kelas}}">{{$p_kelas}}</option>
                            @endif
                            @foreach ($data_kelas as $d_kelas)
                                <option value="{{$d_kelas->nama_kelas}}">{{$d_kelas->nama_kelas}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div>
                        <select name="guru" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                            @if ($p_guru == '')
                                <option>Pilih guru</option>
                            @else
                                <option value="{{$p_guru}}">{{$p_guru}}</option>
                            @endif
                            @foreach ($data_pegawai as $d_pegawai)
                                <option value="{{$d_pegawai->nama_pegawai}}">{{$d_pegawai->nama_pegawai}}</option>
                            @endforeach
                        </select> 
                    </div>
                    <div>
                        <select name="mapel" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                            @if ($p_mapel == '')
                                <option>Pilih mapel</option>
                            @else
                                <option value="{{$p_mapel}}">{{$p_mapel}}</option>
                            @endif
                            @foreach ($mapel_pegawai as $mapel)
                                @foreach ($mapel->mapel as $m)
                                    <option value="{{$m}}">{{$m}}</option>
                                @endforeach
                            @endforeach
                        </select> 
                    </div>   
                    <div>
                        <input type="date" name="tgl" value="{{$p_tgl}}" class="block w-full rounded border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <button type="submit" class="ml-2 py-2 px-4 bg-blue-600 text-white rounded">
                            Pilih
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <hr class="text-white mb-2">
        <form method="POST" action="{{route('create_data_absen')}}">
            @csrf
            {{-- {{$method}} --}}
            <div class="w-full md:block overflow-y-scroll hidden max-h-[470px]">
                <table class="table-auto" id="data_absen">
                    <thead class="bg-gray-100 sticky top-0">
                    <tr>
                        <th class="py-2 px-1 font-medium border">No</th>
                        <th class="py-2 px-1 font-medium border">NIS</th>
                        <th class="py-2 px-1 font-medium border">Nama Lengkap</th>
                        <th class="py-2 px-1 font-medium border">Status</th>
                        <th class="py-2 px-1 font-medium border">Keterangan</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($absen_siswa as $key => $siswa_absen)
                        <tr>
                            <td class="py-2 px-1 border">{{$no++}}</td>
                            <td class="py-2 px-1 border">{{$siswa_absen->nis}}
                                <input type="hidden" value="{{$siswa_absen->nis}}" name="nis[{{$key}}]" class="block w-full rounded border-gray-300 shadow-sm">
                            </td>
                            <td class="py-2 px-1 border">{{$siswa_absen->nama}}
                                <input type="hidden" value="{{$siswa_absen->nama}}" name="nama[{{$key}}]" class="block w-full rounded border-gray-300 shadow-sm">
                            </td>
                            <td class="py-2 px-1 border">
                                <select name="status[{{$key}}]" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                                    {{-- <option value="{{$agama}}">{{$agama}}</option> --}}
                                    <option value="Hadir">Hadir</option>
                                    <option value="Alpa">Alpa</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                    <input type="hidden" value="{{$p_kelas}}" name="s_kelas" class="block w-full rounded border-gray-300 shadow-sm">
                                    <input type="hidden" value="{{$p_guru}}" name="s_guru" class="block w-full rounded border-gray-300 shadow-sm">
                                    <input type="hidden" value="{{$p_mapel}}" name="s_mapel" class="block w-full rounded border-gray-300 shadow-sm">
                                    <input type="hidden" value="{{$p_tgl}}" name="s_tgl" class="block w-full rounded border-gray-300 shadow-sm">
                                    <input type="hidden" value="{{$p_jenis}}" name="s_jenis" class="block w-full rounded border-gray-300 shadow-sm">
                                </td>
                            <td class="py-2 px-1 border">
                                <input type="text" name="keterangan[{{$key}}]" class="block w-full rounded border-gray-300 shadow-sm" required placeholder="isi keterangan">
                            </td>
                        </tr>
                    @endforeach
                    <!-- Duplikasikan baris di atas sesuai kebutuhan -->
                    </tbody>
                </table>
            </div>
            <div>
                <button type="submit" class="ml-2 py-2 px-4 bg-blue-600 text-white rounded">
                    Save
                </button>
            </div>
        </form>
    </x-modal>
</x-app-layout>

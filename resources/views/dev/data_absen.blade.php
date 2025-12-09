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
    <!-- Modal Insert -->
     @php
                            //misal url yang di dapat
        if($update_absen == null){
            $url = '/update/data/absen';
        }else{
            $url = url("/update/data/absen/$update_absen->id");
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
    <form method="POST" action="{{route('create_data_absen')}}">
        @csrf
        {{-- {{$method}} --}}
        <div class="w-full overflow-y-scroll max-h-[470px]">
            <table class="table-auto" id="data_absen">
                <thead class="bg-gray-100 sticky top-0">
                <tr>
                    <th class="py-2 px-1 text-xs font-medium border">No</th>
                    <th class="py-2 px-1 text-xs font-medium border">NIS</th>
                    <th class="py-2 px-1 text-xs font-medium border">Nama Lengkap</th>
                    <th class="py-2 px-1 text-xs font-medium border">Status</th>
                    <th class="py-2 px-1 text-xs font-medium border">Keterangan</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @php
                    $no = 1;
                @endphp
                @foreach ($absen_siswa as $key => $siswa_absen)
                    <tr>
                        <td class="py-2 px-1 text-xs border">{{$no++}}</td>
                        <td class="py-2 px-1 text-xs border">{{$siswa_absen->nis}}
                            <input type="hidden" value="{{$siswa_absen->nis}}" name="nis[{{$key}}]" class="block w-full text-xs rounded border-gray-300 shadow-sm">
                        </td>
                        <td class="py-2 px-1 text-xs border">{{$siswa_absen->nama}}
                            <input type="hidden" value="{{$siswa_absen->nama}}" name="nama[{{$key}}]" class="block w-full text-xs rounded border-gray-300 shadow-sm">
                        </td>
                        <td class="py-2 px-1 text-xs border">
                            <select name="status[{{$key}}]" class="mt-1 text-xs block w-full rounded border-gray-300 shadow-sm" required>
                                <option value="hadir">Hadir</option>
                                <option value="alpa">Alpa</option>
                                <option value="sakit">Sakit</option>
                                <option value="izin">Izin</option>
                                <option value="dispen">Dispen</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                                <input type="hidden" value="{{$p_kelas}}" name="s_kelas" class="block w-full rounded border-gray-300 shadow-sm">
                                <input type="hidden" value="{{$p_guru}}" name="s_guru" class="block w-full rounded border-gray-300 shadow-sm">
                                <input type="hidden" value="{{$p_mapel}}" name="s_mapel" class="block w-full rounded border-gray-300 shadow-sm">
                                <input type="hidden" value="{{$p_tgl}}" name="s_tgl" class="block w-full rounded border-gray-300 shadow-sm">
                                <input type="hidden" value="{{$p_jenis}}" name="s_jenis" class="block w-full rounded border-gray-300 shadow-sm">
                            </td>
                        <td class="py-2 px-1 text-xs border">
                            <input type="text" name="keterangan[{{$key}}]" value="ada di kelas" class="block w-full text-xs rounded border-gray-300 shadow-sm" required placeholder="isi keterangan">
                        </td>
                    </tr>
                @endforeach
                <!-- Duplikasikan baris di atas sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
        <div>
            <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded">
                Save
            </button>
        </div>
    </form>
     
    <x-modal name="buat_absen" :show="$show" max-width="4xl">
        <div class="flex justify-center items-center p-2">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                Data Absen
            </h2>
        </div>
        <div class="w-full p-5">
            <form action="{{route('get_absen')}}" method="post">
                @csrf
                <div class="w-full">
                    <div class="w-full p-2 mb-2">
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
                    <div class="w-full p-2 mb-2">
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
                    <div class="w-full p-2 mb-2">
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
                    <div class="w-full p-2 mb-2">
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
                    <div class="w-full p-2 mb-2">
                        <input type="date" name="tgl" value="{{$p_tgl}}" class="block w-full rounded border-gray-300 shadow-sm">
                    </div>
                    <div class="p-2 mb-2">
                        <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded">
                            Pilih
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <hr class="text-white mb-2">
     
    </x-modal>
</x-app-layout>
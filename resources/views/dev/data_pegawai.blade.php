<x-app-layout>
   
    <div class="w-full h-16 bg-slate-100 px-3 py-2">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center mr-2">
                <div>
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'tambah_pegawai' }))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </button>
                </div>
                <div class="ml-5">
                    <a href="{{route('exportDataPegawai')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                    </a>
                </div>
                <div class="ml-5">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="flex justify-end items-center">
                <div class="flex justify-center items-center">
                    <input type="text" id="searchInput" class="rounded-lg w-full py-1.5 md:py-2.5 focus:border-blue-500 hover:bg-slate-200 shadow-none border-gray-300" placeholder="cari">
                </div>
            </div>
        </div>
    </div>

    <div class="w-full overflow-y-scroll md:block hidden max-h-[470px]">
        <table class="table-auto" id="data_pegawai">
            <thead class="bg-gray-100 sticky top-0">
            <tr>
                <th class="px-3 py-2 font-medium border">No</th>
                <th class="px-3 py-2 font-medium border">ID Pegawai</th>
                <th class="px-3 py-2 font-medium border">ID Pegawai Mutasi</th>
                <th class="px-3 py-2 font-medium border">NUPTK</th>
                <th class="px-3 py-2 font-medium border">NIP</th>
                <th class="px-3 py-2 font-medium border">Nama Lengkap</th>
                <th class="px-3 py-2 font-medium border">Jabatan</th>
                <th class="px-3 py-2 font-medium border">Tugas Tambahan</th>
                <th class="px-3 py-2 font-medium border">Mata Pelajaran</th>
                <th class="px-3 py-2 font-medium border">Alamat</th>
                <th class="px-3 py-2 font-medium border">Aksi</th>
            </tr>
            </thead>
            <tbody class="bg-white">
            @php
                $no = 1;
            @endphp
            @foreach ($data_pegawai as $pegawai)
                <tr>
                    <td class="px-3 py-2 border">{{$no++}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->id_pegawai}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->id_pegawai_mutasi}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->nuptk}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->nip}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->nama_pegawai}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->jabatan}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->tugas_tambahan}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->mata_pelajaran}}</td>
                    <td class="px-3 py-2 border">{{$pegawai->alamat}}</td>
                    <td class="px-3 py-2 border">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{route('update_data_pegawai', $pegawai->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="#" onclick="confirmRedirectDelete('{{ route('deleted_data_pegawai', $pegawai->id) }}'); return false;">
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
    <div id="data_pegawai" class="md:hidden block overflow-auto h-[650px] p-3">
        @foreach ($data_pegawai as $d_pegawai)
            <div class="w-full rounded-lg bg-white p-1">
                <div class="flex justify-center items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <div class="grid grid-cols-[auto_min-content_1fr] gap-x-2 text-sm w-full max-w-md">
                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">ID Pegawai</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$d_pegawai->id_pegawai}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">NUPTK</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$d_pegawai->nuptk}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">NIP</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$d_pegawai->nip}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Nama Lengkap</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$d_pegawai->nama_pegawai}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Jabatan</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$d_pegawai->jabatan}}</div>
                    </div>

                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Alamat</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">
                            {{$d_pegawai->alamat}}
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <div>
                        <a href="#" onclick="confirmRedirectDelete('{{ route('deleted_data_pegawai', $pegawai->id) }}'); return false;" class="py-0.5 px-1.5 text-xs bg-red-400 hover:bg-red-500 rounded">Delete</a>
                    </div>
                    <div class="ml-2">
                        <a href="{{route('update_data_pegawai', $d_pegawai->id)}}" class="py-0.5 px-1.5 text-xs bg-blue-400 hover:bg-blue-500 rounded">Update</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
     <!-- Modal Insert -->
     @php
                            //misal url yang di dapat
        if($pegawai_update == null){
            $url = '/update/data/pegawai';
        }else{
            $url = url("/update/data/pegawai/$pegawai_update->id");
        }
         $ambil_url = url()->current();
         if($ambil_url == $url) {
            $show = true;
            $action = route('updated_data_pegawai', $pegawai_update->id);
            $method = method_field('patch'); 
            $id = $pegawai_update->id;
            $nuptk = $pegawai_update->nuptk;
            $nip = $pegawai_update->nip;
            $nik = $pegawai_update->nik;
            $nomor_sertif_pendidik = $pegawai_update->nomor_sertif_pendidik;
            $nama_pegawai = $pegawai_update->nama_pegawai;
            $pendidikan_akhir = $pegawai_update->pendidikan_akhir;
            $jurusan = $pegawai_update->jurusan;
            $jenis_kelamin = $pegawai_update->jenis_kelamin;
            $tempat_lahir = $pegawai_update->tempat_lahir;
            $tgl_lahir = $pegawai_update->tgl_lahir;
            $agama = $pegawai_update->agama;
            $pangkat_or_golongan = $pegawai_update->pangkat_or_golongan;
            $jabatan = $pegawai_update->jabatan;
            $tugas_tambahan = $pegawai_update->tugas_tambahan;
            $nama_instansi = $pegawai_update->nama_instansi;
            $nama_instansi_cab = $pegawai_update->nama_instansi_cab;
            $mata_pelajaran_1 = $pegawai_update->mata_pelajaran_1;
            $mata_pelajaran_2 = $pegawai_update->mata_pelajaran_2;
            $mata_pelajaran_3 = $pegawai_update->mata_pelajaran_3;
            $mata_pelajaran_4 = $pegawai_update->mata_pelajaran_4;
            $mata_pelajaran_5 = $pegawai_update->mata_pelajaran_5;
            $mata_pelajaran_6 = $pegawai_update->mata_pelajaran_6;
            $no_hp = $pegawai_update->no_hp;
            $alamat = $pegawai_update->alamat;
         }else{
            $show = false;
            $action = route('create_data_pegawai');
            $method = "";
            $id = '';
            $nuptk = '';
            $nip = '';
            $nik = '';
            $nomor_sertif_pendidik = '';
            $nama_pegawai = '';
            $pendidikan_akhir = '';
            $jurusan = '';
            $jenis_kelamin = '';
            $tempat_lahir = '';
            $tgl_lahir = '';
            $agama = '';
            $pangkat_or_golongan = '';
            $jabatan = '';
            $tugas_tambahan = '';
            $nama_instansi = '';
            $nama_instansi_cab = '';
            $mata_pelajaran_1 = '';
            $mata_pelajaran_2 = '';
            $mata_pelajaran_3 = '';
            $mata_pelajaran_4 = '';
            $mata_pelajaran_5 = '';
            $mata_pelajaran_6 = '';
            $no_hp = '';
            $alamat = '';
         }
         
     @endphp
    <x-modal name="tambah_pegawai" :show="$show" max-width="lg">
        <form method="POST" action="{{$action}}">
            @csrf
            {{$method}}
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                    Data pegawai & Staff
                </h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium">NUPTK</label>
                    <input type="number" name="nuptk" value="{{$nuptk}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                    <input type="hidden" name="id" value="{{$id}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">NIP</label>
                    <input type="number" name="nip" value="{{$nip}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                    <input type="hidden" name="id" value="{{$id}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">NIK</label>
                    <input type="number" name="nik" value="{{$nik}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                    <input type="hidden" name="id" value="{{$id}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">No Sertif Pendidik</label>
                    <input type="number" name="nomor_sertif_pendidik" value="{{$nomor_sertif_pendidik}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" value="{{$nama_pegawai}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan_akhir" value="{{$pendidikan_akhir}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Jurusan</label>
                    <input type="text" name="jurusan" value="{{$jurusan}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                        <option value="{{$jenis_kelamin}}">{{$jenis_kelamin}}</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Laki-laki">Laki-laki</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Alamat</label>
                    <textarea name="alamat" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>{{$alamat}}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Agama</label>
                    <select name="agama" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                        <option value="{{$agama}}">{{$agama}}</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Kristen Katolik">Kristen Katolik</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Pangkat atau Golongan</label>
                    <input type="text" name="pangkat_or_golongan" value="{{$pangkat_or_golongan}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="flex justify-center items-center">
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{$tempat_lahir}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                    </div>
                    <div class="text-white">-</div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="{{$tgl_lahir}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Jabatan</label>
                    <select name="jabatan" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                        <option value="{{$jabatan}}">{{$jabatan}}</option>
                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                        <option value="Wakil Kepala Sekolah">Wakil Kepala Sekolah</option>
                        <option value="Waka Kurikulum">Waka Kurikulum</option>
                        <option value="Waka Kesiswaan">Waka Kesiswaan</option>
                        <option value="Waka Humas">Waka Humas</option>
                        <option value="Guru">Guru</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Tugas Tambahan</label>
                    <input type="text" name="tugas_tambahan" value="{{$tugas_tambahan}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Instansi</label>
                    <input type="text" name="nama_instansi" value="{{$nama_instansi}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Instansi Cabang</label>
                    <input type="text" name="nama_instansi_cab" value="{{$nama_instansi_cab}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mata Pelajaran Satu</label>
                    <input type="text" name="mata_pelajaran_1" value="{{$mata_pelajaran_1}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mata Pelajaran Dua</label>
                    <input type="text" name="mata_pelajaran_2" value="{{$mata_pelajaran_2}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mata Pelajaran Tiga</label>
                    <input type="text" name="mata_pelajaran_3" value="{{$mata_pelajaran_3}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mata Pelajaran Empat</label>
                    <input type="text" name="mata_pelajaran_4" value="{{$mata_pelajaran_4}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mata Pelajaran Lima</label>
                    <input type="text" name="mata_pelajaran_5" value="{{$mata_pelajaran_5}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mata Pelajaran Enam</label>
                    <input type="text" name="mata_pelajaran_6" value="{{$mata_pelajaran_6}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">NO HP</label>
                    <input type="number" name="no_hp" value="{{$no_hp}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'tambah_pegawai' }))" class="mr-2 px-4 py-2 border rounded">
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
<x-app-layout>
    <div class="w-full h-16 bg-slate-100 px-3 py-2">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center mr-2">
                <div>
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'buat_config' }))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </div>
                <div>
                    <a href="{{route('halaman_import')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h14.25M3 9h9.75M3 13.5h9.75m4.5-4.5v12m0 0-3.75-3.75M17.25 21 21 17.25" />
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
    <div class="w-full md:block hidden mt-6 rounded-xl p-3 shadow-lg bg-gray-50 overflow-scroll max-[450px] appearance-none">
        <table class="table-auto" id="data_kelas">
            <thead class="sticky top-0 bg-slate-300">
            <tr>
                <th class="px-3 py-2 font-medium border">No</th>
                <th class="px-3 py-2 font-medium border">Nama Sekolah</th>
                <th class="px-3 py-2 font-medium border">Alamat</th>
                <th class="px-3 py-2 font-medium border">Tahun</th>
                <th class="px-3 py-2 font-medium border">Semester</th>
                <th class="px-3 py-2 font-medium border">Status</th>
                <th class="px-3 py-2 font-medium border">Aksi</th>
            </tr>
            </thead>
            <tbody class="">
            @php
                $no = 1;
            @endphp
            @foreach ($config as $conf)
                <tr>
                    <td class="px-3 py-2 border">{{$no++}}</td>
                    <td class="px-3 py-2 border">{{$conf->nama_sekolah}}</td>
                    <td class="px-3 py-2 border">{{$conf->alamat}}</td>
                    <td class="px-3 py-2 border">{{$conf->tahun_ajaran}}</td>
                    <td class="px-3 py-2 border">{{$conf->semester}}</td>
                    <td class="px-3 py-2 border">{{$conf->status}}</td>
                    <td class="px-3 py-2 border">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{route('update_config', $conf->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="#" onclick="confirmRedirectDelete('{{route('delete_config', $conf->id)}}'); return false;">
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
    @php
        
        if($update_config == null){
            $url = '/seting/configurasi/aplikasi';
        }else{
            $url = url("/update/data/config/$update_config->id");
        }
         $ambil_url = url()->current();
         if($ambil_url == $url) {
            $show = true;
            $action = route('updated_config', $update_config->id);
            $method = method_field('patch'); 
            $id = $update_config->id;
            $nama_sekolah = $update_config->nama_sekolah;
            $kode_sekolah = $update_config->kode_sekolah;
            $alamat = $update_config->alamat;
            $no_hp = $update_config->no_hp;
            $semester = $update_config->semester;
            $tahun1 = $update_config->tahun_ajaran;
            $status = $update_config->status;
         }else{
            $show = false;
            $action = route('create_config');
            $method = "";
            $id = '';
            if (!$configurasi) {
                $nama_sekolah = "";
                $kode_sekolah = "";
                $alamat = "";
                $no_hp = "";
                $semester = "";
                $tahun1 = "";
                $status = "";
            }else{
                $nama_sekolah = $configurasi->nama_sekolah;
                $kode_sekolah = $configurasi->kode_sekolah;
                $alamat = $configurasi->alamat;
                $no_hp = $configurasi->no_hp;
                $semester = "";
                $tahun1 = "";
                $status = "";
            }
         }
         
    @endphp
        <x-modal name="buat_config" :show="$show" max-width="lg">
        <form method="POST" action="{{$action}}">
            @csrf
            {{$method}}
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                    Setting Konfigurasi
                </h2>            
                <div class="mb-4">
                    <label class="block text-sm font-medium">Kode Sekolah</label>
                    <input type="text" name="kode_sekolah" value="{{$kode_sekolah}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" value="{{$nama_sekolah}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Alamat</label>
                    <textarea name="alamat" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>{{$alamat}}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">NO Telpon/WA Sekolah</label>
                    <input type="number" name="no_hp" value="{{$no_hp}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Pilih Semester</label>
                    <select class="block w-full" placeholder="Ketik untuk cari siswa" name="semester">
                        <option value="{{$semester}}">{{$semester}}</option>
                        <option value="Semester 1">Semester 1</option>
                        <option value="Semester 2">Semester 2</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Pilih Tahun</label>
                    <select name="tahun_ajaran" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        <option value="{{$tahun1}}">{{$tahun1}}</option>
                        @php
                            $total_tahun = 500;
                            $th = 0;
                            $tahun_berjalan = date('Y');
                        @endphp
                        @for ($d = 0; $d <= $total_tahun; $d++)
                            @php
                                $th = $tahun_berjalan + $d;
                            @endphp
                            <option value="{{$th}}">{{$th}}</option>
                        @endfor
                        
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2">Aktifkan Status</label>
                    <select class="block w-full" placeholder="Ketik untuk cari siswa" name="status">
                        <option value="{{$status}}">{{$status}}</option>
                        <option value="aktif">Aktif</option>
                        <option value="non-aktif">Non-Aktif</option>
                    </select>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'buat_config' }))" class="bg-yellow-300 mr-2 px-4 py-2 border rounded">
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
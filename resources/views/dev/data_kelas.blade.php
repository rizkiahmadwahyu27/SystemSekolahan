<x-app-layout>
    <div class="w-full h-16 bg-slate-100 px-3 py-2">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center mr-2">
                <div>
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'buat_kelas' }))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </button>
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

    <div class="w-full md:block hidden mt-6 rounded-xl p-3 shadow-lg bg-gray-50 overflow-scroll max-[450px] appearance-none">
        <table class="table-auto" id="data_kelas">
            <thead class="sticky top-0 bg-slate-300">
            <tr>
                <th class="px-3 py-2 font-medium border">No</th>
                <th class="px-3 py-2 font-medium border">NIS</th>
                <th class="px-3 py-2 font-medium border">Nama Lengkap</th>
                <th class="px-3 py-2 font-medium border">Kode Kelas</th>
                <th class="px-3 py-2 font-medium border">Nama Kelas</th>
                <th class="px-3 py-2 font-medium border">Nama Wali Kelas</th>
                <th class="px-3 py-2 font-medium border">Keterangan</th>
                <th class="px-3 py-2 font-medium border">Aksi</th>
            </tr>
            </thead>
            <tbody class="">
            @php
                $no = 1;
            @endphp
            @foreach ($d_kelas_siswa as $d_kelas)
                <tr>
                    <td class="px-3 py-2 border">{{$no++}}</td>
                    <td class="px-3 py-2 border">{{$d_kelas->nis}}</td>
                    <td class="px-3 py-2 border">{{$d_kelas->nama}}</td>
                    <td class="px-3 py-2 border">{{$d_kelas->kode_kelas}}</td>
                    <td class="px-3 py-2 border">{{$d_kelas->nama_kelas}}</td>
                    <td class="px-3 py-2 border">{{$d_kelas->nama_wali_kelas}}</td>
                    <td class="px-3 py-2 border">{{$d_kelas->keterangan}}</td>
                    <td class="px-3 py-2 border">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{route('update_data_kelas_siswa', $d_kelas->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="{{route('deleted_data_kelas_siswa', $d_kelas->id)}}">
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
        @foreach ($d_kelas_siswa as $class)
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
                        <div class="flex-1 break-words">{{$class->nis}}</div>
                    </div>
                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Nama</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$class->nama}}</div>
                    </div>
                    <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                        <div class="w-1/3 font-medium">Kelas</div>
                        <div class="mx-2">:</div>
                        <div class="flex-1 break-words">{{$class->nama_kelas}}</div>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <div>
                        <a href="{{route('deleted_data_kelas_siswa', $class->id)}}" class="py-0.5 px-1.5 text-xs bg-red-400 hover:bg-red-500 rounded">Delete</a>
                    </div>
                    <div class="ml-2">
                        <a href="{{route('update_data_kelas_siswa', $class->id)}}" class="py-0.5 px-1.5 text-xs bg-blue-400 hover:bg-blue-500 rounded">Update</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
     <!-- Modal Insert -->
     @php
        
        if($update_kelas == null){
            $url = '/update/data/kelas/siswa';
        }else{
            $url = url("/update/data/kelas/siswa/$update_kelas->id");
        }
         $ambil_url = url()->current();
         if($ambil_url == $url) {
            $show = true;
            $action = route('updated_data_kelas_siswa', $update_kelas->id);
            $method = method_field('patch'); 
            $id = $update_kelas->id;
            $nisn = $update_kelas->nisn;
            $nis = $update_kelas->nis;
            $nama = $update_kelas->nama;
            $kode_kelas = $update_kelas->kode_kelas;
            $nama_kelas = $update_kelas->nama_kelas;
            $keterangan = $update_kelas->keterangan;
         }else{
            $show = false;
            $action = route('create_data_kelas_siswa');
            $method = "";
            $id = '';
            $nisn = "";
            $nis = "";
            $nama = "";
            $kode_kelas = "";
            $nama_kelas = "";
            $keterangan = "";
         }
         
     @endphp
    <x-modal name="buat_kelas" :show="$show" max-width="lg">
        <form method="POST" action="{{$action}}">
            @csrf
            {{$method}}
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                    Data Kelas Siswa
                </h2>            
                <div class="mb-6">
                    <label for="siswaSearch" class="block text-slate-200 text-sm font-bold mb-2">Pilih Siswa</label>
                    <select id="siswaSearch" class="block w-full" placeholder="Ketik untuk cari siswa" name="siswa">
                        @if ($update_kelas == null)
                            <option value="">Pilih Nama Siswa</option>
                        @else
                            <option value="{{$nisn}} , {{$nis}} , {{$nama}}">{{$nisn}} , {{$nis}} , {{$nama}}</option>
                        @endif
                        @foreach ($data_siswa as $siswa)
                            <option value="{{$siswa->nisn}} , {{$siswa->nis}} , {{$siswa->nama}}">{{$siswa->nisn}} , {{$siswa->nis}} , {{$siswa->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label for="kelasSearch" class="block text-slate-200 text-sm font-bold mb-2">Pilih Kelas</label>
                    <select id="kelasSearch" class="block w-full" placeholder="Ketik untuk cari kelas" name="kelas">
                        @if ($update_kelas == null)
                            <option value="">Pilih Kelas</option>
                        @else
                            <option value="{{$kode_kelas}} , {{$nama_kelas}}">{{$kode_kelas}} , {{$nama_kelas}}</option>
                        @endif
                        @foreach ($data_kelas as $kelas)
                            <option value="{{$kelas->kode_kelas}} , {{$kelas->nama_kelas}}">{{$kelas->kode_kelas}} , {{$kelas->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-200">Keterangan</label>
                    <select name="keterangan" class="kelasSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                        <option value="{{$keterangan}}">{{$keterangan}}</option>
                        <option value="Siswa Baru">Siswa Baru</option>
                        <option value="Naik Kelas">Naik Kelas</option>
                        <option value="Tinggal Kelas">Tinggal Kelas</option>
                        <option value="Pindahan">Pindahan</option>
                        <option value="Pindah">Pindah</option>
                        <option value="Keluar">Keluar</option>
                        <option value="Lainnya...">Lainnya...</option>
                    </select>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'buat_kelas' }))" class="mr-2 px-4 py-2 border rounded">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </x-modal>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Tom Select
            new TomSelect("#siswaSearch", {
                create: false, // Izinkan membuat opsi baru jika tidak ada yang cocok (default: false)
                sortField: {
                    field: "text", // Urutkan berdasarkan teks opsi
                    direction: "asc" // Urutan menaik
                },
                // Styling dengan Tailwind CSS
                // Ini adalah kunci untuk mengintegrasikan Tom Select dengan styling Tailwind Anda
                plugins: ['dropdown_input'], // Memastikan input pencarian muncul di dropdown
                wrapperClass: 'relative', // Untuk posisi absolute elemen turunan
                inputClass: 'w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent', // Gaya untuk input pencarian
                dropdownClass: 'absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1', // Gaya untuk dropdown
                optionClass: 'px-4 py-2 hover:bg-blue-100 cursor-pointer', // Gaya untuk setiap opsi
                itemClass: 'flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md bg-blue-500 text-white', // Gaya untuk item yang dipilih (jika multi-select)
                controlInput: null // Penting untuk memastikan input pencarian yang di-styling
            });

            // Opsional: Menampilkan nilai yang dipilih
            const siswaSearch = document.getElementById('siswaSearch');

            siswaSearch.addEventListener('change', function() {
                selectedValueSpan.textContent = this.options[this.selectedIndex].text;
            });

            new TomSelect("#kelasSearch", {
                create: false, // Izinkan membuat opsi baru jika tidak ada yang cocok (default: false)
                sortField: {
                    field: "text", // Urutkan berdasarkan teks opsi
                    direction: "asc" // Urutan menaik
                },
                // Styling dengan Tailwind CSS
                // Ini adalah kunci untuk mengintegrasikan Tom Select dengan styling Tailwind Anda
                plugins: ['dropdown_input'], // Memastikan input pencarian muncul di dropdown
                wrapperClass: 'relative', // Untuk posisi absolute elemen turunan
                inputClass: 'w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent', // Gaya untuk input pencarian
                dropdownClass: 'absolute z-10 w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1', // Gaya untuk dropdown
                optionClass: 'px-4 py-2 hover:bg-blue-100 cursor-pointer', // Gaya untuk setiap opsi
                itemClass: 'flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md bg-blue-500 text-white', // Gaya untuk item yang dipilih (jika multi-select)
                controlInput: null // Penting untuk memastikan input pencarian yang di-styling
            });

            // Opsional: Menampilkan nilai yang dipilih
            const kelasSearch = document.getElementById('kelasSearch');

            kelasSearch.addEventListener('change', function() {
                selectedValueSpan.textContent = this.options[this.selectedIndex].text;
            });
        });
    </script>
    {{-- <div class="mb-4 groupX">
        <div class="grid grid-cols-2 gap-1 justify-between items-center">
            <div>
                <label class="block text-sm font-medium text-gray-200">Kelas X</label>
                <select name="kelas_x" id="kelasX" onchange="handleSelectChange('X')" class="kelasSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                    <option value="{{$kelas_x}}">{{$kelas_x}}</option>
                    <option value="X MPLBB">X MPLBB</option>
                    <option value="X PM">X PM</option>
                    <option value="X TJKT">X TJKT</option>
                    <option value="X DKV">X DKV</option>
                </select>
                <input type="hidden" name="id_kelas_x" value="{{$id_kelas_x}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" >
            </div>
            <div>
                <label class="from-walikelas block text-sm font-medium text-gray-200">Wali Kelas X</label>
                <select name="nama_wali_kelas_x" id="walikelasX" class="waliSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                    <option value="{{$nama_wali_kelas_x}}">{{$nama_wali_kelas_x}}</option>
                    @foreach ($data_guru as $gurux)
                        <option value="{{$gurux->nama_pegawai}}">{{$gurux->nama_pegawai}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    
    <div class="mb-4 groupXI">
        <div class="grid grid-cols-2 gap-1 justify-between items-center">
            <div>
                <label class="block text-sm font-medium text-gray-200">Kelas XI</label>
                <select name="kelas_xi"  id="kelasXI" onchange="handleSelectChange('XI')"class="kelasSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                    <option value="{{$kelas_xi}}">{{$kelas_xi}}</option>
                    <option value="XI MPLBB">XI MPLBB</option>
                    <option value="XI PM">XI PM</option>
                    <option value="XI TJKT">XI TJKT</option>
                    <option value="XI DKV">XI DKV</option>
                </select>
                <input type="hidden" name="id_kelas_xi" value="{{$id_kelas_xi}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-200">Wali Kelas XI</label>
                <select name="nama_wali_kelas_xi" id="walikelasXI" class="waliSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                    <option value="{{$nama_wali_kelas_xi}}">{{$nama_wali_kelas_xi}}</option>
                    @foreach ($data_guru as $guruxi)
                        <option value="{{$guruxi->nama_pegawai}}">{{$guruxi->nama_pegawai}}</option>
                    @endforeach
                </select>
            </div>
        </div>     
    </div>
    <div class="mb-4 groupXII">
        <div class="grid grid-cols-2 gap-1 justify-between items-center">
            <div>
                <label class="block text-sm font-medium text-gray-200">Kelas XII</label>
                <select name="kelas_xii" id="kelasXII" onchange="handleSelectChange('XII')" class="kelasSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                    <option value="{{$kelas_xii}}">{{$kelas_xii}}</option>
                    <option value="XII MPLBB">XII MPLBB</option>
                    <option value="XII PM">XII PM</option>
                    <option value="XII TJKT">XII TJKT</option>
                    <option value="XII DKV">XII DKV</option>
                </select>
                <input type="hidden" name="id_kelas_xii" value="{{$id_kelas_xii}}" class="mt-1 block w-full rounded border-gray-300 shadow-sm" >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-200">Wali Kelas XII</label>
                <select name="nama_wali_kelas_xii" id="walikelasXII" class="waliSelect form-select mt-1 block w-full rounded border-gray-300 shadow-sm" >
                    <option value="{{$nama_wali_kelas_xii}}">{{$nama_wali_kelas_xii}}</option>
                    @foreach ($data_guru as $guruxii)
                        <option value="{{$guruxii->nama_pegawai}}">{{$guruxii->nama_pegawai}}</option>
                    @endforeach
                </select>
            </div>
        </div>    
    </div> --}}
    {{-- <script>
        function handleSelectChange(selectedGroup) {
            const groups = ['X','XI', 'XII'];

            groups.forEach(group => {
                const kelas = document.getElementById(`kelas${group}`);
                const wali = document.getElementById(`walikelas${group}`);

                if (group !== selectedGroup) {
                    // Disable jika grup yang dipilih punya value
                    const selectedVal = document.getElementById(`kelas${selectedGroup}`).value;
                    const disable = selectedVal !== "";

                    kelas.disabled = disable;
                    wali.disabled = disable;
                } else {
                    // Jika dikosongkan, aktifkan semuanya
                    if (kelas.value === "") {
                        groups.forEach(grp => {
                            document.getElementById(`kelas${grp}`).disabled = false;
                            document.getElementById(`walikelas${grp}`).disabled = false;
                        });
                    }
                }
            });
        }
    </script> --}}

</x-app-layout>

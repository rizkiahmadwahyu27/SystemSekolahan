<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Ujian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="min-h-screen flex flex-col md:flex-row">

    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"></div>

    <aside id="sidebar" class="fixed md:sticky top-0 left-0 h-screen w-64 bg-slate-900 text-gray-200 flex flex-col z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl">
        <div class="h-16 flex items-center justify-between px-6 bg-slate-950 border-b border-slate-800">
            <span class="text-lg font-bold text-white tracking-wider">ExamPanel</span>
            <button onclick="toggleSidebar()" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                ✕
            </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{route('dashboard_ujian_admin')}}" class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                Dashboard
            </a>
            <a href="{{route('index_soal')}}" class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Soal
            </a>
            <a href="{{route('index_peserta')}}" class="flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Siswa / Peserta
            </a>
            <a href="{{route('monitor_peserta')}}" class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Monitor Peserta
            </a>
            
            <a href="#" class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Hasil Ujian
            </a>
        </nav>

        <div class="p-4 bg-slate-950 border-t border-slate-800 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                    A
                </div>
                <div>
                    <p class="text-xs font-semibold text-white">Administrator</p>
                    <p class="text-[10px] text-gray-400">admin@ujian.com</p>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        
        <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 md:px-8 sticky top-0 z-30">
            <div class="flex items-center space-x-3">
                <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <span class="text-xl font-bold text-gray-800 md:hidden">ExamPanel</span>
            </div>
            <div class="text-sm text-gray-500 hidden md:block">
                Hari ini: <span class="font-medium text-gray-700">{{ now()->format('d M Y') }}</span>
            </div>
        </header>

        <main class="p-4 md:p-8 flex-1">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Peserta</h1>

                <button onclick="openModal()"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 font-medium transition-colors">
                    + Buat Peserta
                </button>
                <button onclick="openModal1()"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 font-medium transition-colors">
                    + Buat Kategori
                </button>
                {{-- <button onclick="openModal2()"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 font-medium transition-colors">
                    + Buat Kelas
                </button>
                <button onclick="openModal3()"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 font-medium transition-colors">
                    + Buat Mapel
                </button> --}}
            </div>

            

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200 text-gray-700 font-semibold">
                            <tr>
                                <th class="p-4 w-12 text-center">No</th>
                                <th class="p-4">Nomor Peserta</th>
                                <th class="p-4">Nama</th>
                                <th class="p-4">kelas</th>
                                <th class="p-4">Ruangan</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            @foreach($pesertas as $key => $peserta)
                            <tr class="hover:bg-gray-50/70 transition-colors">
                                <td class="p-4 text-center font-medium">{{ $key+1 }}</td>
                                <td class="p-4 font-semibold text-gray-800">{{ $peserta->no_peserta }}</td>
                                <td class="p-4 font-semibold text-gray-800">{{ $peserta->nama }}</td>
                                <td class="p-4">{{ $peserta->kelas }}</td>
                                <td class="p-4">{{ $peserta->ruangan }}</td>


                                <td class="p-4 text-center space-x-1 whitespace-nowrap">
                                    <a href="/admin/peserta/{{ $peserta->id }}/edit"
                                        class="bg-amber-400 hover:bg-amber-500 px-3 py-1.5 rounded-md text-white text-xs font-medium transition-colors">
                                        Edit
                                    </a>

                                    <form action="{{ route('destroy_peserta', $peserta->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin hapus?')"
                                            class="bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-md text-white text-xs font-medium transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @if($pesertas->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center p-8 text-gray-400 bg-gray-50/50">
                                    Belum ada data ujian tersedia.
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>



<div id="modalImportPeserta" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-xl relative max-h-[90vh] overflow-y-auto">

        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors">
            ✕
        </button>

        <h2 class="text-lg font-bold mb-4 text-gray-800">Import Peserta</h2>

        <form action="{{ route('import_peserta') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="w-full">
                <label class="block text-xs font-semibold text-slate-600 mb-1">Kelas Peserta</label>
                <select name="kelas" required 
                    class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:outline-none focus:border-blue-500">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $item)
                        <option value="{{ $item->nama_kelas }}">{{ $item->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start space-x-3 mb-2">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm">
                    <span class="font-semibold text-blue-800 block">Petunjuk Import</span>
                    <span class="text-blue-700 block mb-2">Pastikan format berkas Anda sudah sesuai dengan format standar sistem agar data terbaca dengan benar.</span>
                    <a href="#" class="inline-flex items-center text-xs font-bold text-blue-600 hover:text-blue-800 bg-white border border-blue-300 px-3 py-1.5 rounded-md transition-colors shadow-sm">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Unduh Format Excel (.xlsx)
                    </a>
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-1 tracking-wide">Pilih Berkas Peserta</label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-xl bg-white hover:bg-gray-50/50 hover:border-blue-400 transition-all flex flex-col items-center justify-center py-6 px-4 text-center group">
                    
                    <input type="file" name="file_peserta" accept=".xlsx, .xls, .csv" required onchange="updateFileName(this)"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                    <div class="p-3 bg-gray-50 rounded-full text-gray-400 group-hover:bg-blue-50 group-hover:text-blue-500 transition-colors mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>

                    <span id="file-label-text" class="text-sm font-semibold text-gray-700 block">
                        Klik untuk cari berkas atau seret ke sini
                    </span>
                    <span id="file-support-text" class="text-xs text-gray-400 block mt-0.5">
                        Format yang didukung: Excel (.xlsx, .xls) atau .csv
                    </span>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" 
                    class="w-full md:w-auto px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm shadow-md shadow-green-600/15 transition-all flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span>Proses Import Peserta</span>
                </button>
            </div>
        </form>
    </div>
</div>



<script>
    // FUNGSI TOGGLE SIDEBAR (MOBILE)
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    // FUNGSI MODAL
    // --- MODAL 1: UJIAN ---
    function openModal() {
        document.getElementById('modalImportPeserta').classList.remove('hidden');
        document.getElementById('modalImportPeserta').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modalImportPeserta').classList.add('hidden');
        document.getElementById('modalImportPeserta').classList.remove('flex');
    }

    // Close modal Ujian kalau klik background luar
    document.getElementById('modalUjian').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    // --- MODAL 2: Import Peserta ---
    // function openModal1() {
    //     document.getElementById('modalImportPeserta').classList.remove('hidden');
    //     document.getElementById('modalImportPeserta').classList.add('flex');
    // }

    // function closeModal1() {
    //     document.getElementById('modalImportPeserta').classList.add('hidden');
    //     document.getElementById('modalImportPeserta').classList.remove('flex');
    // }

    // Close modal Ujian kalau klik background luar
    // document.getElementById('modalImportPeserta').addEventListener('click', function(e) {
    //     if (e.target === this) {
    //         closeModal1();
    //     }
    // });


</script>

<script>
    function updateFileName(input) {
        const labelText = document.getElementById('file-label-text');
        const supportText = document.getElementById('file-support-text');
        
        if (input.files && input.files.length > 0) {
            const fileName = input.files[0].name;
            labelText.textContent = "Berkas Terpilih:";
            supportText.innerHTML = `<span class="text-blue-600 font-bold bg-blue-50 px-2 py-0.5 rounded border border-blue-200">${fileName}</span>`;
        } else {
            labelText.textContent = "Klik untuk cari berkas atau seret ke sini";
            supportText.textContent = "Format yang didukung: Excel (.xlsx, .xls) atau .csv";
        }
    }
</script>


@if ($errors->any())
<script>
    openModal();
</script>
@endif

</body>
</html>
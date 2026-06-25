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
            <a href="{{route('index_peserta')}}" class="flex items-center px-4 py-2.5 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Siswa / Peserta
            </a>
            <a href="{{route('monitor_peserta')}}" class="flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-lg transition-colors">
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

    <div class="max-w-6xl mx-auto">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-6">
        <div class="flex items-center gap-4">
            <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                <i class="fa-solid fa-desktop text-2xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-800">Status & Monitor Peserta</h1>
                <p class="text-sm text-slate-500">Pantau aktivitas login siswa di ruang ujian secara real-time.</p>
            </div>
        </div>
        <div class="flex gap-3">
            <div class="bg-blue-50 border border-blue-100 px-4 py-2 rounded-xl text-center">
                <span class="block text-xs font-semibold text-slate-500 uppercase">Sedang Ujian</span>
                <span class="text-xl font-bold text-blue-700">{{ $pesertaAktif->count() }} Siswa</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3 text-sm">
            <i class="fa-solid fa-circle-check text-lg"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-700">Daftar Aktivitas Login Siswa</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold border-b border-slate-100">
                        <th class="px-6 py-4">Nama / No Peserta</th>
                        <th class="px-6 py-4 text-center">Kelas</th>
                        <th class="px-6 py-4 text-center">Ruang / Sesi</th>
                        <th class="px-6 py-4 text-center">Status Login</th>
                        <th class="px-6 py-4 text-center">Device ID (Tracking)</th>
                        <th class="px-6 py-4 text-center">Aksi Proktor</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($semuaPeserta as $siswa)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $siswa->nama }}</div>
                                <div class="text-xs font-mono text-slate-400 mt-0.5">{{ $siswa->no_peserta }}</div>
                            </td>
                            <td class="px-6 py-4 text-center font-medium">{{ $siswa->kelas }}</td>
                            <td class="px-6 py-4 text-center text-xs">
                                <span class="block text-slate-600 font-semibold">{{ $siswa->ruangan ?? '-' }}</span>
                                <span class="block text-slate-400 mt-0.5">{{ $siswa->sesi ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($siswa->is_login)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Aktif Mengerjakan
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">
                                        Belum Login / Keluar
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center font-mono text-xs text-slate-500">
                                {{ $siswa->device_id ? Str::limit($siswa->device_id, 15) : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($siswa->is_login)
                                    <form action="{{ route('resetLoginPeserta', $siswa->id) }}" method="POST" onsubmit="return confirm('Paksa keluar siswa ini? Gunakan jika laptop siswa eror/restart agar mereka bisa login ulang.')">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-semibold rounded-lg border border-amber-200 transition cursor-pointer">
                                            <i class="fa-solid fa-arrow-rotate-left"></i> Reset Login
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-50 text-slate-300 text-xs font-semibold rounded-lg border border-slate-100 cursor-not-allowed">
                                        <i class="fa-solid fa-check"></i> Clear
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400 italic">Belum ada data peserta ujian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
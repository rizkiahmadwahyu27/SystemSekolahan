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
            <a href="{{route('dashboard_ujian_admin')}}" class="flex items-center px-4 py-2.5 bg-blue-600 text-white rounded-lg transition-colors">
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
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Ujian</h1>

                <button onclick="openModal()"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 font-medium transition-colors">
                    + Buat Ujian
                </button>
                <button onclick="openModal1()"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 font-medium transition-colors">
                    + Buat Kategori
                </button>
                <button onclick="openModal2()"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 font-medium transition-colors">
                    + Buat Kelas
                </button>
                <button onclick="openModal3()"
                    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 font-medium transition-colors">
                    + Buat Mapel
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                    <h2 class="text-gray-400 text-sm font-medium uppercase tracking-wider">Total Ujian</h2>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $total }}</p>
                </div>

                <div class="bg-green-50 p-5 rounded-xl shadow-sm border border-green-100">
                    <h2 class="text-green-600 text-sm font-medium uppercase tracking-wider">Sedang Berlangsung</h2>
                    <p class="text-3xl font-bold text-green-700 mt-1">{{ $aktif }}</p>
                </div>

                <div class="bg-red-50 p-5 rounded-xl shadow-sm border border-red-100">
                    <h2 class="text-red-600 text-sm font-medium uppercase tracking-wider">Selesai</h2>
                    <p class="text-3xl font-bold text-red-700 mt-1">{{ $selesai }}</p>
                </div>

            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama Ujian</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Token (15 Menit)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach($ujians as $ujian)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $ujian->nama_ujian }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ strtoupper($ujian->tipe) }}</td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ujian->mulai <= now() && $ujian->selesai >= now())
                                        <span class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg font-mono font-bold tracking-wider text-sm">
                                            {{ $ujian->token }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 font-sans italic">Ujian tidak aktif</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ujian->selesai < now())
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Selesai</span>
                                    @elseif($ujian->mulai <= now() && $ujian->selesai >= now())
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Mendatang</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('admin.ujian.edit', $ujian->id) }}" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg transition">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.ujian.delete', $ujian->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ujian ini? Semua data soal di dalamnya akan ikut terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition cursor-pointer">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<div id="modalUjian" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-xl relative max-h-[90vh] overflow-y-auto">

        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors">
            ✕
        </button>

        <h2 class="text-lg font-bold mb-4 text-gray-800">Buat Ujian Baru</h2>

        <form method="POST" action="{{ route('store_ujian') }}" class="space-y-4">
            @csrf

            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-1 tracking-wide">Nama Ujian</label>
                <input type="text" name="nama_ujian" value="{{$ujian->nama_ujian}}" placeholder="Contoh: Ujian Akhir Semester Ganjil" required
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all placeholder:text-gray-400 text-sm text-gray-700">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase block mb-1 tracking-wide">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" required
                        class="w-full p-2.5 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all text-sm text-gray-700">
                        <option value="{{$ujian->mapel}}">{{$ujian->mapel}}</option>
                        @foreach($mapels as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase block mb-1 tracking-wide">Tipe Ujian</label>
                    <select name="tipe" required
                        class="w-full p-2.5 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all text-sm text-gray-700">
                        <option value="{{$ujian->tipe}}">{{$ujian->tipe}}</option>
                        <option value="sekolah">Sekolah</option>
                        <option value="cat">CAT (Computer Assisted Test)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-1 tracking-wide">Durasi Ujian</label>
                <div class="relative rounded-lg shadow-sm">
                    <input type="number" name="durasi" {{$ujian->durasi}} placeholder="60" min="1" required
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all text-sm text-gray-700 pr-16">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400 text-sm">
                        Menit
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase block mb-1 tracking-wide">Waktu Mulai</label>
                    <input type="datetime-local" name="mulai" required value="{{$ujian->mulai}}"
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all text-sm text-gray-700">
                </div>

                <div>
                    <label class="text-xs font-semibold text-gray-600 uppercase block mb-1 tracking-wide">Waktu Selesai</label>
                    <input type="datetime-local" name="selesai" value="{{$ujian->selesai}}" required
                        class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all text-sm text-gray-700">
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-0.5 tracking-wide">Target Kelas</label>
                <span class="text-[11px] text-gray-400 block mb-1.5">*Tahan tombol Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari 1 kelas</span>
                <select name="kelas_id[]" multiple required size="4"
                    class="w-full p-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all text-sm text-gray-700">
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" class="p-1.5 rounded hover:bg-blue-50">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-0.5 tracking-wide">Kategori Ujian</label>
                <span class="text-[11px] text-gray-400 block mb-1.5">*Tahan tombol Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari 1 kategori</span>
                <select name="kategori_id[]" multiple required size="4"
                    class="w-full p-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all text-sm text-gray-700">
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" class="p-1.5 rounded hover:bg-blue-50">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-1 tracking-wide">Deskripsi / Petunjuk Ujian</label>
                <textarea name="deskripsi" placeholder="Tuliskan petunjuk pengerjaan ujian di sini..." rows="3"
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all placeholder:text-gray-400 text-sm text-gray-700">
                    {{$ujian->selesai}}
                </textarea>
            </div>

            <div class="flex space-x-2 pt-2">
                <button type="button" onclick="closeModal()"
                    class="w-1/3 bg-gray-100 text-gray-600 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="w-2/3 bg-blue-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 shadow-md shadow-blue-500/20 transition-colors">
                    Simpan & Terbitkan Ujian
                </button>
            </div>

        </form>
    </div>
</div>

<div id="modalKategori" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-[90%] md:w-[450px] p-6 rounded-xl shadow-xl relative animate-fade-in">
    
        <button onclick="closeModal1()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors">
            ✕
        </button>

        <h2 class="text-lg font-bold mb-1 text-gray-800">Tambah Kategori</h2>
        <p class="text-xs text-gray-500 mb-5">Tambahkan kategori ujian baru untuk mempermudah pengelompokan.</p>

        <form method="POST" action="{{route('store_kategori')}}" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-1.5 tracking-wide">Nama Kategori</label>
                <input type="text" name="nama" placeholder="Contoh: Ujian Tengah Semester" required
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all placeholder:text-gray-400 text-sm text-gray-700">
            </div>

            <div class="flex space-x-2 pt-2">
                <button type="button" onclick="closeModal1()" 
                    class="w-1/3 bg-gray-100 text-gray-600 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="w-2/3 bg-blue-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 shadow-md shadow-blue-500/20 transition-all">
                    Simpan Kategori
                </button>
            </div>
        </form>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-2xl mt-6">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Daftar Kategori</h3>
                <span class="text-xs bg-blue-50 text-blue-600 px-2.5 py-1 rounded-full font-medium">
                    Total: {{ count($kategoris) }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-500 font-semibold border-b border-gray-200 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="p-4 pl-6">Nama Kategori</th>
                            <th class="p-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-gray-600">
                        @foreach($kategoris as $d)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-4 pl-6 font-medium text-gray-800">
                                {{ $d->nama }}
                            </td>
                            <td class="p-4 text-center">
                                <form method="POST" action="{{route('destroy_kategori', $d->id)}}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus kategori ini?')" 
                                        class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md text-xs font-medium transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if(count($kategoris) === 0)
                        <tr>
                            <td colspan="2" class="text-center p-8 text-gray-400 bg-gray-50/30">
                                Belum ada kategori yang ditambahkan.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<div id="modalKelas" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-[90%] md:w-[450px] p-6 rounded-xl shadow-xl relative animate-fade-in">
    
        <button onclick="closeModal2()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors">
            ✕
        </button>

        <h2 class="text-lg font-bold mb-1 text-gray-800">Tambah Kelas</h2>
        <p class="text-xs text-gray-500 mb-5">Tambahkan kelas ujian baru untuk mempermudah pengelompokan.</p>

        <form method="POST" action="{{route('store_kelas')}}" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-1.5 tracking-wide">Nama Kelas</label>
                <input type="text" name="nama_kelas" placeholder="Contoh: X-MPLB" required
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all placeholder:text-gray-400 text-sm text-gray-700">
            </div>

            <div class="flex space-x-2 pt-2">
                <button type="button" onclick="closeModal2()" 
                    class="w-1/3 bg-gray-100 text-gray-600 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="w-2/3 bg-blue-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 shadow-md shadow-blue-500/20 transition-all">
                    Simpan Kelas
                </button>
            </div>
        </form>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-2xl mt-6">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Daftar Kelas</h3>
                <span class="text-xs bg-blue-50 text-blue-600 px-2.5 py-1 rounded-full font-medium">
                    Total: {{ count($kelas) }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-500 font-semibold border-b border-gray-200 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="p-4 pl-6">Nama Kelas</th>
                            <th class="p-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-gray-600">
                        @foreach($kelas as $d_kelas)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-4 pl-6 font-medium text-gray-800">
                                {{ $d_kelas->nama_kelas }}
                            </td>
                            <td class="p-4 text-center">
                                <form method="POST" action="{{route('destroy_kelas', $d_kelas->id)}}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus kategori ini?')" 
                                        class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md text-xs font-medium transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if(count($kelas) === 0)
                        <tr>
                            <td colspan="2" class="text-center p-8 text-gray-400 bg-gray-50/30">
                                Belum ada kategori yang ditambahkan.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<div id="modalMapel" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-[90%] md:w-[450px] p-6 rounded-xl shadow-xl relative animate-fade-in">
    
        <button onclick="closeModal3()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors">
            ✕
        </button>

        <h2 class="text-lg font-bold mb-1 text-gray-800">Tambah Mata Pelajaran</h2>
        <p class="text-xs text-gray-500 mb-5">Tambahkan Mapel untuk mempermudah pengelompokan.</p>

        <form method="POST" action="{{route('store_mapel')}}" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-semibold text-gray-600 uppercase block mb-1.5 tracking-wide">Nama Mapel</label>
                <input type="text" name="nama_mapel" placeholder="Contoh: B. Indonesia" required
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all placeholder:text-gray-400 text-sm text-gray-700">
            </div>

            <div class="flex space-x-2 pt-2">
                <button type="button" onclick="closeModal3()" 
                    class="w-1/3 bg-gray-100 text-gray-600 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="w-2/3 bg-blue-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 shadow-md shadow-blue-500/20 transition-all">
                    Simpan Mapel
                </button>
            </div>
        </form>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-2xl mt-6">
            <div class="px-5 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Daftar Mapel</h3>
                <span class="text-xs bg-blue-50 text-blue-600 px-2.5 py-1 rounded-full font-medium">
                    Total: {{ count($mapels) }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-500 font-semibold border-b border-gray-200 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="p-4 pl-6">Nama Mapel</th>
                            <th class="p-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-gray-600">
                        @foreach($mapels as $mapel)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-4 pl-6 font-medium text-gray-800">
                                {{ $mapel->nama_mapel }}
                            </td>
                            <td class="p-4 text-center">
                                <form method="POST" action="{{route('destroy_kelas', $mapel->id)}}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus kategori ini?')" 
                                        class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md text-xs font-medium transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if(count($mapels) === 0)
                        <tr>
                            <td colspan="2" class="text-center p-8 text-gray-400 bg-gray-50/30">
                                Belum ada kategori yang ditambahkan.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
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
        document.getElementById('modalUjian').classList.remove('hidden');
        document.getElementById('modalUjian').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modalUjian').classList.add('hidden');
        document.getElementById('modalUjian').classList.remove('flex');
    }

    // Close modal Ujian kalau klik background luar
    document.getElementById('modalUjian').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });


    // --- MODAL 2: KATEGORI ---
    function openModal1() {
        // Dipastikan menggunakan 'modalKategori' sesuai ID HTML-nya
        document.getElementById('modalKategori').classList.remove('hidden');
        document.getElementById('modalKategori').classList.add('flex');
    }

    function closeModal1() {
        document.getElementById('modalKategori').classList.add('hidden');
        document.getElementById('modalKategori').classList.remove('flex');
    }

    // Close modal Kategori kalau klik background luar
    document.getElementById('modalKategori').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal1();
        }
    });
    // --- MODAL 3: Kelas ---
    function openModal2() {
        // Dipastikan menggunakan 'modalKategori' sesuai ID HTML-nya
        document.getElementById('modalKelas').classList.remove('hidden');
        document.getElementById('modalKelas').classList.add('flex');
    }

    function closeModal2() {
        document.getElementById('modalKelas').classList.add('hidden');
        document.getElementById('modalKelas').classList.remove('flex');
    }

    // Close modal Kategori kalau klik background luar
    document.getElementById('modalKelas').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal2();
        }
    });
    // --- MODAL 3: Mapel ---
    function openModal3() {
        // Dipastikan menggunakan 'modalKategori' sesuai ID HTML-nya
        document.getElementById('modalMapel').classList.remove('hidden');
        document.getElementById('modalMapel').classList.add('flex');
    }

    function closeModal3() {
        document.getElementById('modalMapel').classList.add('hidden');
        document.getElementById('modalMapel').classList.remove('flex');
    }

    // Close modal Kategori kalau klik background luar
    document.getElementById('modalMapel').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal3();
        }
    });
</script>

<script>
const tipe = document.querySelector('[name="tipe"]');
const mapel = document.querySelector('[name="mata_pelajaran_id"]');

tipe.addEventListener('change', function() {
    if (this.value === 'cat') {
        mapel.value = '';
        mapel.setAttribute('disabled', true);
    } else {
        mapel.removeAttribute('disabled');
    }
});
</script>

@if ($errors->any())
<script>
    openModal();
</script>
@endif

</body>
</html>
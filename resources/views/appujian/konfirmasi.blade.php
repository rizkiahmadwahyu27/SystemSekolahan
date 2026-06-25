<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Ujian</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 font-sans">

    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white text-center">
            <h1 class="text-xl font-bold">Konfirmasi Data & Token</h1>
            <p class="text-xs opacity-80 mt-1">Pastikan informasi di bawah ini sudah sesuai sebelum memulai ujian.</p>
        </div>

        <div class="p-6 space-y-6">
            @if(session('error'))
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-3 text-sm font-medium">
                    <i class="fa-solid fa-circle-exclamation text-lg"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Identitas Peserta</span>
                    <div class="font-bold text-slate-800">{{ $siswa->nama }}</div>
                    <div class="text-xs text-slate-500 font-mono">{{ $siswa->no_peserta }}</div>
                    <div class="text-xs text-slate-500 font-medium">Kelas: {{ $siswa->kelas }}</div>
                </div>

                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Informasi Ujian</span>
                    <div class="font-bold text-blue-700">{{ $ujian->nama_ujian }}</div>
                    <div class="text-xs text-slate-600 font-medium">Mata Pelajaran: {{ $ujian->mataPelajaran->nama_mapel ?? '-' }}</div>
                    <div class="text-xs text-slate-600 font-medium">Alokasi Waktu: <strong class="text-slate-800">{{ $ujian->durasi }} Menit</strong></div>
                </div>
            </div>

            <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-2xl text-xs space-y-1">
                <div class="font-bold flex items-center gap-1.5 mb-1 text-sm text-amber-900">
                    <i class="fa-solid fa-triangle-exclamation"></i> PENTING UNTUK DIPERHATIKAN:
                </div>
                <p>1. Jangan menutup browser atau berpindah tab setelah ujian dimulai.</p>
                <p>2. Pastikan koneksi internet Anda stabil selama pengerjaan berlangsung.</p>
                <p>3. Sistem mendeteksi aktivitas kecurangan secara otomatis (Anti-Cheat aktif).</p>
            </div>

            <form action="{{ route('ujian.validasi-token', $ujian->id) }}" method="POST" class="space-y-4">
                @csrf
                <div class="max-w-xs mx-auto text-center">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Masukkan Token Ujian</label>
                    <input type="text" name="token_input" maxlength="6" required placeholder="CONTOH"
                        class="w-full text-center px-4 py-3 text-xl font-mono font-bold tracking-widest bg-slate-50 border-2 border-slate-200 rounded-2xl focus:outline-none focus:border-blue-600 focus:bg-white uppercase transition">
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('dashboard.ujian') }}" class="w-1/3 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold rounded-2xl text-center transition">
                        Batal
                    </a>
                    <button type="submit" class="w-2/3 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-blue-100 transition cursor-pointer">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Mulai Ujian
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
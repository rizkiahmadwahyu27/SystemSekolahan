<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta Ujian</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen font-sans">

    <nav class="bg-white border-b border-slate-100 px-6 py-4 sticky top-0 z-10 shadow-sm">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 text-white p-2 rounded-lg font-bold">CBT</div>
                <span class="font-bold text-slate-800 text-lg">Aplikasi Ujian Online</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-slate-800">{{ $siswa->nama }}</span>
                    <span class="block text-xs text-slate-400 font-mono">{{ $siswa->no_peserta }} | {{ $siswa->kelas }}</span>
                </div>
                <form action="{{ route('logout.user.ujian') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-semibold rounded-xl transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6">
        
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-6 rounded-2xl shadow-lg shadow-blue-100 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold mb-1">Halo, {{ $siswa->nama }}!</h1>
                <p class="text-sm opacity-80">Selamat datang di panel ujian. Silakan pilih ujian yang tersedia di bawah ini.</p>
            </div>
            <div class="bg-white/10 px-4 py-2 rounded-xl text-sm font-mono backdrop-blur-sm">
                <i class="fa-solid fa-calendar-day mr-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-clipboard-list text-blue-600"></i> Daftar Ujian Anda
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($ujians as $ujian)
            @php
                $isBelumMulai = $now->lt($ujian->mulai);
                $isSelesai = $now->gt($ujian->selesai);
                $isAktif = $now->between($ujian->mulai, $ujian->selesai);
                
                // 🟢 PERBAIKAN 1: Cek apakah siswa sudah mengklik selesai di data hasilUjians
                $hasilSiswa = $ujian->hasilUjians->first();
                $sudahMengerjakan = ($hasilSiswa && $hasilSiswa->selesai !== null);
            @endphp

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="flex justify-between items-start gap-2 mb-4">
                        <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-lg bg-blue-50 text-blue-700 font-mono">
                            {{ $ujian->tipe }}
                        </span>
                        
                        @if($sudahMengerjakan)
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">Selesai Dinilai</span>
                        @elseif($isBelumMulai)
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">Belum Mulai</span>
                        @elseif($isAktif)
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-700 border border-green-200 animate-pulse">Tersedia</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-700 border border-red-200">Selesai</span>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-2 leading-tight">{{ $ujian->nama_ujian }}</h3>
                    <p class="text-xs text-slate-400 mb-4 line-clamp-2">{{ $ujian->deskripsi ?? 'Tidak ada deskripsi ujian.' }}</p>

                    <div class="bg-slate-50 rounded-xl p-3.5 space-y-2 text-xs text-slate-600 mb-5 font-medium">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-clock text-slate-400 w-4"></i>
                            <span>Durasi: <strong class="text-slate-800">{{ $ujian->durasi }} Menit</strong></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-play text-slate-400 w-4"></i>
                            <span>Mulai: {{ $ujian->mulai->format('d M Y - H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-stop text-slate-400 w-4"></i>
                            <span>Selesai: {{ $ujian->selesai->format('d M Y - H:i') }} WIB</span>
                        </div>
                    </div>
                </div>

                <div>
                    @if($sudahMengerjakan)
                        <button disabled class="w-full py-2.5 bg-indigo-50 text-indigo-500 text-sm font-bold rounded-xl cursor-not-allowed text-center flex items-center justify-center gap-2 border border-indigo-100">
                            <i class="fa-solid fa-circle-check"></i> Sudah Dikerjakan
                        </button>
                    @elseif($isBelumMulai)
                        <button disabled class="w-full py-2.5 bg-slate-100 text-slate-400 text-sm font-bold rounded-xl cursor-not-allowed text-center">
                            Belum Waktunya
                        </button>
                    @elseif($isAktif)
                        <a href="{{ route('ujian.konfirmasi', $ujian->id) }}" 
                        class="block w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md shadow-blue-50 text-center transition">
                            Ikuti Ujian <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    @else
                        <button disabled class="w-full py-2.5 bg-red-50 text-red-400 text-sm font-bold rounded-xl cursor-not-allowed text-center">
                            Waktu Habis / Ditutup
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 bg-white rounded-2xl border border-dashed border-slate-200 p-12 text-center text-slate-400">
                <i class="fa-solid fa-folder-open text-4xl mb-3 block opacity-50"></i>
                <p class="text-sm italic">Belum ada jadwal ujian aktif untuk kelas Anda saat ini.</p>
            </div>
        @endforelse
    </div>
    </main>

</body>
</html>
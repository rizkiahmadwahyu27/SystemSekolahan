<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Skor Ujian - {{ $ujian->nama_ujian }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: white !important; }
            .print-card { border: none !important; shadow: none !important; }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 md:p-6 font-sans">

    <div class="print-card w-full max-w-xl bg-white rounded-3xl border border-slate-200 shadow-xl p-6 md:p-8 text-center relative overflow-hidden">
        
        <div class="no-print absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-emerald-500"></div>

        <div class="no-print w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-emerald-100">
            <i class="fa-solid fa-graduation-cap text-3xl text-emerald-600 animate-bounce"></i>
        </div>

        <h1 class="text-2xl font-black text-slate-800 tracking-tight">HASIL SKOR SIMULASI CAT</h1>
        <p class="text-slate-500 text-sm mt-1 mb-6 border-b border-dashed border-slate-200 pb-4 uppercase font-semibold">
            {{ $ujian->nama_ujian }}
        </p>

        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 text-left space-y-2.5 mb-6 text-sm">
            <div class="flex justify-between">
                <span class="text-slate-400 font-medium">Nama Peserta</span>
                <span class="text-slate-700 font-bold tracking-wide">{{ $siswa->nama ?? 'Nama Siswa' }}</span>
            </div>
            <div class="flex justify-between border-t border-slate-200/60 pt-2">
                <span class="text-slate-400 font-medium">Nomor Peserta</span>
                <span class="text-slate-700 font-mono font-bold">{{ $siswa->no_peserta }}</span>
            </div>
            <div class="flex justify-between border-t border-slate-200/60 pt-2">
                <span class="text-slate-400 font-medium">Waktu Selesai</span>
                <span class="text-slate-700 font-medium">{{ now()->translatedFormat('d F Y - H:i') }} WIB</span>
            </div>
        </div>

        <div class="my-8 relative inline-flex items-center justify-center">
            <div class="w-36 h-36 rounded-full bg-slate-900 flex flex-col items-center justify-center border-4 border-slate-800 shadow-lg shadow-slate-900/10">
                <span class="text-xs font-bold text-slate-400 tracking-widest uppercase">SKOR AKHIR</span>
                <span class="text-4xl font-black text-white mt-1">{{ $nilai }}</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mb-8">
            <div class="bg-emerald-50/50 border border-emerald-100 rounded-2xl p-3.5 text-center">
                <span class="block text-xs font-bold text-emerald-600 uppercase tracking-wider mb-0.5">Jawaban Benar</span>
                <span class="text-xl font-black text-emerald-700">{{ $jumlahBenar }} <span class="text-xs font-semibold text-emerald-500">Soal</span></span>
            </div>
            <div class="bg-slate-50 border border-slate-200/60 rounded-2xl p-3.5 text-center">
                <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-0.5">Total Soal</span>
                <span class="text-xl font-black text-slate-700">{{ $totalSoal }} <span class="text-xs font-semibold text-slate-400">Soal</span></span>
            </div>
        </div>

        <div class="no-print space-y-3">
            <button onclick="window.print()" class="w-full py-3.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 flex items-center justify-center gap-2 cursor-pointer transition">
                <i class="fa-solid fa-cloud-arrow-down"></i> Unduh / Cetak Hasil Hasil
            </button>
            
            <a href="{{ route('ujian.login') }}" class="w-full py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl flex items-center justify-center gap-2 cursor-pointer transition text-sm">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar Dari Sesi & Aplikasi
            </a>
        </div>

        <p class="hidden print:block text-[10px] text-slate-400 mt-8 italic border-t pt-2">
            Dokumen ini dicetak otomatis secara sah oleh Sistem Aplikasi CBT Sekolah.
        </p>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Peserta Ujian</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen font-sans select-none">

    <div id="loginCard" class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 mx-4">
        
        <div class="text-center mb-6">
            <div class="bg-blue-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200">
                <i class="fa-solid fa-graduation-cap text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-800">Portal Ujian Online</h2>
            <p class="text-slate-500 text-sm mt-1">Silakan masuk menggunakan data peserta Anda</p>
        </div>

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-3 text-sm">
                <i class="fa-solid fa-circle-xmark text-lg"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form id="loginForm" action="{{ route('login.user.ujian') }}" method="POST" class="space-y-5">
            @csrf 
            <div>
                <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" 
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                </div>
            </div>

            <div>
                <label for="no_peserta" class="block text-sm font-semibold text-slate-700 mb-2">Nomor Peserta</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <input type="text" id="no_peserta" name="no_peserta" required value="{{ old('no_peserta') }}" placeholder="Contoh: REG-2026-001" 
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                </div>
                @error('no_peserta')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password / Token</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" id="password" name="password" required placeholder="Masukkan password" 
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all duration-200">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 flex gap-3 items-start">
                <i class="fa-solid fa-circle-exclamation text-amber-600 mt-0.5"></i>
                <p class="text-xs text-amber-800 leading-relaxed">
                    Sistem mendeteksi kecurangan. Meminimalkan halaman ujian atau membuka tab baru dapat membuat Anda keluar dari ujian secara otomatis.
                </p>
            </div>

            <button type="submit" 
                class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-200 cursor-pointer text-center">
                Mulai Ujian & Masuk Fullscreen <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
            </button>
        </form>

        <div class="text-center mt-8 pt-4 border-t border-slate-100 text-xs text-slate-400">
            &copy; 2026 Aplikasi Ujian Online v2.0. All rights reserved.
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('loginForm');

        function masukFullscreen() {
            const elem = document.documentElement;
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        }

        // Event listener saat form disubmit
        loginForm.addEventListener('submit', function(e) {
            // 1. Jalankan layar penuh terlebih dahulu
            masukFullscreen();

            // 2. Kunci Utama: JANGAN gunakan e.preventDefault(). 
            // Biarkan browser meneruskan data ini ke Controller Laravel secara alami.
        });

        // Blokir klik kanan demi keamanan dasar
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
</body>
</html>
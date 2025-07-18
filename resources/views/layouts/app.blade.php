<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aplikasi Sekolahan') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>[x-cloak] { display: none !important; }</style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-mono bg-orange-600 min-h-screen">
    @include('layouts.navigation')

    <!-- Sidebar for Desktop -->
    <aside class="hidden md:flex fixed top-0 left-0 h-screen w-56 bg-gray-200 text-orange-800 flex-col p-2 justify-start items-center gap-6">
        <div class="font-bold text-lg mt-8 flex justify-center items-center">
            SMK Pelita
        </div>
        <nav class="flex flex-col gap-4 shadow-lg p-2 bg-white rounded-md w-full max-w-xs">
            <!-- Panel 1 -->
            <div class="border border-gray-200 rounded p-4 gap-4">
                <div class="flex justify-start items-center gap-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                    <div>
                        <a href="{{ route('guru.index') }}" class="block py-1 text-sm hover:text-orange-500">Dashboard</a>
                    </div>
                </div>
                <div class="flex justify-start items-center gap-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                        </svg>
                    </div>
                    <div>
                        <a href="{{ route('data_siswa') }}" class="block py-1 text-sm hover:text-orange-500">Data Siswa</a>
                    </div>
                </div>
                <div class="flex justify-start items-center gap-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                    <div>
                        <a href="{{ route('data_kelas') }}" class="block py-1 text-sm hover:text-orange-500">Data Kelas</a>
                    </div>
                </div>
                <div class="flex justify-start items-center gap-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <div>
                        <a href="{{route('data_pegawai')}}" class="block py-1 text-sm hover:text-orange-500">Data Guru & Staff</a>
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 rounded">
                <button onclick="toggleAccordion('panel1', 'icon-panel1')" class="w-full px-4 py-2 flex justify-between items-center text-left font-semibold text-orange-700">
                    App Absen
                    <svg id="icon-panel1" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="panel1" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out pl-4">
                    <a href="{{ route('data_absen') }}" class="block py-1 text-sm hover:text-orange-500">Data Absensi</a>
                    <a href="#" class="block py-1 text-sm hover:text-orange-500">Konfigurasi</a>
                </div>
            </div>

            <!-- Panel 2 -->
            <div class="border border-gray-200 rounded">
                <button onclick="toggleAccordion('panel2', 'icon-panel2')" class="w-full px-4 py-2 flex justify-between items-center text-left font-semibold text-orange-700">
                    App Arsip
                    <svg id="icon-panel2" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="panel2" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out pl-4">
                    <a href="#" class="block py-1 text-sm hover:text-orange-500">Link A</a>
                    <a href="#" class="block py-1 text-sm hover:text-orange-500">Link B</a>
                </div>
            </div>
            <div class="border border-gray-200 rounded">
                <button onclick="toggleAccordion('panel3', 'icon-panel3')" class="w-full px-4 py-2 flex justify-between items-center text-left font-semibold text-orange-700">
                    App E-raport
                    <svg id="icon-panel3" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="panel3" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out pl-4">
                    <a href="#" class="block py-1 text-sm hover:text-orange-500">Link A</a>
                    <a href="#" class="block py-1 text-sm hover:text-orange-500">Link B</a>
                </div>
            </div>
            <div class="border border-gray-200 rounded">
                <button onclick="toggleAccordion('panel4', 'icon-panel4')" class="w-full px-4 py-2 flex justify-between items-center text-left font-semibold text-orange-700">
                    App E-Learning
                    <svg id="icon-panel4" class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="panel4" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out pl-4">
                    <a href="#" class="block py-1 text-sm hover:text-orange-500">Link A</a>
                    <a href="#" class="block py-1 text-sm hover:text-orange-500">Link B</a>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Bottom Navbar for Mobile -->
    <nav class="md:hidden fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 flex justify-around py-2 z-50">
        <a href="#" class="flex flex-col items-center text-orange-800 hover:text-orange-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" ...></svg>
            <span class="text-xs">Dashboard</span>
        </a>
        <a href="{{ route('data_siswa') }}" class="flex flex-col items-center text-orange-800 hover:text-orange-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" ...></svg>
            <span class="text-xs">Siswa</span>
        </a>
        <a href="{{ route('data_kelas') }}" class="flex flex-col items-center text-orange-800 hover:text-orange-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" ...></svg>
            <span class="text-xs">Kelas</span>
        </a>
        <a href="{{ route('data_absen') }}" class="flex flex-col items-center text-orange-800 hover:text-orange-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" ...></svg>
            <span class="text-xs">Absen</span>
        </a>
        <a href="#" class="flex flex-col items-center text-orange-800 hover:text-orange-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" ...></svg>
            <span class="text-xs">Setting</span>
        </a>
    </nav>

    <!-- Main Content -->
    <main class="pt-6 pb-16 md:pl-60 p-2">
        {{ $slot }}
    </main>

    @vite(['resources/js/script.js'])
    @livewireScripts
    <script>
        function toggleAccordion(panelId, iconId) {
            const panel = document.getElementById(panelId);
            const icon = document.getElementById(iconId);
            const isOpen = panel.classList.contains('max-h-96');

            // Tutup semua panel
            document.querySelectorAll('[id^="panel"]').forEach(p => {
                p.classList.remove('max-h-96');
                p.classList.add('max-h-0');
            });
            document.querySelectorAll('[id^="icon-panel"]').forEach(i => {
                i.classList.remove('rotate-180');
            });

            // Buka jika belum terbuka
            if (!isOpen) {
                panel.classList.remove('max-h-0');
                panel.classList.add('max-h-96');
                icon.classList.add('rotate-180');
            }
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aplikasi_Sekolahan</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css”> 
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}
        </style>
        <style>
          .bg-cover {
            background-image: url("/img/foto_smk (5).jpeg");
            background-repeat: no-repeat;
            background-position: center 75%;
            width: 100%;
            height: 76vh;
            opacity: 65%;
          }
        </style>
    </head>
   
<body class="bg-gray-100 font-sans">
  @php
      if (Auth::check()) {
          $url = Auth::user()->level . '/dashboard';
      }
  @endphp
  <!-- Navbar -->
  <nav class="bg-orange-500 text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <!-- Logo -->
        <div class="flex flex-shrink-0 justify-center items-center">
          <a href="#" class="text-xl font-bold">SMK Pelita Jatibarang</a>
        </div>

        <!-- Menu desktop -->
        <div class="hidden md:flex space-x-6">
          <a href="#tentang" class="hover:text-orange-100 transition">Tentang</a>
          <a href="#gallery" class="hover:text-orange-100 transition">Gallery</a>
          <a href="#fasilitas" class="hover:text-orange-100 transition">Fasilitas</a>
          <a href="#testimoni" class="hover:text-orange-100 transition">Testimoni</a>
          <a href="#kontak" class="hover:text-orange-100 transition">Kontak</a>
        </div>

        <!-- CTA Button -->
        <div class="hidden md:block">
          <div class="flex justify-center items-center">
            @if (Auth::user())
               <div class="mr-2"><a href="{{$url}}" class="bg-white text-orange-500 px-4 py-2 rounded hover:bg-orange-100 transition font-medium">Dashboard</a></div> 
            @else
                <div class="mr-2"><a href="{{ route('register') }}" class="bg-white text-orange-500 px-4 py-2 rounded hover:bg-orange-100 transition font-medium">Daftar</a></div>
                <div><a href="{{ route('login') }}" class="bg-white text-orange-500 px-4 py-2 rounded hover:bg-orange-100 transition font-medium">Masuk</a></div>
            @endif
          </div>
        </div>

        <!-- Mobile button -->
        <div class="md:hidden">
          <button id="menu-toggle" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden flex-col px-4 pb-4 bg-orange-500 text-white space-y-2 transition-all duration-300">
      <a href="#tentang" class="block py-2 border-b border-orange-300">Tentang</a>
      <a href="#gallery" class="block py-2 border-b border-orange-300">Gallery</a>
      <a href="#fasilitas" class="block py-2 border-b border-orange-300">Fasilitas</a>
      <a href="#testimoni" class="block py-2 border-b border-orange-300">Testimoni</a>
      <a href="#kontak" class="block py-2 border-b border-orange-300">Kontak</a>
      @if (Auth::user())
          <a href="{{$url}}" class="block py-2 text-center bg-white text-orange-500 rounded hover:bg-orange-100 transition font-medium mt-2">Dashboard</a>
      @else
          <a href="{{ route('register') }}" class="block py-2 text-center bg-white text-orange-500 rounded hover:bg-orange-100 transition font-medium mt-2">Daftar</a>
          <a href="{{ route('login') }}" class="block py-2 text-center bg-white text-orange-500 rounded hover:bg-orange-100 transition font-medium mt-2">Masuk</a>
      @endif
    </div>
  </nav>

  <!-- Hero -->
  <section class="bg-orange-500 text-white flex justify-center items-end py-20 text-center bg-cover">
    <div class="max-w-3xl mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-extrabold mb-4" style="text-shadow: 4px 4px 8px rgba(0,0,0,0.6);">Selamat Datang di Sekolah Kami</h1>
      <p class="text-lg md:text-2xl mb-6 font-extrabold" style="text-shadow: 4px 4px 8px rgba(0,0,0,0.6);">Mewujudkan Pendidikan Berkualitas untuk Masa Depan yang Cerah</p>
      <a href="https://docs.google.com/forms/d/e/1FAIpQLSeF9cokgmirHcY0FgQ2CWOC_67QufFZSntkS9a0AgTWp8Ffcw/viewform" target="blank" class="bg-blue-700 text-white py-2 px-6 rounded-lg font-semibold hover:bg-blue-800 transition duration-300">Daftar Sekarang</a>
    </div>
  </section>

  <!-- Tentang -->
  <section id="tentang" class="py-20 bg-white">
    <div class="max-w-screen-md mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center text-orange-500 mb-6">Tentang Kami</h2>
      <div class="grid grid-cols-1 gap-3">
        <div class="rounded-xl shadow-xl p-5">
          <div class="flex justify-center items-center text-xl font-extrabold border-b-2 border-gray-400">Visi</div>
          <div class="flex justify-center items-center text-center text-sm font-bold mt-2">
            Menjadikan Lembaga Pendidikan dan Pelatihan 
            Bisnis dan Manajemen serta Teknologi Informasi 
            dan Komunikasi dalam mewujudkan lulusan yang 
            berbudi pekerti, kerja keras, inovatif dan 
            berakhlak mulia dalam rangka menciptakan 
            Sumber Daya Manusia yang Berkualitas.
          </div>
        </div>
        <div class="rounded-xl shadow-xl p-5">
          <div class="flex justify-center items-center text-xl font-extrabold border-b-2 border-gray-400">Misi</div>
          <div class="flex justify-between text-sm font-bold mt-2">
            <div>
              <div class="flex justify-between">
                <p class="mr-1">1. </p>
                <p class="flex justify-start">Mendidik dan melatih tenaga kerja terampil tingkat menengah dalam bidang keahlian bisnis dan Manajemen serta Informatika dan Komunikasi.</p>
              </div>
              <div class="flex justify-between">
                <p class="mr-1">2. </p>
                <p class="flex justify-start">Membekali tamatan dengan Ilmu Pengetahuan dan Keterampilan, Kejujuran yang berjiwa profesional dan mandiri.</p>
              </div>
              <div class="flex justify-between">
                <p class="mr-1">3. </p>
                <p class="flex justify-start">Menjalin kemitraan yang baik dengan pihak terkait dalam upaya mengembangkan dan meningkatkan kualitas sekolah dan tamatan.</p>
              </div>
              <div class="flex justify-between">
                <p class="mr-1">4. </p>
                <p class="flex justify-start">Mewujudkan kualitas siswa yang memiliki kemampuan berpikir kritis, kreatif, inovatif, menyelesaikan masalah dan berjiwa kewirausahaan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Gallery --}}
   <section id="gallery" class="py-20 bg-gray-50 text-center">
    <div class="max-w-screen-xl mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-orange-500 mb-12">Gallery</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <img src="{{asset('/img/foto_smk (1).jpeg')}}" alt="" srcset="">
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <img src="{{asset('/img/foto_smk (2).jpeg')}}" alt="" srcset="">
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <img src="{{asset('/img/foto_smk (3).jpeg')}}" alt="" srcset="">
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <img src="{{asset('/img/foto_smk (4).jpeg')}}" alt="" srcset="">
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <img src="{{asset('/img/foto_smk (5).jpeg')}}" alt="" srcset="">
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <img src="{{asset('/img/foto_smk (6).jpeg')}}" alt="" srcset="">
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <img src="{{asset('/img/foto_smk (7).jpeg')}}" alt="" srcset="">
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <img src="{{asset('/img/foto_smk (8).jpeg')}}" alt="" srcset="">
        </div>
      </div>
    </div>
  </section>
  <!-- Fasilitas -->
  <section id="fasilitas" class="py-20 bg-gray-50 text-center">
    <div class="max-w-screen-xl mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-orange-500 mb-12">Fasilitas Kami</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold text-orange-500 mb-3">Kelas Modern</h3>
          <p class="text-gray-700">Ruang kelas yang nyaman dengan teknologi terkini.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold text-orange-500 mb-3">Laboratorium</h3>
          <p class="text-gray-700">Laboratorium lengkap untuk mendukung pembelajaran praktis.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
          <h3 class="text-xl font-semibold text-orange-500 mb-3">Fasilitas Olahraga</h3>
          <p class="text-gray-700">Lapangan dan sarana olahraga untuk aktivitas fisik siswa.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimoni -->
  <section id="testimoni" class="py-20 bg-white text-center">
    <div class="max-w-screen-xl mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-orange-500 mb-12">Apa Kata Mereka?</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-100 p-6 rounded-lg shadow">
          <p class="italic text-gray-700">"Sekolah ini membantu saya tumbuh dan belajar dengan baik."</p>
          <h4 class="mt-4 font-semibold text-orange-500">Siswa Kelas X</h4>
        </div>
        <div class="bg-gray-100 p-6 rounded-lg shadow">
          <p class="italic text-gray-700">"Guru yang peduli dan fasilitas yang lengkap."</p>
          <h4 class="mt-4 font-semibold text-orange-500">Orang Tua Wali</h4>
        </div>
        <div class="bg-gray-100 p-6 rounded-lg shadow">
          <p class="italic text-gray-700">"Saya bangga pernah menjadi bagian dari sekolah ini."</p>
          <h4 class="mt-4 font-semibold text-orange-500">Alumni SMK Pelita Jatibarang</h4>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak -->
  <section id="kontak" class="py-20 bg-orange-500 text-white text-center">
    <div class="max-w-screen-md mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Hubungi Kami</h2>
      <p class="text-lg mb-6">Ingin tahu lebih banyak? Kami siap membantu Anda.</p>
      <a href="https://wa.me/6287848294127?text=saya%20mau%20daftar%20bagaimana%20caranya?" target="blank" class="bg-white text-orange-500 py-2 px-6 rounded-lg font-semibold hover:bg-orange-200 transition">Kirim Pesan</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white text-center py-6">
    <p>&copy; 2025 SMK Pelita Jatibarang. Semua Hak Dilindungi.</p>
  </footer>

  <!-- Mobile Menu Toggle Script -->
  <script>
    const toggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("mobile-menu");

    toggle.addEventListener("click", () => {
      menu.classList.toggle("hidden");
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success', 
                title: 'Berhasil!',
                text: {!! json_encode(session('success')) !!}, // Pastikan menggunakan json_encode untuk amannya
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: {!! json_encode(session('error')) !!},
                showConfirmButton: true,
            });
        </script>
    @endif
</body>
</html>


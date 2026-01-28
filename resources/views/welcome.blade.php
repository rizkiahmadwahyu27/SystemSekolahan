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
            filter: brightness(0.7);
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
          <a href="#beranda" class="hover:text-orange-100 transition">Beranda</a>
          <a href="#news" class="spelza-news hover:text-orange-100 transition">Spelza News</a>
          <a href="#gallery" class="hover:text-orange-100 transition click-gallery">Gallery</a>
          <a href="#fasilitas" class="hover:text-orange-100 transition click-fasilitas" >Fasilitas</a>
          <a href="#ekstrakurikuler" class="hover:text-orange-100 transition click-ekstrakurikuler" >Ekstrakurikuler</a>
          <a href="#beasiswa" class="hover:text-orange-100 transition click-beasiswa" >Beasiswa</a>
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
      <a href="#beranda" class="block py-2 border-b border-orange-300">Beranda</a>
      <a href="#news" class="spelza-news block py-2 border-b border-orange-300">Spelza News</a>
      <a href="#gallery" class="block py-2 border-b border-orange-300 click-gallery">Gallery</a>
      <a href="#fasilitas" class="block py-2 border-b border-orange-300 click-fasilitas" >Fasilitas</a>
      <a href="#ekstrakurikuler" class="block py-2 border-b border-orange-300 click-ekstrakurikuler" >Ekstrakurikuler</a>
      <a href="#beasiswa" class="block py-2 border-b border-orange-300 click-beasiswa" >Beasiswa</a>
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
  <section id="beranda" class="relative h-[70vh] overflow-hidden">

    <!-- BACKGROUND SAJA -->
    <div
        class="absolute inset-0 bg-cover">
    </div>

    <!-- OVERLAY GELAP (HANYA KENA BG) -->
    <div class="absolute inset-0 bg-black/40"></div>

    <!-- KONTEN (TIDAK TERKENA APA PUN) -->
    <div class="relative z-10 h-full flex justify-center items-start py-20 text-center text-white">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
                Selamat Datang di Sekolah Kami
            </h1>
            <p class="text-lg md:text-2xl mb-6 font-extrabold">
                Mewujudkan Pendidikan Berkualitas untuk Masa Depan yang Cerah
            </p>
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSeF9cokgmirHcY0FgQ2CWOC_67QufFZSntkS9a0AgTWp8Ffcw/viewform"
               target="_blank"
               class="inline-block bg-blue-700 py-2 px-6 rounded-lg font-semibold hover:bg-blue-800 transition">
                Daftar Sekarang
            </a>
        </div>
    </div>

  </section>

  <!-- Tentang -->
  <section class="py-20 bg-white">
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
  {{-- {{spelza news}} --}}
  <section id="news" class="py-20 bg-gray-50 hidden">
    <div class="max-w-screen-xl mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-orange-500 mb-12">Spelza News</h2>
      <div class="grid grid-cols-1 gap-1 md:grid-cols-3">
        <div class="p-2 rounded-lg shadow-md">
          <div class="flex justify-center items-center">
            <video
                controls
                class="w-full max-w-xl mx-auto rounded-lg shadow"
              >
                <source src="{{ asset('/img/ajakan ppdb lucky.mp4') }}" type="video/mp4">
                Browser kamu tidak mendukung video.
              </video>
          </div>
        </div>
        <div class="col-span-2 p-2 rounded-lg shadow-md">
          <div class="p-5">
            <span class="md:text-lg text-sm font-semibold text-gray-600">
              Bersama Bapak Bupati Indramayu Bapak Lucky Hakim, SMK Pelita Jatibarang mengajak bapak/ibu di sekitar wilayah Indramayu khususnya Kecamatan Jatibarang dan sekitarnya untuk menyekolahkan putra & putrinya di SMK Pelita Jatibarang.
            </span>
            <p class="mt-2">
              Kegiatan ini diambil dalam rangka kunjungan Bapak Bupati Indramayu Bapak Lucky Hakim ke sekolah-sekolah di wilayah Indramayu khususnya SMK (Sekolah Menengah Kejuruan), serta meninjau kualitas lulusan dalam menghadapai perkembangan globalisasi
            </p>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-1 md:grid-cols-3 mt-5">
        <div class="p-2 rounded-lg shadow-md">
          <div class="flex justify-center items-center">
            <div class="relative w-full max-w-3xl h-64 mx-auto overflow-hidden rounded-xl">
              <img src="{{ asset('/img/panen karya.jpg') }}"
                  class="slide absolute w-full h-full object-cover opacity-100 transition-opacity duration-1000">

              <img src="{{ asset('/img/panen karya 1.jpg') }}"
                  class="slide absolute w-full h-full object-cover opacity-0 transition-opacity duration-1000">

              <img src="{{ asset('/img/panen karya 2.jpg') }}"
                  class="slide absolute w-full h-full object-cover opacity-0 transition-opacity duration-1000">
            </div>
          </div>
        </div>
        <div class="col-span-2 p-2 rounded-lg shadow-md">
          <div class="p-5">
            <span class="md:text-lg text-sm font-semibold text-gray-600">
              Panen Karya CGP Angkatan 11 Kabupaten Indramayu: SMK Pelita Jatibarang Siap Berkontribusi!
            </span>
            <p class="mt-2">
              Program Pendidikan Guru Penggerak (PGP) merupakan salah satu inisiatif unggulan Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi (Kemendikbudristek) dalam membentuk guru sebagai pemimpin pembelajaran. Salah satu momen puncak dari program ini adalah Panen Karya Guru Penggerak. Pada tahun ini, Panen Karya CGP Angkatan 11 di Kabupaten Indramayu akan diselenggarakan pada Minggu, 8 Desember 2024, bertempat di SMAN 1 Sindang.
            </p>
            
            <div class="mt-2 hidden" id="read">
              <p>Acara tersebut akan diikuti oleh para Calon Guru Penggerak (CGP) dari berbagai sekolah, termasuk empat guru dari SMK Pelita Jatibarang, yaitu:</p>
              <div class="mt-2 flex">
                <p class="mr-1">1. </p>
                <p>Ibu Septi Diah Atiningtyas, S.Pd.</p>
              </div>
              <div class="mt-2 flex">
                <p class="mr-1">2. </p>
                <p>Ibu Linda Tri Apsari, S.Pd.</p>
              </div>
              <div class="mt-2 flex">
                <p class="mr-1">3. </p>
                <p>Ibu Nur Khasanah Alfian, S.Pd.</p>
              </div>
              <div class="mt-2 flex">
                <p class="mr-1">4. </p>
                <p>Ibu Nina Duniati, S.Pd</p>
              </div>
              <p class="text-sm md:text-md font-semibold text-gray-600 mt-2">Apa Itu Panen Karya CGP?</p>
              <p class="mt-2">Panen Karya CGP adalah kegiatan puncak yang bertujuan untuk memamerkan hasil pembelajaran, inovasi, dan praktik baik yang telah dilakukan oleh para Calon Guru Penggerak selama masa pelatihan. Karya-karya yang ditampilkan mencakup berbagai inovasi pembelajaran, proyek kepemimpinan, hingga solusi kreatif untuk meningkatkan mutu pendidikan di sekolah masing-masing. </p>
              <p class="mt-2">Kegiatan ini bukan sekadar ajang unjuk karya, tetapi juga wadah berbagi inspirasi dan kolaborasi antar sesama guru. Dalam acara ini, para CGP akan mempresentasikan proyek mereka kepada rekan sejawat, pengawas, kepala sekolah, hingga masyarakat umum yang hadir.</p>
              <p class="text-sm md:text-md font-semibold text-gray-600 mt-2">Manfaat Panen Karya untuk Rekan Sejawat Guru</p>
              <p class="mt-2">Panen Karya CGP memiliki banyak manfaat, baik bagi para peserta maupun rekan sejawat guru di sekolah, diantaranya:</p>
              <div class="mt-2 flex">
                <p class="mr-1">1. </p>
                <p>Berbagi Inspirasi dan Inovasi</p>
              </div>
              <p class="ml-4">Rekan sejawat dapat mengambil ide-ide baru dari karya yang dipamerkan untuk diterapkan di kelas mereka. Hal ini akan memperkaya metode pembelajaran dan memotivasi guru lain untuk terus berinovasi.</p>
              <div class="mt-2 flex">
                <p class="mr-1">2. </p>
                <p>Penguatan Jaringan Kolaborasi</p>
              </div>
              <p class="ml-4">Kegiatan ini mempertemukan guru-guru dari berbagai sekolah, sehingga membuka peluang kolaborasi dalam pengembangan program pendidikan yang lebih baik.</p>
              <div class="mt-2 flex">
                <p class="mr-1">3. </p>
                <p>Pemahaman tentang Kepemimpinan Pembelajaran</p>
              </div>
              <p class="ml-4">Rekan sejawat dapat belajar bagaimana seorang Guru Penggerak memimpin perubahan di sekolah, termasuk bagaimana mengelola tantangan dalam implementasi inovasi.</p>
              <div class="mt-2 flex">
                <p class="mr-1">4. </p>
                <p>Motivasi untuk Mengikuti Program PGP</p>
              </div>
              <p class="ml-4">Dengan menyaksikan hasil karya CGP, guru-guru lain akan termotivasi untuk mengikuti jejak mereka, sehingga semakin banyak guru yang terlibat dalam program ini dan berkontribusi pada transformasi pendidikan.</p>
              <p class="text-sm md:text-md font-semibold text-gray-600 mt-2">Persiapan Tim CGP SMK Pelita Jatibarang</p>
              <p class="mt-2">
                Empat guru dari SMK Pelita Jatibarang telah mempersiapkan karya mereka dengan matang, mulai dari perencanaan hingga eksekusi proyek di sekolah. Dalam kegiatan Panen Karya nanti, mereka akan mempresentasikan hasil kerja keras yang mencerminkan semangat kepemimpinan pembelajaran.
              </p>
              <p class="mt-2">
                Proses persiapan melibatkan refleksi mendalam terhadap tantangan yang dihadapi di lingkungan pendidikan, pengembangan solusi kreatif, hingga penerapan nyata di kelas atau komunitas sekolah. Dukungan dari rekan sejawat, kepala sekolah, dan komunitas pendidikan di SMK Pelita Jatibarang juga menjadi salah satu kunci keberhasilan mereka.
              </p>
              <p class="mt-2">
                Selain menampilkan karya mereka sebagai seorang guru, 4 orang CGP di SMKS Pelita Jatibarang juga akan menampilkan karya seni dari kelas masing-masing, salah satunya dari kelas 2 yang diikuti oleh Ibu Septi Diah A, Ibu Linda Tri A, dan Ibu Nur Khasanah A yang akan menampilkan persembahan tari, lagu, dan puisi yang berjudul Wonderland Indonesia dan dari kelas 8 ada Ibu Nina yang akan menampilkan paduan suara beserta rekan-rekan sekelasnya. 
              </p>
              <p class="mt-2">
                Panen Karya CGP bukan hanya momen apresiasi atas perjuangan para guru penggerak, tetapi juga sarana untuk menyebarkan manfaat lebih luas kepada dunia pendidikan. Dengan semangat kolaborasi, kegiatan ini diharapkan dapat membawa dampak positif, tidak hanya bagi CGP dan rekan sejawat, tetapi juga untuk seluruh ekosistem pendidikan di Kabupaten Indramayu.
              </p>
              <p class="mt-2">
                Mari kita dukung dan apresiasi perjuangan para Calon Guru Penggerak, termasuk guru-guru dari SMK Pelita Jatibarang, yang telah berkomitmen membawa perubahan positif bagi pendidikan Indonesia!
              </p>
            </div>
            <button id="read_more" type="button" class="py-1.5 px-2 rounded-md bg-blue-300 mt-2 hover:bg-blue-400 text-white">Read More...</button>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-1 md:grid-cols-3 mt-5">
        <div class="p-2 rounded-lg shadow-md">
          <div class="flex justify-center items-center">
            <div class="relative w-full max-w-3xl h-64 mx-auto overflow-hidden rounded-xl">
              <img src="{{ asset('/img/kegiatan praktik.jpg') }}"
                  class="slide1 absolute w-full h-full object-cover opacity-100 transition-opacity duration-1000">

              <img src="{{ asset('/img/foto-praktik (1).jpeg') }}"
                  class="slide1 absolute w-full h-full object-cover opacity-0 transition-opacity duration-1000">

              <img src="{{ asset('/img/foto-praktik (2).jpeg') }}"
                  class="slide1 absolute w-full h-full object-cover opacity-0 transition-opacity duration-1000">
              <img src="{{ asset('/img/foto-praktik (3).jpeg') }}"
                  class="slide1 absolute w-full h-full object-cover opacity-0 transition-opacity duration-1000">
              <img src="{{ asset('/img/foto-praktik (4).jpeg') }}"
                  class="slide1 absolute w-full h-full object-cover opacity-0 transition-opacity duration-1000">
            </div>
          </div>
        </div>
        <div class="col-span-2 p-2 rounded-lg shadow-md">
          <div class="p-5">
            <span class="md:text-lg text-sm font-semibold text-gray-600">
              SAS/PAS PRAKTIK JAUHH LEBIH MENYENANGKAN LOH...
            </span>
            <p class="mt-2">
              Sekolah Menengah Kejuruan (SMK) memiliki peran penting dalam menyiapkan generasi muda untuk siap menghadapi tantangan dunia kerja melalui pendidikan yang berbasis keterampilan. Salah satu tahap penting dalam proses pembelajaran di SMK adalah penilaian akhir semester, yang bertujuan untuk mengukur sejauh mana kompetensi siswa dalam bidang keahlian yang telah diajarkan. Di SMK Pelita Jatibarang Kabupaten Indramayu, pelaksanaan <span class="font-bold"> Sumatif Akhir Semester (SAS)</span> dan <span class="font-bold">Penilaian Akhir Semester (PAS)</span> pada tahun ajaran 2024/2025 dilaksanakan dari tanggal 2 hingga 5 Desember 2024.
            </p>
            
            <div class="mt-2 hidden" id="read1">
              <p>
                Penilaian kali ini dirancang dengan metode yang lebih inovatif dan kolaboratif, mengingat pentingnya penguasaan keterampilan praktis yang relevan dengan kebutuhan industri. Dengan melibatkan sistem ujian praktik yang meliputi <span class="font-bold">jobsheet, proyek, dan praktik langsung</span>, SMK Pelita Jatibarang bertujuan untuk memberikan kesempatan kepada siswa untuk menunjukkan kemampuannya secara nyata. Kolaborasi antar guru dari berbagai bidang keahlian juga menjadi bagian penting dalam memastikan proses penilaian berjalan secara objektif dan menyeluruh. Melalui pendekatan ini, diharapkan siswa tidak hanya menguasai teori, tetapi juga siap untuk menghadapi dunia profesional dengan keterampilan yang mumpuni.
              </p>
              <p class="mt-2 font-bold text-md">
                Metode Penilaian Praktik
              </p>
              <p>
                Penilaian praktik di SMK Pelita Jatibarang mengadopsi pendekatan kolaboratif antar guru untuk memastikan objektivitas dan keberagaman dalam mengevaluasi keterampilan siswa. Sistem penilaian yang diterapkan terdiri dari tiga metode utama:
              </p>
              <div class="mt-2 flex">
                <p class="mr-1">1. </p>
                <p>Jobsheet</p>
              </div>
              <p class="ml-4">Pada metode ini, siswa akan diberi tugas atau pekerjaan yang berbentuk sheet atau lembar kerja yang harus diselesaikan dalam waktu tertentu. Jobsheet ini menguji pemahaman siswa terhadap teori dan praktik yang telah mereka pelajari. Proses ini menggabungkan elemen praktis dengan aspek penulisan atau dokumentasi.</p>
              <div class="mt-2 flex">
                <p class="mr-1">2. </p>
                <p>Proyek</p>
              </div>
              <p class="ml-4">Siswa akan diberikan proyek yang harus diselesaikan dalam periode tertentu. Proyek ini bertujuan untuk mengukur kemampuan siswa dalam merencanakan, melaksanakan, dan menyelesaikan sebuah tugas yang relevan dengan bidang keahlian mereka. Proyek ini dapat berupa pembuatan produk, desain, atau tugas kelompok yang memerlukan kolaborasi antar siswa.</p>
              <div class="mt-2 flex">
                <p class="mr-1">3. </p>
                <p>Praktik Langsung</p>
              </div>
              <p class="ml-4">Sistem ujian praktik langsung akan dilakukan untuk menguji keterampilan teknis siswa secara real-time. Misalnya, untuk jurusan Teknik Komputer dan Jaringan, siswa akan diminta untuk melakukan instalasi perangkat keras atau perangkat lunak, sedangkan untuk jurusan Pemasaran, siswa akan diuji kemampuan untuk menata produk.</p>
              
              <p class="text-sm md:text-md font-semibold text-gray-600 mt-2">Kolaborasi Antar Guru</p>
              <p class="mt-2">Keunikan dari pelaksanaan ujian praktik kali ini adalah adanya kolaborasi antar guru yang mengajar mata pelajaran produktif. Guru-guru dari berbagai bidang keahlian bekerja sama dalam menyusun soal dan penilaian, serta membantu dalam proses evaluasi. Kolaborasi ini bertujuan untuk memastikan bahwa penilaian yang diberikan tidak hanya melihat dari satu sisi kompetensi siswa, tetapi juga dari berbagai sudut pandang keahlian yang relevan. Misalnya, seorang guru desain grafis mungkin juga akan memberikan umpan balik mengenai keterampilan komunikasi visual yang diterapkan dalam proyek multimedia.</p>
              
              <p class="text-sm md:text-md font-semibold text-gray-600 mt-2">Tujuan dan Harapan</p>
              <p class="mt-2">Pelaksanaan sumatif dan penilaian akhir semester ini diharapkan dapat memberikan gambaran yang lebih lengkap mengenai kompetensi siswa di bidang praktis. Selain itu, ujian ini juga bertujuan untuk:</p>
              <div class="mt-2 flex">
                <p class="mr-1">▶</p>
                <p>Meningkatkan pemahaman siswa mengenai materi yang telah dipelajari.</p>
              </div>
              
              <div class="mt-2 flex">
                <p class="mr-1">▶</p>
                <p>Mengukur sejauh mana keterampilan dan keahlian yang telah dikuasai siswa sesuai dengan standar industri.</p>
              </div>
              
              <div class="mt-2 flex">
                <p class="mr-1">▶</p>
                <p>Memberikan kesempatan bagi siswa untuk mengaplikasikan pengetahuan secara langsung di lapangan kerja.</p>
              </div>
              
              <p class="mt-2">
               Diharapkan dengan penerapan metode ini, siswa tidak hanya menguasai teori, tetapi juga mampu menghadapi tantangan dunia kerja yang membutuhkan keterampilan praktis yang tinggi. Kolaborasi antar guru juga diharapkan dapat meningkatkan kualitas penilaian dan memberikan pengalaman yang lebih mendalam bagi siswa.
              </p>
              
            </div>
            <button id="read_more1" type="button" class="py-1.5 px-2 rounded-md bg-blue-300 mt-2 hover:bg-blue-400 text-white">Read More...</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- Gallery --}}
   <section id="gallery" class="py-20 bg-gray-50 text-center hidden">
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
  <section id="fasilitas" class="py-20 bg-gray-50 text-center hidden">
    <div class="flex justify-center items-center">
      <h2 class="text-3xl md:text-4xl font-bold text-orange-500">Fasilitas</h2>
    </div>
    <div class="flex justify-center items-center">
      <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition relative w-full md:w-6/12">
        <!-- CARD CONTENT -->
        <div class="card-slider text-center"
          data-cards='[
            {
              "img": "{{ asset('/img/gedung-sekolah.png') }}",
              "title": "Gedung Sekolah",
              "desc": "Gedung SMK Pelita Jatibarang dengan tinggi 1-3 lantai"
            },
            {
              "img": "{{ asset('/img/alat-praktik.png') }}",
              "title": "Alat Praktek Mesin Kasir dan Timbangan",
              "desc": "Alat praktik yang tersedia lengkap untuk menunjang pembelajaran"
            },
            {
              "img": "{{ asset('/img/alat-praktik-press.png') }}",
              "title": "Alat Praktik Sablon Kaos",
              "desc": "Alat praktik ini digunakan untuk membuat kaos sablon yang menarik"
            },
            {
              "img": "{{ asset('/img/alat-praktik-dkv.png') }}",
              "title": "Alat Praktek Videografi, Fotografi, dan Perkantoran",
              "desc": "Diharapkan dengan kelengkapan alat praktik ini siswa menjadi lebih kreatif"
            },
            {
              "img": "{{ asset('/img/ruang-guru.png') }}",
              "title": "Ruangan Guru",
              "desc": "Ruang Guru yang Luas dan Rapih"
            },
            {
              "img": "{{ asset('/img/ruang-tu.png') }}",
              "title": "Ruangan Tata Usaha",
              "desc": "Ruangan Tata Usaha untuk proses administrasi siswa dan guru"
            },
            {
              "img": "{{ asset('/img/perpus.png') }}",
              "title": "Perpustakaan",
              "desc": "Buku-buku di perpustakaan lengkap untuk menunjangan pembelajaran"
            },
            {
              "img": "{{ asset('/img/ruang-bk.png') }}",
              "title": "Ruangan Bimbingan Konseling",
              "desc": "Ruangan BK yang rapih dan bersih"
            },
            {
              "img": "{{ asset('/img/lab-mplb.png') }}",
              "title": "Lab Kom Pemasaran",
              "desc": "Lab Komputer ini sudah dilengkapi dengan server dan internet"
            },
            {
              "img": "{{ asset('/img/lab-pm.png') }}",
              "title": "Lab Kom Perkantoran",
              "desc": "Lab Komputer ini sudah dilengkapi dengan server dan internet"
            },
            {
              "img": "{{ asset('/img/lab-dkv.png') }}",
              "title": "Lab Kom DKV & TJKT",
              "desc": "Lab Komputer ini sudah dilengkapi dengan server dan internet"
            },
            {
              "img": "{{ asset('/img/ruang-kelas.png') }}",
              "title": "Ruang Kelas",
              "desc": "Ruang kelas yang bersih dan nyaman"
            },
            {
              "img": "{{ asset('/img/mushola.png') }}",
              "title": "Tempat Ibadah",
              "desc": "Tempat ibadah yang lumayan luas dan nyaman"
            },
            {
              "img": "{{ asset('/img/uks.png') }}",
              "title": "UKS",
              "desc": "Ruang UKS digunakan untuk perawatan bagi murid yang sakit"
            },
            {
              "img": "{{ asset('/img/ruang-osis.png') }}",
              "title": "Ruang Osis",
              "desc": "Organisasi Siswa memiliki rungan sendiri"
            },
            {
              "img": "{{ asset('/img/toilet-pria.png') }}",
              "title": "Toilet Pria",
              "desc": "Toilet yang bersih dan tidak bau"
            },
            {
              "img": "{{ asset('/img/toilet-wanita.png') }}",
              "title": "Toilet Wanita",
              "desc": "Toilet yang bersih dan tidak bau"
            },
            
            {
              "img": "{{ asset('/img/kantin.png') }}",
              "title": "Kantin",
              "desc": "Kantin yang terawat dan bersih"
            },
            {
              "img": "{{ asset('/img/olahraga.png') }}",
              "title": "Perlengkapan Olahraga",
              "desc": "Perlengkapan olahraga yang lengkap"
            },
            {
              "img": "{{ asset('/img/lap-sekolah.png') }}",
              "title": "Tempat Wudhu",
              "desc": "Tempat wudhu terpisah dan terawat"
            },
            {
              "img": "{{ asset('/img/bursa-kerja.png') }}",
              "title": "Bursa Kerja",
              "desc": "Bursa Kerja disediakan untuk lulusan untuk mempercepat penerimaan pekerjaan"
            }
          ]'
          data-index="0"
        >

          <img class="card-img w-full object-cover rounded-md mb-3 transition duration-300">

          <h3 class="card-title text-md font-semibold text-orange-500"></h3>
          <p class="card-desc text-gray-700 text-xs"></p>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-between mt-3">
          <button onclick="prevCard(this)"
            class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">
            &lt;
          </button>

          <button onclick="nextCard(this)"
            class="bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">
            &gt;
          </button>
        </div>
      </div>
    </div>
  </section>
  {{-- <Ekstrakurikuler> --}}
  <section id="ekstrakurikuler" class="py-20 bg-gray-50 hidden">
    <div class="max-w-screen-md mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2 gap-0">
        <div class="shadow-lg">
          <div class="flex justify-center items-center p-1 rounded-lg">
            <img src="{{asset('/img/pramuka.jpg')}}" alt="pramuka">
          </div>
        </div>
        <div class="shadow-lg">
          <div class="text-xs md:text-sm text-gray-600 p-4 text-justify">
            <p class="text-xl font-bold mb-2">Pramuka</p>
            <p>
              Pramuka adalah salah satu organisasi kepemudaan yang memiliki banyak manfaat dan nilai bagi anggotanya. Pramuka tidak hanya mengajarkan kedisiplinan, kerja sama, dan kemandirian, tetapi juga memberikan inspirasi dan semangat untuk berkontribusi bagi masyarakat dan negara.
            </p>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2 gap-0">
        <div class="shadow-lg">
          <div class="flex justify-center items-center p-1 rounded-lg">
            <img src="{{asset('/img/pmr.jpg')}}" alt="pmr">
          </div>
        </div>
        <div class="shadow-lg">
          <div class="text-xs md:text-sm text-gray-600 p-4 text-justify">
            <p class="text-xl font-bold mb-2">Palang Merah Remaja</p>
            <p>
              Organisasi palang merah memang identik dengan aksi kemanusiaannya. Ada banyak kegiatan palang merah yang bermanfaat seperit aksi cepat tanggap ketika terjadi bencana hingga kegiatan amal lainnya yang bernilai positif. Ada begitu banyak kegiatan positif yang bisa kamu lakukan bila masuk menjadi anggota PMR ini.  
            </p>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2 gap-0">
        <div class="shadow-lg">
          <div class="flex justify-center items-center p-1 rounded-lg">
            <img src="{{asset('/img/paskibra.jpg')}}" alt="paskibra">
          </div>
        </div>
        <div class="shadow-lg">
          <div class="text-xs md:text-sm text-gray-600 p-4 text-justify">
            <p class="text-xl font-bold mb-2">Paskibra</p>
            <p>
              Tidak perlu kata kata ajakan bergabung organisasi paskibra Karena menjadi paskibra hanya untuk kalian yang kuat Kalau kamu merasa tertantang, ayo bergabung bersama kami!
            </p>
            <p class="mt-2">
              Semakin kuat seorang maka semakin besar cobaan yang akan dihadapinya. Jadilah orang kuat yang selalu peduli dengan sekitar. yang menjadi anggota Paskibra sudah diajarkan Bagaimana cara menjadi sosok yang peduli dengan sekitar.
            </p>
          </div>
        </div>
      </div>
      <div class="flex justify-center items-center mt-5 mb-3 text-center text-2xl font-bold text-gray-600">
        <h1>Pengembangan Diri Futsal</h1>
      </div>
      <div class="grid grid-cols-2 gap-2">
        <div ><img src="{{asset('/img/futsal-putra.jpg')}}" alt="futsal putra"></div>
        <div><img src="{{asset('/img/futsal-putri.png')}}" alt="futsal putri"></div>
      </div>
      <div class="mt-5 mb-3 text-justify text-xs md:text-sm">
        <p>
          Hampir sama dengan bermain sepak bola, futsal juga bertujuan mencetak gol lebih banyak supaya menjadi pemenang. Bedanya, olahraga ini berlangsung di lapangan lebih kecil, serta dimainkan dua tim dengan masing-masing menurunkan lima pemain.
        </p>
        <p class="mt-2">
          Anak futsal itu pasti punya jiwa pantang menyerah dan semangat yang nggak tergoyahkan. Karena kerja sama tim adalah kunci kejayaan tim kami.
        </p>
      </div>
      <div class="flex justify-center items-center mt-5 mb-3 text-center text-2xl font-bold text-gray-600">
        <h1>Pengembangan Diri Seni Tari</h1>
      </div>
      <div class="grid grid-cols-2 gap-2">
        <div ><img src="{{asset('/img/tari-satu.jpg')}}" alt="tari satu"></div>
        <div><img src="{{asset('/img/tari-dua.jpg')}}" alt="tari dua"></div>
      </div>
      <div class="flex justify-center items-center mt-5 mb-3 text-justify text-xs md:text-sm">
        <p>
         Tari adalah bahasa tersembunyi dari jiwa. Anda harus menari seakan tidak ada yang melihat Anda, mencintai seperti Anda tidak pernah tersakiti, bernyanyi seakan tidak ada yang mendengarkan Anda, dan hidu seakan ini adalah surga di bumi. Musik dan tari adalah dua seni yang memiliki hubungan erat. Mengapa tidak belajar menari dengan musik favorit Anda?
        </p>
      </div>
    </div>
  </section>

  <!-- Testimoni -->
  <section id="beasiswa" class="py-20 bg-gray-50 text-center hidden">
    <div class="max-w-screen-xl mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-orange-500 mb-12">Beasiswa</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
        <div class="flex justify-center items-center">
          <img 
            src="{{asset('/img/baner-beasiswa.jpg')}}"
            class="w-80 cursor-pointer transition hover:scale-105"
            onclick="openImage(this.src)"
          >
        </div>

        <div class="flex justify-center items-center">
          <img 
            src="{{asset('/img/baner-beasiswa-1.jpg')}}"
            class="w-80 cursor-pointer transition hover:scale-105"
            onclick="openImage(this.src)"
          >
        </div>

        <div class="flex justify-center items-center">
          <img 
            src="{{asset('/img/baner-beasiswa-2.jpg')}}"
            class="w-80 cursor-pointer transition hover:scale-105"
            onclick="openImage(this.src)"
          >
        </div>

        <div class="flex justify-center items-center">
          <img 
            src="{{asset('/img/baner-beasiswa-3.jpg')}}"
            class="w-80 cursor-pointer transition hover:scale-105"
            onclick="openImage(this.src)"
          >
        </div>
      </div>
      <div class="mt-10 text-blue-600 underline text-lg">
        <span>Klik untuk memperbesar gambar</span>
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
    {{-- //slide image --}}
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('.slide');
        let index = 0;

        if (slides.length === 0) return;

        setInterval(() => {
          slides[index].classList.remove('opacity-100');
          slides[index].classList.add('opacity-0');

          index = (index + 1) % slides.length;

          slides[index].classList.remove('opacity-0');
          slides[index].classList.add('opacity-100');
        }, 3000);
      });
      document.addEventListener('DOMContentLoaded', () => {
        const slide1 = document.querySelectorAll('.slide1');
        let index = 0;

        if (slide1.length === 0) return;

        setInterval(() => {
          slide1[index].classList.remove('opacity-100');
          slide1[index].classList.add('opacity-0');

          index = (index + 1) % slide1.length;

          slide1[index].classList.remove('opacity-0');
          slide1[index].classList.add('opacity-100');
        }, 3000);
      });
    </script>

    {{-- card slide  --}}
    <script>
      document.querySelectorAll('.card-slider').forEach(slider => {
        const cards = JSON.parse(slider.dataset.cards);
        slider.dataset.index = 0;
        updateCard(slider, cards, 0);
      });

      function updateCard(slider, cards, index) {
        slider.querySelector('.card-img').src = cards[index].img;
        slider.querySelector('.card-title').innerText = cards[index].title;
        slider.querySelector('.card-desc').innerText = cards[index].desc;
      }

      function nextCard(btn) {
        const slider = btn.closest('.bg-white').querySelector('.card-slider');
        const cards = JSON.parse(slider.dataset.cards);
        let index = parseInt(slider.dataset.index);

        index = (index + 1) % cards.length;
        slider.dataset.index = index;
        updateCard(slider, cards, index);
      }

      function prevCard(btn) {
        const slider = btn.closest('.bg-white').querySelector('.card-slider');
        const cards = JSON.parse(slider.dataset.cards);
        let index = parseInt(slider.dataset.index);

        index = (index - 1 + cards.length) % cards.length;
        slider.dataset.index = index;
        updateCard(slider, cards, index);
      }
    </script>


    {{-- read more --}}
    <script>
      const read_more = document.getElementById('read_more');
      const read_more1 = document.getElementById('read_more1');
      const read1 = document.getElementById('read1');

      read_more.addEventListener('click', (e) => {
        e.preventDefault();
        read.classList.toggle('hidden');

        read_more.textContent = read.classList.contains('hidden')
          ? 'Read More...'
          : 'Read Less';
      });

       read_more1.addEventListener('click', (e) => {
        e.preventDefault();
        read1.classList.toggle('hidden');

        read_more1.textContent = read1.classList.contains('hidden')
          ? 'Read More...'
          : 'Read Less';
      });
    </script>

    {{-- scale untuk klik image --}}
    <script>
      function openImage(src) {
        const overlay = document.createElement("div");
        overlay.className = `
          fixed inset-0 bg-black/80
          flex items-center justify-center
          z-[9999]
        `;
        overlay.onclick = () => overlay.remove();

        const img = document.createElement("img");
        img.src = src;
        img.className = "max-w-[95%] max-h-[95%] rounded-lg";

        overlay.appendChild(img);
        document.body.appendChild(overlay);
      }
    </script>

    {{-- navbar --}}
    
    <script>
      document.querySelectorAll('.spelza-news').forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();

          const news = document.getElementById('news');
          news.classList.remove('hidden');

          // optional: scroll
          news.scrollIntoView({ behavior: 'smooth' });
        });
      });
      document.querySelectorAll('.click-gallery').forEach(btn1 => {
        btn1.addEventListener('click', (e) => {
          e.preventDefault();

          const gallery = document.getElementById('gallery');
          gallery.classList.remove('hidden');

          // optional: scroll
          gallery.scrollIntoView({ behavior: 'smooth' });
        });
      });
      document.querySelectorAll('.click-fasilitas').forEach(btn2 => {
        btn2.addEventListener('click', (e) => {
          e.preventDefault();

          const fasilitas = document.getElementById('fasilitas');
          fasilitas.classList.remove('hidden');

          // optional: scroll
          fasilitas.scrollIntoView({ behavior: 'smooth' });
        });
      });
      document.querySelectorAll('.click-ekstrakurikuler').forEach(btn2 => {
        btn2.addEventListener('click', (e) => {
          e.preventDefault();

          const ekstrakurikuler = document.getElementById('ekstrakurikuler');
          ekstrakurikuler.classList.remove('hidden');

          // optional: scroll
          ekstrakurikuler.scrollIntoView({ behavior: 'smooth' });
        });
      });
      document.querySelectorAll('.click-beasiswa').forEach(btn2 => {
        btn2.addEventListener('click', (e) => {
          e.preventDefault();

          const beasiswa = document.getElementById('beasiswa');
          beasiswa.classList.remove('hidden');

          // optional: scroll
          beasiswa.scrollIntoView({ behavior: 'smooth' });
        });
      });
    </script>
</body>
</html>


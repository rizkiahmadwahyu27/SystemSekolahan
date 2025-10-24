<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        @media print {
            @page {
                size: 54mm 86mm;
                margin: 0;
            }
            body {
                width: 54mm;
                height: 86mm;
                margin: 0;
                padding: 0.5cm;
                font-family: Arial, sans-serif;
                font-size: 12px;
            }
            .cetak {
                display: block;
            }
            .no-print {
                display: none;
            }
        }
        .cetak {
            width: 54mm;
            height: 86mm;
            border: 1px solid #000;
            margin: auto;
            padding: 0.5cm;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
        <div class="no-print">
            <div class="w-full flex justify-center mt-2 mb-2 items-center">
                <button onclick="window.print()" class="bg-slate-400 p-2 rounded-lg z-0 sticky">Cetak</button>
                <a href="{{route('data_siswa')}}" class="bg-green-400 ml-2 p-2 rounded-lg z-0 sticky">Back</a>
            </div>
        </div>

        @foreach ($data_siswa as $siswa)
            <div class="cetak bg-orange-600 rounded-md text-xs">
                <div class="flex justify-center items-center"><h1>SMK Pelita Jatibarang</h1></div>
                <div class="flex justify-center items-center"><h2>Kartu Absensi</h2></div>
                <div class="flex justify-center items-center">
                    <div class="grid grid-cols-[auto_min-content_1fr] gap-x-2 text-sm w-full max-w-md">
                        <div class="col-span-3 text-xs border-b border-gray-600 pb-1 flex">
                            <div class="w-1/3">NIS</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">{{$siswa->nis}}</div>
                        </div>

                        <div class="col-span-3 text-xs border-b border-gray-600 pb-1 flex">
                            <div class="w-1/3">NISN</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">{{$siswa->nisn}}</div>
                        </div>

                        <div class="col-span-3 text-xs border-b border-gray-600 pb-1 flex">
                            <div class="w-1/3">Nama</div>
                            <div class="mx-2">:</div>
                            <div class="flex-1 break-words">{{$siswa->nama}}</div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center items-center mt-2">
                    {!! DNS2D::getBarcodeHTML($siswa->nis, 'QRCODE', 5.5, 5.5) !!}
                </div>
            </div>
        @endforeach
    

    @vite(['resources/js/script.js'])
</body>
</html>
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
    <link rel="preload" as="image" href="{{asset('/img/bg id card.png')}}">
    <style>
       @page {
            size: A4;
            margin: 1cm;
        }

        @media print {

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body {
                background: white;
            }

            .no-print {
                display: none !important;
            }

            .print-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 0.5cm;
                margin-bottom: 0.5cm;
                page-break-inside: avoid;
            }

            .cetak {
                width: 8.56cm;
                height: 5.39cm;
                background-image: url('/img/bg id card.png');
                background-repeat: no-repeat;
                background-size: cover;
                border: 1px solid #000;
                padding: 0.5cm;
                overflow: hidden;
            }
        }

    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @php
        $url = Auth::user()->level . '.index';
    @endphp
        <div class="no-print">
            <div class="w-full flex justify-center mt-2 mb-2 items-center">
                <button onclick="window.print()" class="bg-slate-400 p-2 rounded-lg z-0 sticky">Cetak</button>
                <a href="{{route($url)}}" class="bg-green-400 ml-2 p-2 rounded-lg z-0 sticky">Back</a>
            </div>
        </div>
        <div class="print-area">
            @foreach ($data_siswa as $siswa)
                <div class="print-row">
                    {{-- bagian depan --}}
                    <div class="cetak bg-white rounded-md text-xs w-full">
                        <div class="grid grid-cols-4">
                            <div>
                                <div class="w-14 h-9 flex justify-center items-center -mt-1">
                                    <img src="{{asset('/img/logosmk.png')}}" alt="logo smk">
                                </div>
                            </div>
                            <div class="col-span-3 -ml-7">
                                <div class="flex justify-center items-center text-[15px] font-bold -mt-4"><h1>KARTU PELAJAR</h1></div>
                                <div class="flex justify-center items-center text-[15px] font-bold"><h2>SMK PELITA JATIBARANG</h2></div>
                                <div class="flex justify-center items-center text-[9px]"><h4>Jl. Raya Bulak Komplek Kantor Camat</h4></div>
                                <div class="flex justify-center items-center text-[9px] -mt-1"><h4>Jatibarang - Indramayu Telp. (0234) 352078</h4></div>
                            </div>
                        </div>
                        <div class="w-full h-1 bg-orange-800 mb-2"></div>
                        <div class="grid grid-cols-4 gap-1">
                            <div>
                                <div class="flex justify-center items-center">
                                    <div class="w-[2.1cm] h-[3.1cm]">
                                        <img src="{{ asset('FOTO_KERTU_OSIS/' . trim($siswa->nama) . '.JPG') }}" alt="foto siswa">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="flex justify-center items-center mt-3">
                                    <div class="grid grid-cols-[auto_min-content_1fr] w-full max-w-md -mt-4">
                                        <div class="col-span-3 text-[7.5px] pb-1 flex">
                                            <div class="w-1/6">Nama</div>
                                            <div class="mx-2">:</div>
                                            <div class="flex-1 break-words">{{$siswa->nama}}</div>
                                        </div>
                                        <div class="col-span-3 text-[7.5px] pb-1 flex -mt-3">
                                            <div class="w-1/6">No. Induk</div>
                                            <div class="mx-2">:</div>
                                            <div class="flex-1 break-words">{{$siswa->nis}}</div>
                                        </div>
                                        <div class="col-span-3 text-[7.5px] pb-1 flex -mt-3">
                                            <div class="w-1/6">NISN</div>
                                            <div class="mx-2">:</div>
                                            <div class="flex-1 break-words">{{$siswa->nisn}}</div>
                                        </div>
                                        <div class="col-span-3 text-[7.5px] pb-1 flex -mt-3">
                                            <div class="w-1/6">TTL</div>
                                            <div class="mx-2">:</div>
                                            <div class="flex-1 break-words">{{$siswa->tempat_lahir}}, {{ \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') }}</div>
                                        </div>
                                        <div class="col-span-3 text-[7.5px] pb-1 flex -mt-3">
                                            <div class="w-1/6">Kelas</div>
                                            <div class="mx-2">:</div>
                                            <div class="flex-1 break-words">{{$siswa->kode_kelas}}</div>
                                        </div>
                                        <div class="col-span-3 text-[7.5px] pb-1 flex -mt-2">
                                            <div class="w-1/6">Alamat</div>
                                            <div class="mx-2">:</div>
                                            <div class="flex-1 break-words leading-tight">{{$siswa->alamat}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end items-end w-56 -mt-1">
                                    <div>
                                        <p class="text-[7px] -mt-2">Jatibarang, Januari 2026</p>
                                        <p class="text-[7px] -mt-2">Kepala Sekolah,</p>
                                        <img src="{{asset('/img/ttd_kepsek.gif')}}" alt="ttd kepsek" class="w-[58px] h-[50px] absolute -mt-3 -ml-7">
                                        <p class="text-[7px] font-bold mt-6">LINDA TRI APSARI, S.Pd</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-start items-center -mt-2 text-[7.5px] opacity-75">
                            <span class="border-b-2 border-blue-400 leading-tight font-bold text-blue-400">BERLAKU SELAMA MENJADI SISWA</span>
                        </div>
                    </div>
                    {{-- bagian belakang --}}
                    <div class="cetak bg-white rounded-md text-xs w-full">
                        <div class="grid grid-cols-2 gap-1 -mt-2 mb-1">
                            <div>
                                <div class="flex justify-center items-center text-md font-bold">
                                    TATA TERTIB
                                </div>
                                <div class="text-[7.5px] space-y-1">
                                    <div class="flex items-start">
                                        <span class="mr-1">-</span>
                                        <span>Setiap Siswa Mentaati Tata Tertib Sekolah</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="mr-1 -mt-2">-</span>
                                        <span class="-mt-2">Menjunjung Tinggi Kesopanan, Kejujuran dan Akhlak Mulia</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="mr-1 -mt-2">-</span>
                                        <span class="-mt-2">Menjaga Nama Baik Diri Sendiri, Keluarga dan Sekolah</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="mr-1 -mt-2">-</span>
                                        <span class="-mt-2">Belajar Dengan Rajin dan Bersungguh-Sungguh</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="mr-1 -mt-2">-</span>
                                        <span class="-mt-2">Setiap Siswa Wajib Mematuhi Aturan Sekolah</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-center items-center text-md font-bold">
                                    BARCODE ABSENSI
                                </div>
                                <div class="flex justify-center items-center mt-2">
                                    {!! DNS2D::getBarcodeHTML($siswa->nis, 'QRCODE', 4.9, 4.9) !!}
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center items-center -mt-1">
                            <div class="w-full h-6 bg-slate-200 opacity-45 text-[10px] font-bold rounded-lg p-1.5 flex justify-center items-center">
                                <span><i>Kartu Jangan Hilang, Jika Menemukan Harap Dikembalikan</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @vite(['resources/js/script.js'])
</body>
</html>
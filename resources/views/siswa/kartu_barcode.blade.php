<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SMK Pelita Jatibarang') }}
        </h2>
    </x-slot>

    <div class="cetak bg-white rounded-md text-xs p-4">
        <div class="flex justify-center items-center font-bold text-2xl"><h1>SMK Pelita Jatibarang</h1></div>
        <div class="flex justify-center items-center font-bold text-xl"><h2>Kartu Absensi</h2></div>
        <div class="flex justify-center items-center mt-6">
            <div class="grid grid-cols-[auto_min-content_1fr] gap-x-2 text-sm w-full max-w-md">
                <div class="col-span-3 text-sm border-b border-gray-600 pb-1 flex">
                    <div class="w-1/3">NIS</div>
                    <div class="mx-2">:</div>
                    <div class="flex-1 break-words">{{$murid->nis}}</div>
                </div>

                <div class="col-span-3 text-sm border-b border-gray-600 pb-1 flex">
                    <div class="w-1/3">NISN</div>
                    <div class="mx-2">:</div>
                    <div class="flex-1 break-words">{{$murid->nisn}}</div>
                </div>

                <div class="col-span-3 text-sm border-b border-gray-600 pb-1 flex">
                    <div class="w-1/3">Nama</div>
                    <div class="mx-2">:</div>
                    <div class="flex-1 break-words">{{$murid->nama}}</div>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center mt-5">
           <div>
                {!! DNS2D::getBarcodeHTML($murid->nis, 'QRCODE', 10.5, 10.5) !!}
                <div class="flex justify-center items-center mt-1">
                    <span>{{$murid->nis}}</span>
                </div>
           </div>
        </div>
    </div>
</x-app-layout>

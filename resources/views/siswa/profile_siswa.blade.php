<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SMK Pelita Jatibarang') }}
        </h2>
    </x-slot>

    <div class="w-full rounded-lg bg-white p-1 mb-1">
        <div class="flex justify-center items-start">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 text-slate-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </div>
        <div class="grid grid-cols-[auto_min-content_1fr] gap-x-2 text-sm w-full max-w-md">
            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">NIS</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">{{$murid->nis}}</div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">NISN</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">{{$murid->nisn}}</div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Nama</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">{{$murid->nama}}</div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Gender</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">{{$murid->jenis_kelamin}}</div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Agama</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">{{$murid->agama}}</div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Alamat</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">
                    {{$murid->alamat}}
                </div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Nama Bapak</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">
                    {{$murid->nama_ayah}}
                </div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Pekerjaan Ayah</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">
                    {{$murid->pekerjaan_ayah}}
                </div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Nama Ibu</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">
                    {{$murid->nama_ibu}}
                </div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Pekerjaan Ibu</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">
                    {{$murid->pekerjaan_ibu}}
                </div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">Alamat Ortu</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">
                    {{$murid->alamat_ortu}}
                </div>
            </div>

            <div class="col-span-3 border-b border-gray-300 pb-1 flex">
                <div class="w-1/3 font-medium">No HP/WA Ortu</div>
                <div class="mx-2">:</div>
                <div class="flex-1 break-words">
                    {{$murid->no_hp_ortu}}
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center">
            {{-- <div>
                <a href="#" onclick="confirmRedirectDelete('{{route('deleted_data_siswa', $murid->id)}}'); return false;" class="py-0.5 px-1.5 text-xs bg-red-400 hover:bg-red-500 rounded">Delete</a>
            </div> --}}
            <div class="mt-2">
                <a href="{{route('update_data_siswa', $murid->id)}}" class="flex justify-between items-center p-2 bg-blue-400 hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    <div class="ml-2">
                        <span>Update</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

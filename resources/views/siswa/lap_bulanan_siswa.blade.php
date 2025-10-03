<x-app-layout>
    <div class="w-full h-16 bg-slate-100 px-3 py-2">
        <div class="flex justify-between items-center">
            <div class="flex justify-start items-center mr-2">
                <div class="ml-5">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                    </button>
                </div>
                <div class="ml-5">
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'filter_absen_bulanan_siswa' }))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 md:size-8 text-slate-400 hover:text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @php
        $mapStatus = [
            'hadir' => ['label' => 'h', 'color' => 'bg-green-200 text-green-800'],
            'sakit' => ['label' => 's', 'color' => 'bg-yellow-200 text-yellow-800'],
            'izin'  => ['label' => 'i', 'color' => 'bg-blue-200 text-blue-800'],
            'alpa'  => ['label' => 'a', 'color' => 'bg-red-200 text-red-800'],
        ];
    @endphp
    <div class="overflow-x-auto">
        <table class="table-auto w-full border mt-3 min-w-max">
            <thead class="bg-gray-100 sticky top-0">
                <tr>
                    <th rowspan="2" class="px-3 py-2 border font-medium bg-gray-100 sticky left-0 z-20">No</th>
                    <th rowspan="2" class="px-3 py-2 border font-medium bg-gray-100 sticky left-12 z-20">NIS</th>
                    <th rowspan="2" class="px-3 py-2 border font-medium bg-gray-100 sticky left-36 z-20">Nama</th>
                    <th colspan="{{ $jumlahHari }}" class="px-3 py-2 font-medium border text-center">
                        {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') }}
                    </th>
                </tr>
                <tr>
                    @for ($d = 1; $d <= $jumlahHari; $d++)
                        <th class="px-2 py-1 border text-center">{{ $d }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($dataAbsensi as $nis => $listAbsensi)
                    @php
                        $nama = $listAbsensi->first()->nama;
                        // bikin array tanggal -> status
                        $statusByTanggal = $listAbsensi->keyBy(function($item) {
                            return \Carbon\Carbon::parse($item->tanggal)->day;
                        });
                    @endphp
                    <tr>
                        <td class="border px-3 py-2 sticky left-0 bg-gray-50 z-10">{{ $no++ }}</td>
                        <td class="border px-3 py-2 sticky left-12 bg-gray-50 z-10">{{ $nis }}</td>
                        <td class="border px-3 py-2 sticky left-36 bg-gray-50 z-10">{{ $nama }}</td>

                        @for ($d = 1; $d <= $jumlahHari; $d++)
                            @php
                                $status = $statusByTanggal[$d]->status ?? null;
                                $label  = $mapStatus[$status]['label'] ?? '-';
                                $color  = $mapStatus[$status]['color'] ?? 'text-white';
                            @endphp

                            <td class="border px-3 py-2 text-center {{ $color }}">
                                {{ $label }}
                            </td>
                        @endfor

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-modal name="filter_absen_bulanan_siswa" :show="true" max-width="lg">
        <form method="POST" action="{{route('filter_lap_bulanan_siswa')}}">
            @csrf
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                    Filter Absen Siswa
                </h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Pilih Kelas</label>
                    <select name="kelas" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        @foreach ($data_kelas as $d_kelas)
                            <option value="{{$d_kelas->nama_kelas}}">{{$d_kelas->nama_kelas}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Nama Guru</label>
                    <select name="guru" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        @foreach ($data_guru as $guru)
                            <option value="{{$guru->nama_pegawai}}">{{$guru->nama_pegawai}}</option>
                        @endforeach
                    </select>
                </div>
                 <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Pilih Mata Pelajaran</label>
                    <select name="mapel" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        @foreach ($mapel_pegawai as $mapel)
                            @foreach ($mapel->mapel as $m)
                                <option value="{{$m}}">{{$m}}</option>
                            @endforeach
                        @endforeach
                    </select> 
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Jenis Absen</label>
                    <select name="jenis_absen" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        <option value="harian">Harian</option>
                        <option value="mapel">Mapel</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Pilih Bulan</label>
                    <select name="bulan" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select> 
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-200">Pilih Tahun</label>
                    <select name="tahun" class="form-select block w-full rounded border-gray-300 shadow-sm" >
                        @php
                            $total_tahun = 500;
                            $tahun = 2020;
                            $th = 0;
                            $tahun_berjalan = date('Y');
                        @endphp
                        <option value="{{$tahun_berjalan}}">{{$tahun_berjalan}}</option>
                        @for ($d = 0; $d <= $total_tahun; $d++)
                            @php
                                $th = $tahun + $d;
                            @endphp
                            <option value="{{$th}}">{{$th}}</option>
                        @endfor
                        
                    </select> 
                </div>
               
                <div class="mt-6 flex justify-end">
                    <button type="button" x-data @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'filter_absen_bulanan_siswa' }))" class="mr-2 px-4 py-2 border rounded">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </x-modal>
</x-app-layout>
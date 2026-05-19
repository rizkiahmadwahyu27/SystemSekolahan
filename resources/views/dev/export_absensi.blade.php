<table border="1" cellspacing="0" cellpadding="4">
    @php
         $mapStatus = [
            'hadir' => ['label' => 'h'],
            'sakit' => ['label' => 's'],
            'izin'  => ['label' => 'i'],
            'alpa'  => ['label' => 'a'],
        ];
    @endphp

    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">NIS</th>
            <th rowspan="2">Nama</th>
            <th colspan="{{ $jumlahHari }}" align="center">
                {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') }}
            </th>
            <th colspan="4">
                Jumlah
            </th>
        </tr>

        <tr>
            @for ($d = 1; $d <= $jumlahHari; $d++)
                <th>{{ $d }}</th>
            @endfor
            <th>H</th>
            <th>A</th>
            <th>S</th>
            <th>I</th>
        </tr>
    </thead>

    <tbody>
        @php $no = 1; @endphp
        @foreach ($siswaKelas as $siswa)
            @php
                // ambil data absensi per siswa
                $absensiSiswa = $dataAbsensi[$siswa->nis] ?? collect();

                // mapping tanggal => status
                $statusByTanggal = $absensiSiswa->keyBy(function($item) {
                    return \Carbon\Carbon::parse($item->tanggal)->day;
                });

                // hitung jumlah
                $jumlah = [
                    'hadir' => 0,
                    'alpa' => 0,
                    'sakit' => 0,
                    'izin' => 0,
                ];
            @endphp

            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nama }}</td>

                {{-- Loop tanggal --}}
                @for ($d = 1; $d <= $jumlahHari; $d++)
                    @php
                        $status = $statusByTanggal[$d]->status ?? null;

                        if ($status && isset($jumlah[$status])) {
                            $jumlah[$status]++;
                        }
                    @endphp

                    <td>
                        @if ($status)
                            <span>
                                {{ strtoupper($mapStatus[$status]['label']) }}
                            </span>
                        @else
                            <span>
                                -
                            </span>
                        @endif
                    </td>
                @endfor

                {{-- Rekap --}}
                <td>{{ $jumlah['hadir'] }}</td>
                <td>{{ $jumlah['alpa'] }}</td>
                <td>{{ $jumlah['sakit'] }}</td>
                <td>{{ $jumlah['izin'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

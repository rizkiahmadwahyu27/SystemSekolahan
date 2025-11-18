<table border="1" cellspacing="0" cellpadding="4">
    @php
        $mapStatus = [
            'hadir' => 'H',
            'sakit' => 'S',
            'izin'  => 'I',
            'alpa'  => 'A',
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
        @foreach ($dataAbsensi as $nis => $listAbsensi)
            @php
                $nama = $listAbsensi->first()->nama;

                $statusByTanggal = $listAbsensi->keyBy(function($item) {
                    return \Carbon\Carbon::parse($item->tanggal)->day;
                });
                $hadir = 0;
                $alpa = 0;
                $sakit = 0;
                $izin = 0;
            @endphp

            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $nis }}</td>
                <td>{{ $nama }}</td>

                @for ($d = 1; $d <= $jumlahHari; $d++)
                    @php
                        $status = $statusByTanggal[$d]->status ?? null;
                        $label  = $mapStatus[$status] ?? '-';
                        if ($label == 'H') $hadir++;
                        if ($label == 'A') $alpa++;
                        if ($label == 'S') $sakit++;
                        if ($label == 'I') $izin++;
                    @endphp
                    <td align="center">{{ $label }}</td>
                @endfor
                <td>{{$hadir}}</td>
                <td>{{$alpa}}</td>
                <td>{{$sakit}}</td>
                <td>{{$izin}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

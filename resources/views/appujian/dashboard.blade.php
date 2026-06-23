<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Ujian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10">

    <!-- 👤 Info Siswa -->
    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <h2 class="text-xl font-bold mb-2">Data Peserta</h2>
        <p><b>Nama:</b> {{ $user->nama }}</p>
        <p><b>No Peserta:</b> {{ $user->no_peserta }}</p>
        <p><b>Kelas:</b> {{ $user->kelas }}</p>
        <p><b>Sesi:</b> {{ $user->sesi }}</p>
    </div>

    <!-- 📚 Daftar Ujian -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-bold mb-4">Daftar Ujian</h2>

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Nama Ujian</th>
                    <th class="p-2">Mapel</th>
                    <th class="p-2">Durasi</th>
                    <th class="p-2">Mulai</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($ujians as $ujian)
                    @php
                        $now = now();
                        if ($now < $ujian->mulai) {
                            $status = 'Belum Mulai';
                        } elseif ($now > $ujian->selesai) {
                            $status = 'Selesai';
                        } else {
                            $status = 'Berlangsung';
                        }
                    @endphp

                    <tr class="text-center border-t">
                        <td class="p-2">{{ $ujian->nama_ujian }}</td>
                        <td>{{ $ujian->mapel }}</td>
                        <td>{{ $ujian->durasi }} menit</td>
                        <td>{{ $ujian->mulai }}</td>
                        <td>
                            <span class="px-2 py-1 rounded 
                                {{ $status == 'Berlangsung' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                                {{ $status }}
                            </span>
                        </td>

                        <td>
                            @if ($status == 'Berlangsung')
                                <a href="/ujian/{{ $ujian->id }}" 
                                   class="bg-blue-500 text-white px-3 py-1 rounded">
                                   Gabung
                                </a>
                            @else
                                <button disabled 
                                    class="bg-gray-400 text-white px-3 py-1 rounded">
                                    Tidak Bisa
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

</body>
</html>
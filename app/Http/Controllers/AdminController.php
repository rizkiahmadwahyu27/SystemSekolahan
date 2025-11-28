<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\DataKelas;
use App\Models\DataPegawai;
use App\Models\SiswaKelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
         // Mengambil data statistik absensi untuk siswa tertentu
        $attendanceStats = Absensi::where('jenis_absen', 'harian')->where('tanggal', date('Y-m-d'))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
        // Data yang akan dipass ke Chart.js
        $labels = ['hadir', 'izin', 'sakit', 'alpa', 'dispen', 'lainnya'];
        $dataCounts = [];
        $backgroundColors = [
            'hadir' => 'rgba(75, 192, 192, 0.6)',
            'izin' => 'rgba(255, 206, 86, 0.6)',
            'sakit' => 'rgba(54, 162, 235, 0.6)',
            'alpa' => 'rgba(255, 99, 132, 0.6)',
            'dispen' => 'rgba(255, 19, 122, 0.6)',
            'lainnya' => 'rgba(99, 19, 122, 0.6)',
        ];
        $chartData = [
            'labels' => [],
            'data' => [],
            'backgroundColor' => [],
        ];

        foreach ($labels as $label) {
            $dataCounts = $attendanceStats[$label] ?? 0; // Ambil hitungan atau 0 jika tidak ada
            $chartData['labels'][] = $label;
            $chartData['data'][] = $dataCounts;
            $chartData['backgroundColor'][] = $backgroundColors[$label];
        }
        // PENTING: Lakukan json_encode() HANYA DI SINI
        $chartDataJsonString = json_encode($chartData); 
        $data_siswa = SiswaKelas::whereIn('keterangan', ['Siswa Baru', 'Pindahan', 'Naik Kelas', 'Tinggal Kelas'])->count();
        $data_pegawai = DataPegawai::count();
        $data_kelas = DataKelas::count();
        return view('admin.index', [
            // Pastikan Anda mem-pass variabel yang sudah berupa string JSON
            'chartData' => $chartDataJsonString, 
        ], compact('data_siswa', 'data_pegawai', 'data_kelas'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\DataKelas;
use App\Models\DataPegawai;
use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\SiswaKelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
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
        return view('guru.index', [
            // Pastikan Anda mem-pass variabel yang sudah berupa string JSON
            'chartData' => $chartDataJsonString, 
        ], compact('data_siswa', 'data_pegawai', 'data_kelas'));
    }

    public function data_siswa(){
        $siswas = DataSiswa::select('nis', 'nisn', 'nama', 'jenis_kelamin', 'agama', 'alamat', 'nama_ibu', 'nama_ayah', 'id', 'no_hp_ortu')->get();
        $siswa_update = null;
        return view('guru.data_siswa', compact('siswas', 'siswa_update'));
    }

    public function data_murid(){
        $pegawai = DataPegawai::where('id_pegawai', Auth::user()->id_user)->first();
        if ($pegawai) {
            $siswa_update = null;
            $data_kelas = SiswaKelas::join('data_kelas', 'data_kelas.kode_kelas', '=', 'siswa_kelas.kode_kelas')->join('data_siswas','data_siswas.nis','=','siswa_kelas.nis')->where('nama_wali_kelas', $pegawai->nama_pegawai)->get();
            $kelas = DataKelas::where('nama_wali_kelas', $pegawai->nama_pegawai)->first();
            return view('guru.data_murid', compact('data_kelas', 'siswa_update', 'kelas'));
        }else{
            return redirect()->back()->with('error', 'Maaf data tidak ditemukan');
        }
    }
}

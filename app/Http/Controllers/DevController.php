<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Imports\DataKelasImport;
use App\Imports\DataPegawaiImport;
use App\Imports\DataSiswaImport;
use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\DataKelas;
use App\Models\SiswaKelas;
use App\Models\DataPegawai;
use App\Models\Absensi;
use App\Models\Configurasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class DevController extends Controller
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
        return view('dev.index', [
            // Pastikan Anda mem-pass variabel yang sudah berupa string JSON
            'chartData' => $chartDataJsonString, 
        ], compact('data_siswa', 'data_pegawai', 'data_kelas'));
    }

    public function scan_post($nis){
        $siswa = DataSiswa::join('siswa_kelas', 'siswa_kelas.nis', '=', 'data_siswas.nis')->where('data_siswas.nis', $nis)->first();
        $data_kelas = $siswa->join('data_kelas', 'data_kelas.kode_kelas', '=', 'kode_kelas')->where('data_kelas.kode_kelas', $siswa->kode_kelas)->first();
        $conf = Configurasi::where('status', 'aktif')->first();
         if (!$siswa && !$data_kelas) {
            return redirect(route('scan_barcode'))->with('error', 'Data Siswa Tidak Ada');
        }

        $hariInggris = date('l', strtotime(date('Y-m-d')));
        $hariIndonesia = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];

        $absensi = Absensi::where('nis', $nis)->where('tanggal', date('Y-m-d'))->where('guru', $data_kelas->nama_wali_kelas)->where('jenis_absen', 'harian')->first();

        if (!$absensi) {
            $absen = Absensi::create([
                'nis' => $siswa->nis,
                'nama' => $siswa->nama,
                'kelas' => $siswa->nama_kelas,
                'guru' => $data_kelas->nama_wali_kelas,
                'jenis_absen' => 'harian',
                'hari' => $hariIndonesia[$hariInggris],
                'tanggal' => date('Y-m-d'),
                'status' => 'Hadir',
                'keterangan' => 'Hadir di Kelas',
                'user_input' => Auth::user()->name,
                'user_edit' => 'Null',
                'id_conf' => $conf->id,
                'id_user_input' => Auth::user()->id,
                'id_user_edit' => null,
                'id_siswa' => $siswa->id,
                'id_wali_kelas' => $data_kelas->id_wali_kelas,
                'id_kelas' => $data_kelas->id,
            ]); 
            $this->kirimPesanWali($siswa, $absen);
            //MENAMBAHA
            return redirect()->back()->with('success', 'Data Berhasil Disimpan');
        }else{
            return redirect()->back()->with('error', 'Maaf kamu sudah absen');
        }
        
    }

    public function data_absen(){
        $data_absen = Absensi::all();
        $absen_siswa = SiswaKelas::where('nama_kelas', '10')->get();
        $update_absen = null;
        $data_kelas = DataKelas::get('nama_kelas');
        $data_pegawai = DataPegawai::get('nama_pegawai');
        $mapel_pegawai = DataPegawai::all()->map(function ($mapel) {
             $mapel->mapel = collect([
                $mapel->mata_pelajaran_1,
                $mapel->mata_pelajaran_2,
                $mapel->mata_pelajaran_3,
                $mapel->mata_pelajaran_4,
                $mapel->mata_pelajaran_5,
                $mapel->mata_pelajaran_6,
            ])
            ->filter(fn ($m) => $m !== '-' && !empty($m)) // buang "-" dan kosong
            ->unique() // buang duplikat
            ->values() // reset index array
            ->toArray();

            return $mapel;
        });
        $p_mapel = '';
        $p_kelas = '';
        $p_guru = '';
        $p_tgl = '';
        $p_jenis = '';

        return view('dev.data_absen', compact('data_absen', 'mapel_pegawai', 'p_jenis', 'p_mapel', 'p_kelas', 'p_guru', 'p_tgl', 'absen_siswa', 'update_absen', 'data_kelas', 'data_pegawai'));
    }

    public function get_absen(Request $request){
        $absen_siswa = SiswaKelas::where('nama_kelas', $request->kelas)->get();
        $data_absen = Absensi::all();
        $update_absen = null;
        $data_kelas = DataKelas::get('nama_kelas');
        $data_pegawai = DataPegawai::get('nama_pegawai');
        $mapel_pegawai = DataPegawai::all()->map(function ($mapel) {
             $mapel->mapel = collect([
                $mapel->mata_pelajaran_1,
                $mapel->mata_pelajaran_2,
                $mapel->mata_pelajaran_3,
                $mapel->mata_pelajaran_4,
                $mapel->mata_pelajaran_5,
                $mapel->mata_pelajaran_6,
            ])
            ->filter(fn ($m) => $m !== '-' && !empty($m)) // buang "-" dan kosong
            ->unique() // buang duplikat
            ->values() // reset index array
            ->toArray();

            return $mapel;
        });
        $p_mapel = $request->mapel;
        $p_kelas = $request->kelas;
        $p_guru = $request->guru;
        $p_tgl = $request->tgl;
        $p_jenis = $request->jenis_absen;
        return view('dev.data_absen', compact('data_absen', 'mapel_pegawai', 'p_jenis', 'p_mapel', 'p_kelas', 'p_guru', 'p_tgl', 'absen_siswa', 'update_absen', 'data_kelas', 'data_pegawai'));
    }

    public function create_data_absen(Request $request){
        $nises   = $request->nis;
        $nama   = $request->nama;
        $status   = $request->status;
        $kelas    = $request->s_kelas;
        $jenis    = $request->s_jenis;
        
        $tgl      = $request->s_tgl;
        $keterangan   = $request->keterangan;
        $hariInggris = date('l', strtotime($tgl));
        $hariIndonesia = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];
        $conf = Configurasi::where('status', 'aktif')->first();

        if ($jenis == 'mapel') {
            $guru     = $request->s_guru . ', ' . $request->s_mapel;
            $data_kelas = DataKelas::where('nama_kelas', $kelas)->first();
        }else {
            $data_kelas = DataKelas::where('nama_kelas', $kelas)->first();
            $guru     = $data_kelas->nama_wali_kelas;
        }
        foreach ($nises as $key => $nis) {
            $siswa = DataSiswa::where('nis', $nis)->first();
            $nis_siswa = Absensi::where('nis', $nis)->where('tanggal', $tgl)->where('guru', $guru)->where('jenis_absen', $jenis)->first();
            if (!$nis_siswa) {
                $absen = Absensi::create([
                    'nis' => $nis,
                    'nama' => $nama[$key],
                    'kelas'=> $kelas,
                    'guru' => $guru,
                    'jenis_absen' => $jenis,
                    'hari' => $hariIndonesia[$hariInggris],
                    'tanggal' => $tgl,
                    'status'  => $status[$key],
                    'keterangan' => $keterangan[$key],
                    'user_input' => Auth::user()->name,
                    'user_edit' => 'Null',
                    'id_conf' => $conf->id,
                    'id_user_input' => Auth::user()->id,
                    'id_user_edit' => null,
                    'id_siswa' => $siswa->id,
                    'id_wali_kelas' => $data_kelas->id_wali_kelas,
                    'id_kelas' => $data_kelas->id,
                ]);

                if ($jenis == 'harian') {
                    $this->kirimPesanWali($siswa, $absen);
                }
            }
        }
        
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function update_data_absen(Request $request, $id){
        $update_absen = Absensi::where('id', $id)->first();
        $data_absen = Absensi::all();
        return view('siswa.absensi_siswa', compact('update_absen', 'data_absen'));
    }

    public function updated_data_absen(Request $request, $id){
        $update_absen = Absensi::where('id', $id)->first();
        $Absensi = $update_absen->update([
            'jenis_absen' => $request->jenis_absen,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_absen(Request $request, $id){
        $absen_deleted = Absensi::where('id', $id)->first();
        if ($absen_deleted) {
            $delete_absen = $absen_deleted->delete();
        }
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    private function kirimPesanWali($siswa, $absen)
    {
        if ($absen->created_at < '06.30.00') {
            $ket = 'tepat waktu';
        } elseif ($absen->created_at > '06.30.00' && $absen->created_at < '06.35.00') {
            $ket = 'datang waktu toleransi';
        }
        else {
            # code...
        }
        
        
        $pesan = " Assalamu alaikum wr.wb \n \n"

                ." Yth. Bapak/Ibu Wali Murid *{$siswa->nama}* \n \n"

                ." Kami pihak SMK Pelita Jatibarang menginformasikan bahwa sanya pada : \n"

                ." Hari, Tanggal : *{$absen->hari}*, *{$absen->created_at}* \n" 
                ." Tempat : SMK Pelita Jatibarang \n" 
                ." Satatus Kehadiran : *{$absen->status}* \n \n"

                ." Demikian informasi yang disampaikan. \n \n"

                ." Jatibarang, *{$absen->tanggal}* \n"

                ." Kepala Sekolah, \n \n \n"


                ." Linda Tri Apsari, S.Pd";
            
        $nomor = $siswa->no_hp_ortu;

        // Pastikan hanya kirim jika format nomor benar
        if (preg_match('/^62\d{9,15}$/', $nomor)) {
            $response = Http::post(env('WA_BOT', 'http://localhost:4000/send-message'), [
                'number' => $nomor,
                'message' => $pesan
            ]);
            
            Log::info('Kirim ke bot:', $response->json());
        } else {
            Log::warning("Nomor tidak valid, pesan tidak dikirim: {$nomor}");
        }
    }

    //export
    public function export_absensi(Request $request){
        // Validasi supaya parameter wajib ada
        $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
            'jenis_absen' => 'required|string',
        ]);
        $nama_file = 'laporan absensi-' . $request->bulan . '-' . $request->tahun . '.xlsx';
        // Download Excel
        ob_end_clean();
        return Excel::download(new AbsensiExport($request), $nama_file);
    }

    public function import_siswa(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        // Import menggunakan Laravel Excel
        Excel::import(new DataSiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function import_pegawai(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        // Import menggunakan Laravel Excel
        Excel::import(new DataPegawaiImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function import_kelas(Request $request){
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        // Import menggunakan Laravel Excel
        Excel::import(new DataKelasImport($request->nama_kelas, $request->keterangan), $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function halaman_import(){
        $data_kelas = DataKelas::all();
        return view('dev.halaman_import', compact('data_kelas'));
    }
}

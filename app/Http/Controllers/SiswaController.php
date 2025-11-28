<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\Absensi;
use App\Models\Configurasi;
use App\Models\DataKelas;
use App\Models\DataPegawai;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    public function index(){
        // Mengambil data statistik absensi untuk siswa tertentu
        $attendanceStats = Absensi::where('nis', Auth::user()->id_user)->where('jenis_absen', 'harian')
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
        // dd($chartDataJsonString);
        return view('siswa.index', [
            // Pastikan Anda mem-pass variabel yang sudah berupa string JSON
            'chartData' => $chartDataJsonString, 
        ]);
    }


    public function create_data_siswa(Request $request){
        $conf = Configurasi::where('status', 'aktif')->first();
        $datasiswa = DataSiswa::create([
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'sekolah_asal' => $request->sekolah_asal,
            'anak_ke' => $request->anak_ke,
            'no_hp' => $request->no_hp,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'alamat_ortu' => $request->alamat_ortu,
            'no_hp_ortu' => $request->no_hp_ortu,
            'created_by' => Auth::user()->name,
            'edited_by' => 'Null',
            'id_conf' => $conf->id,
            'id_user_input' => Auth::user()->id,
            'id_user_edit' => null,
        ]);
;
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function update_data_siswa(Request $request, $id){
        $siswa_update = DataSiswa::where('id', $id)->first();
        $siswas = [];
        // dd($siswa_update);
        return view('guru.data_siswa', compact('siswa_update', 'siswas'));
    }

    public function updated_data_siswa(Request $request, $id){
        $siswa_update = DataSiswa::where('id', $id)->first();
        $datasiswa = $siswa_update->update([
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'sekolah_asal' => $request->sekolah_asal,
            'anak_ke' => $request->anak_ke,
            'no_hp' => $request->no_hp,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'alamat_ortu' => $request->alamat_ortu,
            'no_hp_ortu' => $request->no_hp_ortu,
            'edited_by' => Auth::user()->name,
            'id_user_edit' => Auth::user()->id,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_siswa(Request $request, $id){
        $siswa_deleted = DataSiswa::where('id', $id)->first();
        if ($siswa_deleted) {
            $delete_siswa = $siswa_deleted->delete();
        }

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function cetak_kartu_absen(){
        $data_siswa = DataSiswa::select('nis', 'nisn', 'nama', 'jenis_kelamin', 'agama', 'alamat', 'nama_ibu', 'nama_ayah', 'id')->get();
        return view('dev.cetak_kartu_absen', compact('data_siswa'));
    }

    public function scan_barcode(){
        return view('dev.scan_barcode');
    }

    public function absensi_siswa(){
        return view('siswa.absensi_siswa');
    }

    public function lap_absen_siswa(){
        if (Auth::user()->level == 'guru') {
            $update_absen = [];
            $data_guru = DataPegawai::where('id_pegawai', Auth::user()->id_user)->first();
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            if ($data_guru) {
                $data_absen = Absensi::where('guru', $data_guru->nama_pegawai)->get();
            }else{
                return redirect()->back()->with('error', 'Data Pegawai Tidak Ditemukan');
            }
            if ($data_guru) {
                $data_guru->mapel = collect([
                    $data_guru->mata_pelajaran_1,
                    $data_guru->mata_pelajaran_2,
                    $data_guru->mata_pelajaran_3,
                    $data_guru->mata_pelajaran_4,
                    $data_guru->mata_pelajaran_5,
                    $data_guru->mata_pelajaran_6,
                    // ... mata pelajaran lainnya
                ])
                ->filter(fn ($m) => $m !== '-' && !empty($m))
                ->unique()
                ->values()
                ->toArray();
                
                $mapel_pegawai = collect([$data_guru]); // Opsional: bungkus dalam koleksi jika diperlukan
            } else {
                $mapel_pegawai = collect(); // Pegawai tidak ditemukan
            }
            return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }elseif (Auth::user()->level == 'siswa'){
            $data_absen = Absensi::where('nis', Auth::user()->id_user)->where('jenis_absen', 'harian')->get();
            $update_absen = [];
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            $data_guru = DataPegawai::get('nama_pegawai');
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
            return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }
        else{
            $data_absen = Absensi::all();
            $update_absen = [];
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            $data_guru = DataPegawai::get('nama_pegawai');
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
            return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }
    }

    public function filter_absen_siswa(Request $request){
        if (Auth::user()->level == 'guru') {
            $update_absen = [];
            $data_guru = DataPegawai::where('id_pegawai', Auth::user()->id_user)->first();
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            if ($request->jenis_absen == 'harian') {
                $data_absen = Absensi::where('guru', $data_guru->nama_pegawai)->where('kelas', $request->kelas)->where('jenis_absen', $request->jenis_absen)->whereBetween('tanggal', [$request->tgl1, $request->tgl2])->get();
            }else{
                $nama_guru = $request->nama_guru .', '. $request->mapel;
                $data_absen = Absensi::where('kelas', $request->kelas)->where('guru', $nama_guru)->where('jenis_absen', $request->jenis_absen)->whereBetween('tanggal', [$request->tgl1, $request->tgl2])->get();
            }
            if ($data_guru) {
                $data_guru->mapel = collect([
                    $data_guru->mata_pelajaran_1,
                    $data_guru->mata_pelajaran_2,
                    $data_guru->mata_pelajaran_3,
                    $data_guru->mata_pelajaran_4,
                    $data_guru->mata_pelajaran_5,
                    $data_guru->mata_pelajaran_6,
                    // ... mata pelajaran lainnya
                ])
                ->filter(fn ($m) => $m !== '-' && !empty($m))
                ->unique()
                ->values()
                ->toArray();
                
                $mapel_pegawai = collect([$data_guru]); // Opsional: bungkus dalam koleksi jika diperlukan
            } else {
                $mapel_pegawai = collect(); // Pegawai tidak ditemukan
            }
            return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }else{
            if ($request->jenis_absen == 'harian') {
                $data_absen = Absensi::where('guru', $request->nama_guru)->where('kelas', $request->kelas)->where('jenis_absen', $request->jenis_absen)->whereBetween('tanggal', [$request->tgl1, $request->tgl2])->get();
            }else{
                $nama_guru = $request->nama_guru .', '. $request->mapel;
                $data_absen = Absensi::where('kelas', $request->kelas)->where('guru', $nama_guru)->where('jenis_absen', $request->jenis_absen)->whereBetween('tanggal', [$request->tgl1, $request->tgl2])->get();
            }

            $update_absen = [];
            $data_kelas = DataKelas::get('nama_kelas');
            $data_guru = DataPegawai::get('nama_pegawai');
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
            return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }
    }

    public function update_data_absen_siswa(Request $request, $id){
        $nama_guru = $request->nama_guru .', '. $request->mapel;
        $data_absen = Absensi::where('kelas', $request->kelas)->where('guru', $nama_guru)->where('jenis_absen', $request->jenis_absen)->whereBetween('tanggal', [$request->tgl1, $request->tgl2])->get();
        $update_absen = Absensi::find($id);
        $data_kelas = DataKelas::get('nama_kelas');
        if(Auth::user()->level == 'guru'){
            $data_guru = DataPegawai::where('id_pegawai', Auth::user()->id_user)->first();
        }else{
            $data_guru = DataPegawai::get('nama_pegawai');
        }
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
        return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai', 'update_absen'));
    }

    public function updated_data_absen_siswa(Request $request, $id){
        $siswa_update = Absensi::find($id);
        $siswa_update->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'guru' => $request->guru,
            'kelas' => $request->kelas,
            'jenis_absen' => $request->jenis_absen,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_absen_siswa($id){
        $siswa_deleted = Absensi::find($id);
        $siswa_deleted->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function laporan_bulanan_siswa(){
        if (Auth::user()->level == 'guru') {
            $tahun = date('Y');
            $bulan = date('m');

            // Ambil absensi untuk bulan & tahun sekarang
            $data_guru = DataPegawai::where('id_pegawai', Auth::user()->id_user)->first();
            $absensi = Absensi::where('gurujen', $data_guru->nama_pegawai)->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get(['nis', 'nama', 'tanggal', 'status']);

            // Grouping berdasarkan NIS
            $dataAbsensi = $absensi->groupBy('nis');

            $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
            $update_absen = [];
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            if ($data_guru) {
                $data_guru->mapel = collect([
                    $data_guru->mata_pelajaran_1,
                    $data_guru->mata_pelajaran_2,
                    $data_guru->mata_pelajaran_3,
                    $data_guru->mata_pelajaran_4,
                    $data_guru->mata_pelajaran_5,
                    $data_guru->mata_pelajaran_6,
                    // ... mata pelajaran lainnya
                ])
                ->filter(fn ($m) => $m !== '-' && !empty($m))
                ->unique()
                ->values()
                ->toArray();
                
                $mapel_pegawai = collect([$data_guru]); // Opsional: bungkus dalam koleksi jika diperlukan
            } else {
                $mapel_pegawai = collect(); // Pegawai tidak ditemukan
            }

            return view('siswa.lap_bulanan_siswa', compact('dataAbsensi', 'tahun', 'bulan', 'jumlahHari', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }elseif (Auth::user()->level == 'siswa') {
            $tahun = date('Y');
            $bulan = date('m');

            // Ambil absensi untuk bulan & tahun sekarang
            $absensi = Absensi::where('nis', Auth::user()->id_user)->where('jenis_absen', 'harian')->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get(['nis', 'nama', 'tanggal', 'status']);

            // Grouping berdasarkan NIS
            $dataAbsensi = $absensi->groupBy('nis');

            $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
            $update_absen = [];
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            $data_guru = DataPegawai::get('nama_pegawai');
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

            return view('siswa.lap_bulanan_siswa', compact('dataAbsensi', 'tahun', 'bulan', 'jumlahHari', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }
         else {
            $tahun = date('Y');
            $bulan = date('m');

            // Ambil absensi untuk bulan & tahun sekarang
            $absensi = Absensi::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get(['nis', 'nama', 'tanggal', 'status']);

            // Grouping berdasarkan NIS
            $dataAbsensi = $absensi->groupBy('nis');

            $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
            $update_absen = [];
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            $data_guru = DataPegawai::get('nama_pegawai');
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

            return view('siswa.lap_bulanan_siswa', compact('dataAbsensi', 'tahun', 'bulan', 'jumlahHari', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }
        
    }

    public function filter_lap_bulanan_siswa(Request $request){
        if (Auth::user()->level == 'guru') {
            $tahun = $request->tahun;
            $bulan = $request->bulan;

            // Ambil absensi untuk bulan & tahun sekarang
            $data_guru = DataPegawai::where('id_pegawai', Auth::user()->id_user)->first();
            if ($request->jenis_absen == 'harian') {
                    $absensi = Absensi::where('guru', $data_guru->nama_pegawai)->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan)
                    ->get(['nis', 'nama', 'tanggal', 'status']);
            } else {
                $guru = $request->guru . ', ' . $request->mapel;
                $absensi = Absensi::where(function ($q) use ($request, $guru) {
                    $q->where('kelas', $request->kelas)
                    ->where('guru', $guru)
                    ->where('jenis_absen', $request->jenis_absen);
                })
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get(['nis', 'nama', 'tanggal', 'status', 'kelas', 'guru', 'jenis_absen']);
            }

            // Grouping berdasarkan NIS
            $dataAbsensi = $absensi->groupBy('nis');

            $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
            $update_absen = [];
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            if ($data_guru) {
                $data_guru->mapel = collect([
                    $data_guru->mata_pelajaran_1,
                    $data_guru->mata_pelajaran_2,
                    $data_guru->mata_pelajaran_3,
                    $data_guru->mata_pelajaran_4,
                    $data_guru->mata_pelajaran_5,
                    $data_guru->mata_pelajaran_6,
                ])
                ->filter(fn ($m) => $m !== '-' && !empty($m))
                ->unique()
                ->values()
                ->toArray();
                
                $mapel_pegawai = collect([$data_guru]); // Opsional: bungkus dalam koleksi jika diperlukan
            } else {
                $mapel_pegawai = collect(); // Pegawai tidak ditemukan
            }

            return view('siswa.lap_bulanan_siswa', compact('dataAbsensi', 'tahun', 'bulan', 'jumlahHari', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        } else {
            $tahun = $request->tahun;
            $bulan = $request->bulan;

            if ($request->jenis_absen == 'harian') {
                    $absensi = Absensi::where('guru', $request->guru)->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan)
                    ->get(['nis', 'nama', 'tanggal', 'status']);
            } else {
                $guru = $request->guru . ', ' . $request->mapel;
                $absensi = Absensi::where(function ($q) use ($request, $guru) {
                    $q->where('kelas', $request->kelas)
                    ->where('guru', $guru)
                    ->where('jenis_absen', $request->jenis_absen);
                })
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get(['nis', 'nama', 'tanggal', 'status', 'kelas', 'guru', 'jenis_absen']);
            }

            // Grouping berdasarkan NIS
            $dataAbsensi = $absensi->groupBy('nis');

            $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
            $update_absen = [];
            $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
            $data_guru = DataPegawai::get('nama_pegawai');
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

            return view('siswa.lap_bulanan_siswa', compact('dataAbsensi', 'tahun', 'bulan', 'jumlahHari', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
        }
    }

    public function profile_siswa(){
        $murid = DataSiswa::where('nis', Auth::user()->id_user)->first();
        if ($murid) {
            return view('siswa.profile_siswa', compact('murid'));
        } else {
            return redirect()->back()->with('error', 'Data tidak berhasil ditemukan');
        }
    }
    public function kartu_barcode(){
        $murid = DataSiswa::where('nis', Auth::user()->id_user)->first();
        if ($murid) {
            return view('siswa.kartu_barcode', compact('murid'));
        } else {
            return redirect()->back()->with('error', 'Data tidak berhasil ditemukan');
        }
    }

//data export siswa
    public function exportDataSiswa(){
        return Excel::download(new SiswaExport, 'data_siswa.xlsx');
    }

}

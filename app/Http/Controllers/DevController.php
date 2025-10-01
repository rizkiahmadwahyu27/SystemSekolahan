<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\DataKelas;
use App\Models\SiswaKelas;
use App\Models\DataPegawai;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
class DevController extends Controller
{
    public function index(){
        return view('dev.index');
    }

    public function scan_post($nis){
        $data = DataSiswa::join('data_kelas', 'data_kelas.nis', '=', 'data_siswas.nis')->where('data_siswas.nis', $nis)->first();
         if (!$data) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan');
        }
        $nama_kelas = '';
        if ($data->id_kelas_xi == null && $data->id_kelas_xii == null) {
            $nama_kelas = $data->kelas_x; 
        }elseif ($data->id_kelas_xii == null) {
            $nama_kelas = $data->kelas_xi;
        }else {
            $nama_kelas = $data->kelas_xii;
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

        Absensi::create([
            'nis' => $data->nis,
            'nama' => $data->nama,
            'kelas' => $nama_kelas,
            'guru' => Auth::user()->name,
            'jenis_absen' => 'harian',
            'hari' => $hariIndonesia[$hariInggris],
            'tanggal' => date('Y-m-d'),
            'status' => 'Hadir',
            'keterangan' => 'Hadir di Kelas',
            'user_input' => Auth::user()->name,
            'user_edit' => 'Null',
            'id_user' => Auth::user()->id,
        ]); 

         return redirect(route('absensi_siswa'))->with('success', 'Absensi berhasil');
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
        $guru     = $request->s_guru;
        $mapel    = $request->s_mapel;
        $tgl      = $request->s_tgl;
        $keterangan   = $request->keterangan;
        $hari = Carbon::parse($tgl)->format('l'); 

        foreach ($nises as $key => $nis) {
            Absensi::create([
                'nis'      => $nis,
                'nama'     => $nama[$key],
                'kelas'    => $kelas,
                'guru'     => $guru . ', ' . $mapel,
                'jenis_absen' => $jenis,
                'hari' => $hari,
                'tanggal'      => $tgl,
                'status'   => $status[$key],
                'keterangan' => $keterangan[$key],
                'user_input' => Auth::user()->name,
                'user_edit' => 'Null',
                'id_user' => Auth::user()->id,
            ]);
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan');
    }

    public function update_data_absen(Request $request, $id){
        $update_absen = Absensi::where('id', $id)->first();
        $data_absen = Absensi::all();
        return view('siswa.absensi_siswa', compact('update_absen', 'data_absen'));
    }

    public function updated_data_absen(Request $request, $id){
        $update_absen = Absensi::where('id', $id)->first();
        $Absensi = $update_absen->update([
             'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'guru' => Auth::user()->name,
            'jenis_absen' => $request->jenis_absen,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'user_edit' => Auth::user()->name,
            'id_user' => Auth::user()->id,
        ]);

        return redirect(route('data_absen'));
    }

    public function deleted_data_absen(Request $request, $id){
        $absen_deleted = Absensi::where('id', $id)->first();
        if ($absen_deleted) {
            $delete_absen = $absen_deleted->delete();
        }
        return redirect(route('data_absen'));
    }
}

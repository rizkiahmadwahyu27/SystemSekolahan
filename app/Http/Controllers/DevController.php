<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\DataKelas;
use App\Models\Absensi;

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
        $update_absen = null;
        return view('dev.data_absen', compact('data_absen', 'update_absen'));
    }

    public function create_data_absen(Request $request){
        
        $absensi = Absensi::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'guru' => Auth::user()->name,
            'jenis_absen' => $request->jenis_absen,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'user_input' => Auth::user()->name,
            'user_edit' => 'Null',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->back()->withErrors('gagal menyimpan')->withInput();
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

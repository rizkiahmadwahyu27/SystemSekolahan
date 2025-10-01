<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKelas;
use App\Models\DataSiswa;
use App\Models\SiswaKelas;
use App\Models\DataPegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DataKelasController extends Controller
{
    public function data_kelas(){
        $data_kelas = DataKelas::all();
        $update_kelas = null;
        $d_kelas_siswa = SiswaKelas::join('data_kelas', 'data_kelas.kode_kelas', '=', 'siswa_kelas.kode_kelas')->get(['siswa_kelas.*', 'data_kelas.nama_wali_kelas']);
        $data_siswa = DataSiswa::all(['nis', 'nisn', 'nama', 'alamat']);
        return view('dev.data_kelas', compact('data_kelas', 'update_kelas', 'data_siswa', 'd_kelas_siswa'));
    }

    public function set_kelas(){
        $data_kelas = DataKelas::all();
        $update_kelas = null;
        $data_guru = DataPegawai::select('nama_pegawai')->where('jabatan', '=', 'Guru')->get();
        return view('dev.set_kelas', compact('data_guru', 'data_kelas', 'update_kelas'));
    }

    public function create_data_kelas(Request $request){

        $datakelas = DataKelas::create([
            'kode_kelas' => '10-'.$request->nama_kelas,
            'nama_kelas' => $request->nama_kelas,
            'nama_wali_kelas' => $request->nama_wali_kelas,
            'user_input' => Auth::user()->name,
            'user_edit' => 'null',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->back()->withErrors('gagal menyimpan')->withInput();
    }

    public function update_data_kelas(Request $request, $id){
        $update_kelas = DataKelas::where('id', $id)->first();
        $data_kelas = DataKelas::all();
        $data_guru = DataPegawai::select('nama_pegawai')->where('jabatan', '=', 'Guru')->get();
        return view('dev.set_kelas', compact('update_kelas', 'data_kelas', 'data_guru'));
    }

    public function updated_data_kelas(Request $request, $id){
        $update_kelas = DataKelas::where('id', $id)->first();
        $datakelas = $update_kelas->update([
            'kode_kelas' => '10-'.$request->nama_kelas,
            'nama_kelas' => $request->nama_kelas,
            'nama_wali_kelas' => $request->nama_wali_kelas,
            'user_input' => Auth::user()->name,
            'user_edit' => 'null',
            'id_user' => Auth::user()->id,
        ]);

        return redirect(route('set_kelas'));
    }

    public function deleted_data_kelas(Request $request, $id){
        $kelas_deleted = DataKelas::where('id', $id)->first();
        if ($kelas_deleted) {
            $delete_kelas = $kelas_deleted->delete();
        }
        return redirect(route('set_kelas'));
    }

    //data kelas untuk siswa

    public function create_data_kelas_siswa(Request $request){
        $siswa = $request->siswa;
        $kelas = $request->kelas;

        $h_siswa = explode(",", $siswa);
        $array_siswa = array_map('trim', $h_siswa);
        $h_kelas = explode(",", $kelas);
        $array_kelas = array_map('trim', $h_kelas);
        $dataSiswakelas = SiswaKelas::create([
            'nisn' => $array_siswa[0],
            'nis' => $array_siswa[1],
            'nama' => $array_siswa[2],
            'kode_kelas' => $array_kelas[0],
            'nama_kelas' => $array_kelas[1],
            'keterangan' => $request->keterangan,
            'user_create' => Auth::user()->name,
            'edit_user' => 'null',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->back()->withErrors('gagal menyimpan')->withInput();
    }

    public function update_data_kelas_siswa(Request $request, $id){
        $update_kelas = SiswaKelas::where('id', $id)->first();
        // dd($update_kelas);
        $data_kelas = DataKelas::all();
        $d_kelas_siswa = SiswaKelas::join('data_kelas', 'data_kelas.id', '=', 'siswa_kelas.id')->get(['siswa_kelas.*', 'data_kelas.nama_wali_kelas']);
        $data_siswa = DataSiswa::select('nis', 'nisn', 'nama', 'alamat')->get();
        return view('dev.data_kelas', compact('update_kelas', 'data_kelas', 'data_siswa', 'd_kelas_siswa'));
    }

    public function updated_data_kelas_siswa(Request $request, $id){
            $updateSiswa_kelas = SiswaKelas::where('id', $id)->first();
           $siswa = $request->siswa;
            $kelas = $request->kelas;

            $h_siswa = explode(",", $siswa);
            $array_siswa = array_map('trim', $h_siswa);
            $h_kelas = explode(",", $kelas);
            $array_kelas = array_map('trim', $h_kelas);
        $dataSiswakelas = $updateSiswa_kelas->update([
            'nisn' => $array_siswa[0],
            'nis' => $array_siswa[1],
            'nama' => $array_siswa[2],
            'kode_kelas' => $array_kelas[0],
            'nama_kelas' => $array_kelas[1],
            'keterangan' => $request->keterangan,
            'user_create' => 'null',
            'user_edit' => Auth::user()->name,
            'id_user' => Auth::user()->id,
        ]);

        return redirect(route('data_kelas'));
    }

    public function deleted_data_kelas_siswa(Request $request, $id){
        $Siswakelas_deleted = SiswaKelas::where('id', $id)->first();
        if ($Siswakelas_deleted) {
            $Siswadelete_kelas = $Siswakelas_deleted->delete();
        }
        return redirect(route('data_kelas'));
    }

}

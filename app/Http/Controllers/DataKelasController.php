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
        $d_kelas_siswa = SiswaKelas::all();
        $data_siswa = DataSiswa::all(['nis', 'nisn', 'nama', 'alamat']);
        $data_guru = DataPegawai::select('nama_pegawai')->where('jabatan', '=', 'Guru')->get();
        return view('dev.data_kelas', compact('data_kelas', 'update_kelas', 'data_siswa', 'data_guru', 'd_kelas_siswa'));
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
        $data_kelas = $data_kelas = DataKelas::all();
        $d_kelas_siswa = SiswaKelas::all();
        $data_siswa = DataSiswa::select('nis', 'nisn', 'nama', 'alamat')->get();
        $data_guru = DataPegawai::select('nama_pegawai')->where('jabatan', '=', 'Guru')->get();
        return view('dev.data_kelas', compact('update_kelas', 'data_kelas', 'data_siswa', 'data_guru'));
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

        return redirect(route('data_kelas'));
    }

    public function deleted_data_kelas(Request $request, $id){
        $kelas_deleted = DataKelas::where('id', $id)->first();
        if ($kelas_deleted) {
            $delete_kelas = $kelas_deleted->delete();
        }
        return redirect(route('data_kelas'));
    }


    //data kelas untuk siswa

    public function create_data_kelas_siswa(Request $request){

        $dataSiswakelas = SiswaKelas::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'keterangan' => $request->keterangan,
            'user_create' => Auth::user()->name,
            'user_edit' => 'null',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->back()->withErrors('gagal menyimpan')->withInput();
    }

    public function update_data_kelas_siswa(Request $request, $id){
        $update_kelas = DataKelas::where('id', $id)->first();
        $data_kelas = $data_kelas = DataKelas::all();
        $d_kelas_siswa = SiswaKelas::all();
        $data_siswa = DataSiswa::select('nis', 'nisn', 'nama', 'alamat')->get();
        $data_guru = DataPegawai::select('nama_pegawai')->where('jabatan', '=', 'Guru')->get();
        return view('dev.data_kelas', compact('update_kelas', 'data_kelas', 'data_siswa', 'data_guru'));
    }

    public function updated_data_kelas_siswa(Request $request, $id){
        $updateSiswa_kelas = SiswaKelas::where('id', $id)->first();
        $dataSiswakelas = $updateSiswa_kelas->update([
           'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
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

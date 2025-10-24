<?php

namespace App\Http\Controllers;

use App\Models\DataKelas;
use App\Models\DataPegawai;
use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\SiswaKelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function index(){
        return view('guru.index');
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

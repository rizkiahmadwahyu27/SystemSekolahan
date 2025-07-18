<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKelas;
use App\Models\DataSiswa;
use App\Models\DataPegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DataKelasController extends Controller
{
    public function data_kelas(){
        $data_kelas = DataKelas::join('data_siswas', 'data_siswas.nis', '=', 'data_kelas.nis')->get(['data_siswas.nama', 'data_kelas.*']);
        $update_kelas = null;
        $data_siswa = DataSiswa::all(['nis', 'nisn', 'nama', 'alamat']);
        $data_guru = DataPegawai::select('nama_pegawai')->where('jabatan', '=', 'Guru')->get();
        return view('dev.data_kelas', compact('data_kelas', 'update_kelas', 'data_siswa', 'data_guru'));
    }

    public function create_data_kelas(Request $request){
        
        $datakelas = DataKelas::create([
            'nis' => $request->nis,
            'kelas_x' => $request->kelas_x,
            'nama_wali_kelas_x' => $request->nama_wali_kelas_x,
            'id_kelas_x' => 10,
            'kelas_xi' => $request->kelas_xi,
            'nama_wali_kelas_xi' => $request->nama_wali_kelas_xi,
            'id_kelas_xi' => 11,
            'kelas_xii' => $request->kelas_xii,
            'nama_wali_kelas_xii' => $request->nama_wali_kelas_xii,
            'id_kelas_xii' => 12,
            'total_siswa' => $request->jlh_siswa + $request->jlh_siswi,
            'jlh_siswa' => $request->jlh_siswa,
            'jlh_siswi' => $request->jlh_siswi,
            'keterangan' => $request->keterangan,
            'user_input' => Auth::user()->name,
            'user_edit' => 'Null',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->back()->withErrors('gagal menyimpan')->withInput();
    }

    public function update_data_kelas(Request $request, $id){
        $update_kelas = DataKelas::where('id', $id)->first();
        $data_kelas = $data_kelas = DataKelas::join('data_siswas', 'data_siswas.nis', '=', 'data_kelas.nis')->get(['data_siswas.nama', 'data_kelas.*']);
        $data_siswa = DataSiswa::select('nis', 'nisn', 'nama', 'alamat')->get();
        $data_guru = DataPegawai::select('nama_pegawai')->where('jabatan', '=', 'Guru')->get();
        return view('dev.data_kelas', compact('update_kelas', 'data_kelas', 'data_siswa', 'data_guru'));
    }

    public function updated_data_kelas(Request $request, $id){
        $update_kelas = DataKelas::where('id', $id)->first();
        $datakelas = $update_kelas->update([
            'nis' => $request->nis,
            'kelas_x' => $request->kelas_x,
            'nama_wali_kelas_x' => $request->nama_wali_kelas_x,
            'id_kelas_x' => 10,
            'kelas_xi' => $request->kelas_xi,
            'nama_wali_kelas_xi' => $request->nama_wali_kelas_xi,
            'id_kelas_xi' => 11,
            'kelas_xii' => $request->kelas_xii,
            'nama_wali_kelas_xii' => $request->nama_wali_kelas_xii,
            'id_kelas_xii' => 12,
            'total_siswa' => $request->jlh_siswa + $request->jlh_siswi,
            'jlh_siswa' => $request->jlh_siswa,
            'jlh_siswi' => $request->jlh_siswi,
            'keterangan' => $request->keterangan,
            'user_edit' => Auth::user()->name,
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

}

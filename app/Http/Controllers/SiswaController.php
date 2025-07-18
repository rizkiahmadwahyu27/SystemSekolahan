<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index(){
       return view('siswa.index'); 
    }


    public function create_data_siswa(Request $request){
        
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
            'id_user_edit_or_create' => Auth::user()->id,
        ]);

        return redirect()->back()->withErrors('gagal menyimpan')->withInput();
    }

    public function update_data_siswa(Request $request, $id){
        $siswa_update = DataSiswa::where('id', $id)->first();
        $siswas = DataSiswa::select('nis', 'nisn', 'nama', 'jenis_kelamin', 'agama', 'alamat', 'nama_ibu', 'nama_ayah', 'id')->get();
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
            'id_user_edit_or_create' => Auth::user()->id,
        ]);

        return redirect(route('data_siswa'));
    }

    public function deleted_data_siswa(Request $request, $id){
        $siswa_deleted = DataSiswa::where('id', $id)->first();
        if ($siswa_deleted) {
            $delete_siswa = $siswa_deleted->delete();
        }
        return redirect(route('data_siswa'));
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
}

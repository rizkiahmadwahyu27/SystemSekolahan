<?php

namespace App\Http\Controllers;

use App\Exports\DataKelasExport;
use App\Models\Configurasi;
use Illuminate\Http\Request;
use App\Models\DataKelas;
use App\Models\DataSiswa;
use App\Models\SiswaKelas;
use App\Models\DataPegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

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
        $data_guru = DataPegawai::select('nama_pegawai', 'id')->get();
        return view('dev.set_kelas', compact('data_guru', 'data_kelas', 'update_kelas'));
    }

    public function create_data_kelas(Request $request){
        $conf = Configurasi::where('status', 'aktif')->first();
        $id_wali_kelas = explode('-', $request->nama_wali_kelas);

        $stopWords = [
            'DAN','KE','DI','DARI','PADA','UNTUK','DENGAN','THE','OF'
        ];

        $kata = preg_split('/\s+/', strtoupper(trim($request->nama_kelas)));

       // Ambil tingkat (X / XI / XII)
        $tingkat = array_shift($kata);

        $singkatan = '';
        foreach ($kata as $k) {
            if (!in_array($k, $stopWords)) {
                $singkatan .= $k[0];
            }
            if ($k == 'PEMASARAN') {
                $singkatan = 'PM';
            }
        }
        $kode_kelas = $tingkat . ' ' . $singkatan;
        $datakelas = DataKelas::create([
            'kode_kelas' => $kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'nama_wali_kelas' => $id_wali_kelas[1],
            'user_input' => Auth::user()->name,
            'user_edit' => 'null',
            'id_conf' => $conf->id,
            'id_wali_kelas' => $id_wali_kelas[0],
            'id_user_input' => Auth::user()->id,
            'id_user_edit' => null,
            
        ]);
        
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function update_data_kelas(Request $request, $id){
        $update_kelas = DataKelas::where('id', $id)->first();
        $data_kelas = DataKelas::all();
        $data_guru = DataPegawai::select('nama_pegawai', 'id')->get();
        return view('dev.set_kelas', compact('update_kelas', 'data_kelas', 'data_guru'));
    }

    public function updated_data_kelas(Request $request, $id){
        $update_kelas = DataKelas::where('id', $id)->first();
        $id_wali_kelas = explode('-', $request->nama_wali_kelas);
          $stopWords = [
            'DAN','KE','DI','DARI','PADA','UNTUK','DENGAN','THE','OF'
        ];

        $kata = preg_split('/\s+/', strtoupper(trim($request->nama_kelas)));

       // Ambil tingkat (X / XI / XII)
        $tingkat = array_shift($kata);

        $singkatan = '';
        foreach ($kata as $k) {
            if (!in_array($k, $stopWords)) {
                $singkatan .= $k[0];
            }
            if ($k == 'PEMASARAN') {
                $singkatan = 'PM';
            }
        }
        $kode_kelas = $tingkat . ' ' . $singkatan;
        $datakelas = $update_kelas->update([
            'kode_kelas' => $kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'nama_wali_kelas' => $id_wali_kelas[1],
            'id_wali_kelas' => $id_wali_kelas[0],
            'id_user_edit' => Auth::user()->id,
        ]);
                return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_kelas(Request $request, $id){
        $kelas_deleted = DataKelas::where('id', $id)->first();
        if ($kelas_deleted) {
            $delete_kelas = $kelas_deleted->delete();
        }
        
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    //data kelas untuk siswa

    public function create_data_kelas_siswa(Request $request){
        $siswa = $request->siswa;
        $kelas = $request->kelas;
        $conf = Configurasi::where('status', 'aktif')->first();
        $h_siswa = explode(",", $siswa);
        $array_siswa = array_map('trim', $h_siswa);
        $h_kelas = explode(",", $kelas);
        $array_kelas = array_map('trim', $h_kelas);
        $id_siswa = DataSiswa::where('nis', $array_siswa[1])->first();
        $id_wali_kelas = DataKelas::where('kode_kelas', $array_kelas[0])->first();
        $dataSiswakelas = SiswaKelas::create([
            'nisn' => $array_siswa[0],
            'nis' => $array_siswa[1],
            'nama' => $array_siswa[2],
            'kode_kelas' => $array_kelas[0],
            'nama_kelas' => $array_kelas[1],
            'keterangan' => $request->keterangan,
            'user_create' => Auth::user()->name,
            'edit_user' => 'null',
            'id_conf' => $conf->id,
            'id_user_input' => Auth::user()->id,
            'id_user_edit' => null,
            'id_siswa' => $id_siswa->id,
            'id_kelas' => $id_wali_kelas->id,
            'id_wali_kelas' => $id_wali_kelas->id_wali_kelas,
        ]);
        
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
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
            $id_siswa = DataSiswa::where('nis', $array_siswa[1])->first();
            $id_wali_kelas = DataKelas::where('kode_kelas', $array_kelas[0])->first();
        $dataSiswakelas = $updateSiswa_kelas->update([
            'nisn' => $array_siswa[0],
            'nis' => $array_siswa[1],
            'nama' => $array_siswa[2],
            'kode_kelas' => $array_kelas[0],
            'nama_kelas' => $array_kelas[1],
            'keterangan' => $request->keterangan,
            'user_edit' => Auth::user()->name,
             'id_user_edit' => Auth::user()->id,
             'id_siswa' => $id_siswa->id,
            'id_kelas' => $id_wali_kelas->id,
            'id_wali_kelas' => $id_wali_kelas->id_wali_kelas,
        ]);
                return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_kelas_siswa(Request $request, $id){
        $Siswakelas_deleted = SiswaKelas::where('id', $id)->first();
        if ($Siswakelas_deleted) {
            $Siswadelete_kelas = $Siswakelas_deleted->delete();
        }
        
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function exportDataKelas(){
        return Excel::download(new DataKelasExport, 'data_kelas.xlsx');
    }

}

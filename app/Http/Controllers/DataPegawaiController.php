<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPegawai;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataPegawaiController extends Controller
{
        public function data_pegawai(){
        $data_pegawai = DataPegawai::all();
        $pegawai_update = null;
        return view('dev.data_pegawai', compact('data_pegawai', 'pegawai_update'));
    }

    public function create_data_pegawai(Request $request){
        
        if ($request->jabatan == 'Kepala Sekolah') {
            $id_pegawai = 'kpls' . date('Y') . '001';
        }elseif ($request->jabatan == 'Waka Kurikulum' || $request->jabatan == 'Waka Kesiswaan' || $request->jabatan == 'Waka Humas') {
            $id_pegawai = 'waka' . date('Y') . '002';
        }elseif ($request->jabatan == 'Kepala Tata Usaha') {
            $id_pegawai = 'kptu' . date('Y') . '003';
        }elseif ($request->jabatan == 'Guru') {
            $id_pegawai = 'guru' . date('Y') . '004';
        }else {
            $id_pegawai = 'stf' . date('Y') . '005';
        }

        $datapegawai = DataPegawai::create([
            'id_pegawai' => $id_pegawai,
            'id_pegawai_mutasi' => 'Null',
            'nuptk' => $request->nuptk,
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nomor_sertif_pendidik' => $request->nomor_sertif_pendidik,
            'nama_pegawai' => $request->nama_pegawai,
            'pendidikan_akhir' => $request->pendidikan_akhir,
            'jurusan' => $request->jurusan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'pangkat_or_golongan' => $request->pangkat_or_golongan,
            'jabatan' => $request->jabatan,
            'tugas_tambahan' => $request->tugas_tambahan,
            'nama_instansi' => $request->nama_instansi,
            'nama_instansi_cab' => $request->nama_instansi_cab,
            'mata_pelajaran_1' => $request->mata_pelajaran_1,
            'mata_pelajaran_2' => $request->mata_pelajaran_2,
            'mata_pelajaran_3' => $request->mata_pelajaran_3,
            'mata_pelajaran_4' => $request->mata_pelajaran_4,
            'mata_pelajaran_5' => $request->mata_pelajaran_5,
            'mata_pelajaran_6' => $request->mata_pelajaran_6,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'user_input' => Auth::user()->name,
            'user_edit'=> 'Null',
        ]);
        
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function update_data_pegawai(Request $request, $id){
        $pegawai_update = DataPegawai::where('id', $id)->first();
        $data_pegawai = DataPegawai::all();
        return view('dev.data_pegawai', compact('pegawai_update', 'data_pegawai'));
    }

    public function updated_data_pegawai(Request $request, $id){
        $update_pegawai = DataPegawai::where('id', $id)->first();

        
        if ($update_pegawai->jabatan == $request->jabatan && $update_pegawai->id_pegawai_mutasi == 'Null') {
             $datapegawai = $update_pegawai->update([
                'id_pegawai' => $update_pegawai->id_pegawai,
                'id_pegawai_mutasi' => 'Null',
                'nuptk' => $request->nuptk,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'nomor_sertif_pendidik' => $request->nomor_sertif_pendidik,
                'nama_pegawai' => $request->nama_pegawai,
                'pendidikan_akhir' => $request->pendidikan_akhir,
                'jurusan' => $request->jurusan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'agama' => $request->agama,
                'pangkat_or_golongan' => $request->pangkat_or_golongan,
                'jabatan' => $request->jabatan,
                'tugas_tambahan' => $request->tugas_tambahan,
                'nama_instansi' => $request->nama_instansi,
                'nama_instansi_cab' => $request->nama_instansi_cab,
                'mata_pelajaran_1' => $request->mata_pelajaran_1,
                'mata_pelajaran_2' => $request->mata_pelajaran_2,
                'mata_pelajaran_3' => $request->mata_pelajaran_3,
                'mata_pelajaran_4' => $request->mata_pelajaran_4,
                'mata_pelajaran_5' => $request->mata_pelajaran_5,
                'mata_pelajaran_6' => $request->mata_pelajaran_6,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'user_edit'=> Auth::user()->name,
            ]);
        }elseif ($update_pegawai->jabatan == $request->jabatan && $update_pegawai->id_pegawai_mutasi != 'Null') {
            if ($request->jabatan == 'Kepala Sekolah') {
                $id_pegawai_mutasi = 'kpls' . date('Y') . '001';
            }elseif ($request->jabatan == 'Waka Kurikulum' || $request->jabatan == 'Waka Kesiswaan' || $request->jabatan == 'Waka Humas') {
                $id_pegawai_mutasi = 'waka' . date('Y') . '002';
            }elseif ($request->jabatan == 'Kepala Tata Usaha') {
                $id_pegawai_mutasi = 'kptu' . date('Y') . '003';
            }elseif ($request->jabatan == 'Guru') {
                $id_pegawai_mutasi = 'guru' . date('Y') . '004';
            }else {
                $id_pegawai_mutasi = 'stf' . date('Y') . '005';
            }
            $datapegawai = $update_pegawai->update([
                'id_pegawai' => $update_pegawai->id_pegawai_mutasi,
                'id_pegawai_mutasi' => $id_pegawai_mutasi,
                'nuptk' => $request->nuptk,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'nomor_sertif_pendidik' => $request->nomor_sertif_pendidik,
                'nama_pegawai' => $request->nama_pegawai,
                'pendidikan_akhir' => $request->pendidikan_akhir,
                'jurusan' => $request->jurusan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'agama' => $request->agama,
                'pangkat_or_golongan' => $request->pangkat_or_golongan,
                'jabatan' => $request->jabatan,
                'tugas_tambahan' => $request->tugas_tambahan,
                'nama_instansi' => $request->nama_instansi,
                'nama_instansi_cab' => $request->nama_instansi_cab,
                'mata_pelajaran_1' => $request->mata_pelajaran_1,
                'mata_pelajaran_2' => $request->mata_pelajaran_2,
                'mata_pelajaran_3' => $request->mata_pelajaran_3,
                'mata_pelajaran_4' => $request->mata_pelajaran_4,
                'mata_pelajaran_5' => $request->mata_pelajaran_5,
                'mata_pelajaran_6' => $request->mata_pelajaran_6,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'user_edit'=> Auth::user()->name,
            ]);
        }
        else {
            if ($request->jabatan == 'Kepala Sekolah') {
                $id_pegawai_mutasi = 'kpls' . date('Y') . '001';
            }elseif ($request->jabatan == 'Waka Kurikulum' || $request->jabatan == 'Waka Kesiswaan' || $request->jabatan == 'Waka Humas') {
                $id_pegawai_mutasi = 'waka' . date('Y') . '002';
            }elseif ($request->jabatan == 'Kepala Tata Usaha') {
                $id_pegawai_mutasi = 'kptu' . date('Y') . '003';
            }elseif ($request->jabatan == 'Guru') {
                $id_pegawai_mutasi = 'guru' . date('Y') . '004';
            }else {
                $id_pegawai_mutasi = 'stf' . date('Y') . '005';
            }

            $datapegawai = $update_pegawai->update([
                'id_pegawai_mutasi' => 'Null',
                'nuptk' => $request->nuptk,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'nomor_sertif_pendidik' => $request->nomor_sertif_pendidik,
                'nama_pegawai' => $request->nama_pegawai,
                'pendidikan_akhir' => $request->pendidikan_akhir,
                'jurusan' => $request->jurusan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'agama' => $request->agama,
                'pangkat_or_golongan' => $request->pangkat_or_golongan,
                'jabatan' => $request->jabatan,
                'tugas_tambahan' => $request->tugas_tambahan,
                'nama_instansi' => $request->nama_instansi,
                'nama_instansi_cab' => $request->nama_instansi_cab,
                'mata_pelajaran_1' => $request->mata_pelajaran_1,
                'mata_pelajaran_2' => $request->mata_pelajaran_2,
                'mata_pelajaran_3' => $request->mata_pelajaran_3,
                'mata_pelajaran_4' => $request->mata_pelajaran_4,
                'mata_pelajaran_5' => $request->mata_pelajaran_5,
                'mata_pelajaran_6' => $request->mata_pelajaran_6,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'user_edit'=> Auth::user()->name,
            ]);
        }
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_pegawai(Request $request, $id){
        $pegawai_deleted = DataPegawai::where('id', $id)->first();
        if ($pegawai_deleted) {
            $delete_pegawai = $pegawai_deleted->delete();
        }

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

}

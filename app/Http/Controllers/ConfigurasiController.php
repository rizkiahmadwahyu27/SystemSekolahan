<?php

namespace App\Http\Controllers;

use App\Models\Configurasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurasiController extends Controller
{
    public function index_config(){
        $update_config = [];

        $configurasi = Configurasi::select(['nama_sekolah', 'kode_sekolah', 'alamat', 'no_hp'])->first();
        
        $config = Configurasi::get(['alamat', 'nama_sekolah', 'tahun_ajaran', 'semester', 'id', 'status']);
        return view('dev.configurasi', compact('update_config', 'config', 'configurasi'));
    }

    public function create_config(Request $request){
       
        $config = Configurasi::create([
            'kode_sekolah' => $request->kode_sekolah,
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => $request->status,
            'user_create' => Auth::user()->name,
            'edit_user' => 'Null',
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->back();
    }

    public function update_config($id){
        $update_config = Configurasi::where('id', $id)->first();

        $configurasi = Configurasi::select(['nama_sekolah', 'kode_sekolah', 'alamat', 'no_hp'])->first();
        
        $config = Configurasi::get(['alamat', 'nama_sekolah', 'tahun_ajaran', 'semester', 'id', 'status']);
        return view('dev.configurasi', compact('update_config', 'config', 'configurasi'));
    }

    public function updated_config(Request $request, $id){
        $update_config = Configurasi::find($id);

        // Pastikan data ditemukan dulu
        if (!$update_config) {
            return redirect()->back()->with('error', 'Data konfigurasi tidak ditemukan.');
        }

        $update_config->update([
            'kode_sekolah' => $request->kode_sekolah,
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => $request->status,
            'user_create' => Auth::user()->name,
            'edit_user' => Auth::user()->name, // null tanpa tanda kutip
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Konfigurasi berhasil diperbarui.');
    }

    public function delete_config($id){
        $delete_conf = Configurasi::where('id', $id)->first();
        if ($delete_conf) {
            $delete_conf->delete();
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function index(){
        return view('guru.index');
    }

    public function data_siswa(){
        $siswas = DataSiswa::select('nis', 'nisn', 'nama', 'jenis_kelamin', 'agama', 'alamat', 'nama_ibu', 'nama_ayah', 'id')->get();
        $siswa_update = null;
        return view('guru.data_siswa', compact('siswas', 'siswa_update'));
    }
}

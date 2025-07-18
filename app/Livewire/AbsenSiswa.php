<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DataSiswa;
use App\Models\Absensi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AbsenSiswa extends Component
{
    public $absens, $nis, $nama, $kelas, $guru, $jenis_absen, $hari, $tanggal, $status, $keterangan, $user_inut, $user_edit, $id_user, $id;
    public $isEdit = false;

   protected $rules = [
        'nis' => 'required',
        'nama' => 'required',
        'kelas' => 'required',
        'guru' => 'required',
        'jenis_absen' => 'required|in:Harian,Mapel',
        'hari' => 'required',
        'tanggal' => 'required|date',
        'status' => 'required|in:Hadir,Izin,Sakit,Alpa',
        'keterangan' => 'required',
    ];


    public function render()
    {
        $this->absens = Absensi::latest()->get();
        return view('livewire.absen-siswa')->layout('layouts.app');
    }

    public function resetInput(){
        $this->nis = '';
        $this->nama = '';
        $this->kelas = '';
        $this->guru = '';
        $this->jenis_absen = '';
        $this->hari = '';
        $this->tanggal = '';
        $this->status = '';
        $this->keterangan = '';
    }

    public function store(){
        $this->validate();
        Absensi::create([
            'nis' => $this->nis,
            'nama' => $this->nama,
            'kelas' => $this->kelas,
            'guru' => $this->guru,
            'jenis_absen' => $this->jenis_absen,
            'hari' => $this->hari,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
            'keterangan' => $this->keterangan,
            'user_input' => Auth::user()->name,
            'user_edit' => 'Null',
            'id_user' => Auth::user()->id,
        ]);
        session()->flash('message', 'Data berhasil ditambahkan.');
        $this->resetInput();
        return redirect(route('absensi_siswa'));
    }

     public function edit($id)
    {
        $d_absen = Absensi::findOrFail($id);
        $this->id = $id;
        $this->nis = $d_absen->nis;
        $this->nama = $d_absen->nama;
        $this->kelas = $d_absen->kelas;
        $this->guru = $d_absen->guru;
        $this->jenis_absen = $d_absen->jenis_absen;
        $this->hari = $d_absen->hari;
        $this->tanggal = $d_absen->tanggal;
        $this->status = $d_absen->status;
        $this->keterangan = $d_absen->keterangan;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $absen = Absensi::find($this->id);
        $absen->update([
            'nis' => $this->nis,
            'nama' => $this->nama,
            'kelas' => $this->kelas,
            'guru' => $this->guru,
            'jenis_absen' => $this->jenis_absen,
            'hari' => $this->hari,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
            'keterangan' => $this->keterangan,
            'user_edit' => Auth::user()->name,
            'id_user' => Auth::user()->id,
        ]);

        session()->flash('message', 'Data berhasil diubah.');
        $this->resetInput();
        $this->isEdit = false;
    }


    public function delete($id)
    {
        Absensi::destroy($id);
       
        session()->flash('message', 'Data berhasil dihapus.');
         return redirect(route('absensi_siswa'));
    }

}

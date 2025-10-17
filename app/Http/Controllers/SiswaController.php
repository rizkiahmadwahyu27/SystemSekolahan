<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\Absensi;
use App\Models\DataKelas;
use App\Models\DataPegawai;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
;
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
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
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_siswa(Request $request, $id){
        $siswa_deleted = DataSiswa::where('id', $id)->first();
        if ($siswa_deleted) {
            $delete_siswa = $siswa_deleted->delete();
        }

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
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

    public function lap_absen_siswa(){
        $data_absen = Absensi::all();
        $update_absen = [];
        $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
        $data_guru = DataPegawai::get('nama_pegawai');
        $mapel_pegawai = DataPegawai::all()->map(function ($mapel) {
             $mapel->mapel = collect([
                $mapel->mata_pelajaran_1,
                $mapel->mata_pelajaran_2,
                $mapel->mata_pelajaran_3,
                $mapel->mata_pelajaran_4,
                $mapel->mata_pelajaran_5,
                $mapel->mata_pelajaran_6,
            ])
            ->filter(fn ($m) => $m !== '-' && !empty($m)) // buang "-" dan kosong
            ->unique() // buang duplikat
            ->values() // reset index array
            ->toArray();

            return $mapel;
        });
        return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
    }

    public function filter_absen_siswa(Request $request){
        $nama_guru = $request->nama_guru . $request->mapel;
        $data_absen = Absensi::where('kelas', $request->kelas)->orwhere('guru', $nama_guru)->orwhere('jenis_absen', $request->jenis_absen)->whereBetween('tanggal', [$request->tgl1, $request->tgl12])->get();
        $update_absen = [];
        $data_kelas = DataKelas::get('nama_kelas');
        $data_guru = DataPegawai::get('nama_pegawai');
        $mapel_pegawai = DataPegawai::all()->map(function ($mapel) {
             $mapel->mapel = collect([
                $mapel->mata_pelajaran_1,
                $mapel->mata_pelajaran_2,
                $mapel->mata_pelajaran_3,
                $mapel->mata_pelajaran_4,
                $mapel->mata_pelajaran_5,
                $mapel->mata_pelajaran_6,
            ])
            ->filter(fn ($m) => $m !== '-' && !empty($m)) // buang "-" dan kosong
            ->unique() // buang duplikat
            ->values() // reset index array
            ->toArray();

            return $mapel;
        });
        return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
    }

    public function update_data_absen_siswa(Request $request, $id){
        $nama_guru = $request->nama_guru . $request->mapel;
        $data_absen = Absensi::where('kelas', $request->kelas)->orwhere('guru', $nama_guru)->orwhere('jenis_absen', $request->jenis_absen)->whereBetween('tanggal', [$request->tgl1, $request->tgl12])->get();
        $update_absen = Absensi::find($id);
        $data_kelas = DataKelas::get('nama_kelas');
        $data_guru = DataPegawai::get('nama_pegawai');
        $mapel_pegawai = DataPegawai::all()->map(function ($mapel) {
             $mapel->mapel = collect([
                $mapel->mata_pelajaran_1,
                $mapel->mata_pelajaran_2,
                $mapel->mata_pelajaran_3,
                $mapel->mata_pelajaran_4,
                $mapel->mata_pelajaran_5,
                $mapel->mata_pelajaran_6,
            ])
            ->filter(fn ($m) => $m !== '-' && !empty($m)) // buang "-" dan kosong
            ->unique() // buang duplikat
            ->values() // reset index array
            ->toArray();

            return $mapel;
        });
        return view('dev.laporan_absen', compact('data_absen', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai', 'update_absen'));
    }

    public function updated_data_absen_siswa(Request $request, $id){
        $siswa_update = Absensi::find($id);
        $siswa_update->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'guru' => $request->guru,
            'kelas' => $request->kelas,
            'jenis_absen' => $request->jenis_absen,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_absen_siswa($id){
        $siswa_deleted = Absensi::find($id);
        $siswa_deleted->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function laporan_bulanan_siswa(){
        $tahun = date('Y');
        $bulan = date('m');

        // Ambil absensi untuk bulan & tahun sekarang
        $absensi = Absensi::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get(['nis', 'nama', 'tanggal', 'status']);

        // Grouping berdasarkan NIS
        $dataAbsensi = $absensi->groupBy('nis');

        $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
        $update_absen = [];
        $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
        $data_guru = DataPegawai::get('nama_pegawai');
        $mapel_pegawai = DataPegawai::all()->map(function ($mapel) {
             $mapel->mapel = collect([
                $mapel->mata_pelajaran_1,
                $mapel->mata_pelajaran_2,
                $mapel->mata_pelajaran_3,
                $mapel->mata_pelajaran_4,
                $mapel->mata_pelajaran_5,
                $mapel->mata_pelajaran_6,
            ])
            ->filter(fn ($m) => $m !== '-' && !empty($m)) // buang "-" dan kosong
            ->unique() // buang duplikat
            ->values() // reset index array
            ->toArray();

            return $mapel;
        });

        return view('siswa.lap_bulanan_siswa', compact('dataAbsensi', 'tahun', 'bulan', 'jumlahHari', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
    }

    public function filter_lap_bulanan_siswa(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        // Ambil absensi untuk bulan & tahun sekarang
        $guru = $request->guru . ', ' . $request->mapel;
        $absensi = Absensi::where(function ($q) use ($request, $guru) {
            $q->where('kelas', $request->kelas)
            ->where('guru', $guru)
            ->where('jenis_absen', $request->jenis_absen);
        })
        ->whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $bulan)
        ->get(['nis', 'nama', 'tanggal', 'status', 'kelas', 'guru', 'jenis_absen']);

        // dd($absensi);

        // Grouping berdasarkan NIS
        $dataAbsensi = $absensi->groupBy('nis');

        $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
        $update_absen = [];
        $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);
        $data_guru = DataPegawai::get('nama_pegawai');
        $mapel_pegawai = DataPegawai::all()->map(function ($mapel) {
             $mapel->mapel = collect([
                $mapel->mata_pelajaran_1,
                $mapel->mata_pelajaran_2,
                $mapel->mata_pelajaran_3,
                $mapel->mata_pelajaran_4,
                $mapel->mata_pelajaran_5,
                $mapel->mata_pelajaran_6,
            ])
            ->filter(fn ($m) => $m !== '-' && !empty($m)) // buang "-" dan kosong
            ->unique() // buang duplikat
            ->values() // reset index array
            ->toArray();

            return $mapel;
        });

        return view('siswa.lap_bulanan_siswa', compact('dataAbsensi', 'tahun', 'bulan', 'jumlahHari', 'update_absen', 'data_kelas', 'data_guru', 'mapel_pegawai'));
    }
}

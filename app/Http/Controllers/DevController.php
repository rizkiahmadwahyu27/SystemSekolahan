<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\DataKelas;
use App\Models\SiswaKelas;
use App\Models\DataPegawai;
use App\Models\Absensi;
use App\Models\Configurasi;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class DevController extends Controller
{
    public function index(){
        return view('dev.index');
    }

    public function scan_post($nis){
        $siswa = DataSiswa::join('siswa_kelas', 'siswa_kelas.nis', '=', 'data_siswas.nis')->where('data_siswas.nis', $nis)->first();
        $conf = Configurasi::where('status', 'aktif')->first();
         if (!$siswa) {
            return redirect(route('scan_barcode'))->with('error', 'Data Siswa Tidak Ada');
        }
        

        $hariInggris = date('l', strtotime(date('Y-m-d')));
        $hariIndonesia = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];

        $absen = Absensi::create([
            'nis' => $siswa->nis,
            'nama' => $siswa->nama,
            'kelas' => $siswa->nama_kelas,
            'guru' => Auth::user()->name,
            'jenis_absen' => 'harian',
            'hari' => $hariIndonesia[$hariInggris],
            'tanggal' => date('Y-m-d'),
            'status' => 'Hadir',
            'keterangan' => 'Hadir di Kelas',
            'user_input' => Auth::user()->name,
            'user_edit' => 'Null',
            'id_user' => $conf->id,
        ]); 
        // $this->kirimPesanWali($siswa, $absen);
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function data_absen(){
        $data_absen = Absensi::all();
        $absen_siswa = SiswaKelas::where('nama_kelas', '10')->get();
        $update_absen = null;
        $data_kelas = DataKelas::get('nama_kelas');
        $data_pegawai = DataPegawai::get('nama_pegawai');
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
        $p_mapel = '';
        $p_kelas = '';
        $p_guru = '';
        $p_tgl = '';
        $p_jenis = '';

        return view('dev.data_absen', compact('data_absen', 'mapel_pegawai', 'p_jenis', 'p_mapel', 'p_kelas', 'p_guru', 'p_tgl', 'absen_siswa', 'update_absen', 'data_kelas', 'data_pegawai'));
    }

    public function get_absen(Request $request){
        $absen_siswa = SiswaKelas::where('nama_kelas', $request->kelas)->get();
        $data_absen = Absensi::all();
        $update_absen = null;
        $data_kelas = DataKelas::get('nama_kelas');
        $data_pegawai = DataPegawai::get('nama_pegawai');
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
        $p_mapel = $request->mapel;
        $p_kelas = $request->kelas;
        $p_guru = $request->guru;
        $p_tgl = $request->tgl;
        $p_jenis = $request->jenis_absen;
        return view('dev.data_absen', compact('data_absen', 'mapel_pegawai', 'p_jenis', 'p_mapel', 'p_kelas', 'p_guru', 'p_tgl', 'absen_siswa', 'update_absen', 'data_kelas', 'data_pegawai'));
    }

    public function create_data_absen(Request $request){
        $nises   = $request->nis;
        $nama   = $request->nama;
        $status   = $request->status;
        $kelas    = $request->s_kelas;
        $jenis    = $request->s_jenis;
        $guru     = $request->s_guru . ', ' . $request->s_mapel;
        $tgl      = $request->s_tgl;
        $keterangan   = $request->keterangan;
        $hari = Carbon::parse($tgl)->format('l'); 
        $conf = Configurasi::where('status', 'aktif')->first();
        foreach ($nises as $key => $nis) {
            $siswa = DataSiswa::where('nis', $nis)->first();
            $nis_siswa = Absensi::where('nis', $nis)->where('tanggal', $tgl)->where('guru', $guru)->where('jenis_absen', $jenis)->first();
            if (!$nis_siswa) {
                $absen = Absensi::create([
                    'nis'      => $nis,
                    'nama'     => $nama[$key],
                    'kelas'    => $kelas,
                    'guru'     => $guru,
                    'jenis_absen' => $jenis,
                    'hari' => $hari,
                    'tanggal'      => $tgl,
                    'status'   => $status[$key],
                    'keterangan' => $keterangan[$key],
                    'user_input' => Auth::user()->name,
                    'user_edit' => 'Null',
                    'id_user' => $conf->id,
                ]);

                $this->kirimPesanWali($siswa, $absen);
            }
        }
        
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function update_data_absen(Request $request, $id){
        $update_absen = Absensi::where('id', $id)->first();
        $data_absen = Absensi::all();
        return view('siswa.absensi_siswa', compact('update_absen', 'data_absen'));
    }

    public function updated_data_absen(Request $request, $id){
        $update_absen = Absensi::where('id', $id)->first();
        $Absensi = $update_absen->update([
             'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'guru' => Auth::user()->name,
            'jenis_absen' => $request->jenis_absen,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'user_edit' => Auth::user()->name,
        ]);
        
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function deleted_data_absen(Request $request, $id){
        $absen_deleted = Absensi::where('id', $id)->first();
        if ($absen_deleted) {
            $delete_absen = $absen_deleted->delete();
        }
       
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    private function kirimPesanWali($siswa, $absen)
    {

        $pesan = " Assalamu alaikum wr.wb \n"

                ." Yth. Bapak/Ibu Wali Murid *{$siswa->nama}* \n"

                ." Kami pihak SMK Pelita Jatibarang menginformasikan bahwa sanya pada : \n"

                ." Hari, Tanggal : *{$absen->hari}*, *{$absen->tanggal}* \n" 
                ." Tempat : SMK Pelita Jatibarang \n" 
                ." Satatus Kehadiran : *{$absen->status}* \n"

                ." Demikian informasi yang disampaikan. \n"

                ." Jatibarang, *{$absen->tanggal}* \n"

                ." Kepala Sekolah, \n"


                ." Linda Tri Apsari, S.Pd";
            
        $nomor = $siswa->no_hp_ortu;

        // Pastikan hanya kirim jika format nomor benar
        if (preg_match('/^62\d{9,15}$/', $nomor)) {
            $response = Http::post(env('WA_BOT', 'http://localhost:4000/send-message'), [
                'number' => $nomor,
                'message' => $pesan
            ]);
            
            Log::info('Kirim ke bot:', $response->json());
        } else {
            Log::warning("Nomor tidak valid, pesan tidak dikirim: {$nomor}");
        }
    }
}

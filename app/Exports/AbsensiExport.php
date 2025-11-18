<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\DataPegawai;
use App\Models\DataKelas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $request = $this->request;
        
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if (Auth::user()->level == 'guru') {

            $data_guru = DataPegawai::where('id_pegawai', Auth::user()->id_user)->first();

            if ($request->jenis_absen == 'harian') {
                $absensi = Absensi::where('guru', $data_guru->nama_pegawai)
                    ->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan)
                    ->get(['nis', 'nama', 'tanggal', 'status']);
            } else {
                $guru = $request->guru . ', ' . $request->mapel;
    
                $absensi = Absensi::where('kelas', $request->kelas)
                    ->where('guru', $guru)
                    ->where('jenis_absen', $request->jenis_absen)
                    ->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan)
                    ->get(['nis', 'nama', 'tanggal', 'status', 'kelas', 'guru', 'jenis_absen']);
            }

        } else {

            if ($request->jenis_absen == 'harian') {
                $absensi = Absensi::where('guru', $request->guru)
                    ->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan)
                    ->get(['nis', 'nama', 'tanggal', 'status']);
            } else {
                $guru = $request->guru . ', ' . $request->mapel;

                $absensi = Absensi::where('kelas', $request->kelas)
                    ->where('guru', $guru)
                    ->where('jenis_absen', $request->jenis_absen)
                    ->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan)
                    ->get(['nis', 'nama', 'tanggal', 'status', 'kelas', 'guru', 'jenis_absen']);
            }

            $data_guru = DataPegawai::get(['nama_pegawai']);
        }

        $dataAbsensi = $absensi->groupBy('nis');
        $jumlahHari = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
        $data_kelas = DataKelas::get(['nama_kelas', 'kode_kelas']);

        return view('dev.export_absensi', compact(
            'dataAbsensi',
            'tahun',
            'bulan',
            'jumlahHari',
            'data_kelas',
            'data_guru'
        ));
    }
}

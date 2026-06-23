<?php

namespace App\Http\Controllers;

use App\Imports\SoalImport;
use App\Models\Jawaban;
use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Soal;
use App\Models\Ujian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AppUjianController extends Controller
{
    public function login()
{
    return view('appujian.login_ujian');
}

public function dashboard()
{
    $user = Auth::guard('user_ujian')->user();

    $ujians = Ujian::where('kelas', $user->kelas)
        ->where(function ($q) use ($user) {
            $q->whereNull('sesi')
              ->orWhere('sesi', $user->sesi);
        })
        ->get();

    return view('appujian.dashboard', compact('user', 'ujians'));
}

public function dashboard_ujian_admin()
{
    $ujians = Ujian::with('kategoris','kelas')->latest()->get();

    $now = Carbon::now();

    $total = $ujians->count();
    $aktif = $ujians->where('mulai', '<=', $now)
                    ->where('selesai', '>=', $now)
                    ->count();

    $selesai = $ujians->where('selesai', '<', $now)->count();

    // --- TAMBAHKAN LOGIKA INI ---
    // Looping setiap ujian untuk memastikan token yang digenerate adalah token aktif/valid
    $ujians->each(function($ujian) {
        $ujian->getValidToken(); 
    });
    // ----------------------------

    $update_ujian = [];
    $kategoris = KategoriSoal::all();
    $kelas = Kelas::all();
    $mapels = MataPelajaran::all();

    return view('appujian.dashboard_ujian_admin', compact('ujians', 'total', 'aktif', 'selesai', 'update_ujian', 'kategoris', 'kelas', 'mapels'));
}


// buat kategori soal
    public function store_kategori(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        KategoriSoal::create($request->all());

        return back()->with('success', 'Berhasil ditambahkan');
    }

    public function update_kategori(Request $request, $id)
    {
        $kategori = KategoriSoal::findOrFail($id);

        $kategori->update($request->all());

        return back()->with('success', 'Berhasil diupdate');
    }

    public function destroy_kategori($id)
    {
        KategoriSoal::destroy($id);

        return back()->with('success', 'Berhasil dihapus');
    }

    // buat kelas
    public function store_kelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required'
        ]);

        Kelas::create($request->all());

        return back()->with('success', 'Berhasil ditambahkan');
    }

    public function update_kelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->update($request->all());

        return back()->with('success', 'Berhasil diupdate');
    }

    public function destroy_kelas($id)
    {
        Kelas::destroy($id);

        return back()->with('success', 'Berhasil dihapus');
    }

    // buat mapel
    public function store_mapel(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required'
        ]);

        MataPelajaran::create($request->all());

        return back()->with('success', 'Berhasil ditambahkan');
    }

    public function update_mapel(Request $request, $id)
    {
        $mapel = MataPelajaran::findOrFail($id);

        $mapel->update($request->all());

        return back()->with('success', 'Berhasil diupdate');
    }

    public function destroy_mapel($id)
    {
        MataPelajaran::destroy($id);

        return back()->with('success', 'Berhasil dihapus');
    }

    //buat ujian
    public function store_ujian(Request $request)
{
    $request->validate([
        'nama_ujian' => 'required',
        'tipe' => 'required|in:sekolah,cat',
        'durasi' => 'required|integer|min:1',
        'mulai' => 'required|date',
        'selesai' => 'required|date|after:mulai',

        'mata_pelajaran_id' => $request->tipe == 'sekolah'
            ? 'required'
            : 'nullable',

        'kategori_id' => 'required|array',
        'kelas_id' => 'required|array',
    ]);

    // handle mapel
    $mataPelajaranId = $request->tipe == 'cat'
        ? null
        : $request->mata_pelajaran_id;

    // simpan ujian
    $ujian = Ujian::create([
        'nama_ujian' => $request->nama_ujian,
        'mata_pelajaran_id' => $mataPelajaranId,
        'durasi' => $request->durasi,
        'mulai' => $request->mulai,
        'selesai' => $request->selesai,
        'tipe' => $request->tipe,
        'deskripsi' => $request->deskripsi,
    ]);

    // relasi (pakai sync)
    $ujian->kategoris()->sync($request->kategori_id);
    $ujian->kelas()->sync($request->kelas_id);

    return back()->with('success','Ujian berhasil dibuat');
}

public function update_ujian(Request $request, $id)
{
    $request->validate([
        'nama_ujian' => 'required',
        'tipe' => 'required',
        'durasi' => 'required',
        'mulai' => 'required',
        'selesai' => 'required',
        'mata_pelajaran_id' => $request->tipe == 'sekolah'
            ? 'required'
            : 'nullable',
    ]);

    $ujian = Ujian::findOrFail($id);

    // handle mapel
    $mataPelajaranId = $request->tipe == 'cat'
        ? null
        : $request->mata_pelajaran_id;

    // update data utama
    $ujian->update([
        'nama_ujian' => $request->nama_ujian,
        'mata_pelajaran_id' => $mataPelajaranId,
        'durasi' => $request->durasi,
        'mulai' => $request->mulai,
        'selesai' => $request->selesai,
        'tipe' => $request->tipe,
        'deskripsi' => $request->deskripsi,
    ]);

    // 🔥 update relasi (INI PENTING)
    $ujian->kategoris()->sync($request->kategori_id);
    $ujian->kelas()->sync($request->kelas_id);

    return back()->with('success', 'Ujian berhasil diupdate');
}

public function destroy_ujian($id)
{
    $ujian = Ujian::findOrFail($id);

    // hapus relasi dulu (optional tapi aman)
    $ujian->kategoris()->detach();
    $ujian->kelas()->detach();

    // hapus ujian
    $ujian->delete();

    return back()->with('success', 'Ujian berhasil dihapus');
}


// soal ujian

public function index_soal()
    {
        $soals = Soal::with('ujian', 'kategori')->latest()->get();
        $ujians = Ujian::all();
        $kategoris = KategoriSoal::all();
        return view('appujian.index_soal', compact('soals', 'ujians', 'kategoris'));
    }


    public function store_soal(Request $request)
    {
        DB::beginTransaction();

        try {
            // upload gambar soal
            $gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar')->store('soal', 'public');
            }

            $soal = Soal::create([
                'ujian_id' => $request->ujian_id,
                'kategori_id' => $request->kategori_id,
                'pertanyaan' => $request->pertanyaan,
                'gambar' => $gambar,
                'tipe' => $request->tipe,
                'kunci_jawaban' => $request->kunci_jawaban,
                'bobot' => $request->bobot ?? 1,
            ]);

            // kalau PG
            if ($request->tipe == 'pg') {
                foreach ($request->opsi as $key => $opsi) {

                    $gambarOpsi = null;
                    if (isset($request->gambar_opsi[$key])) {
                        $gambarOpsi = $request->file('gambar_opsi')[$key]->store('jawaban', 'public');
                    }

                    Jawaban::create([
                        'soal_id' => $soal->id,
                        'opsi' => $key,
                        'isi_jawaban' => $opsi,
                        'gambar' => $gambarOpsi,
                        'is_benar' => ($request->jawaban_benar == $key)
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('soal.index')->with('success', 'Soal berhasil ditambah');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit_soal($id)
    {
        $soal = Soal::with('jawabans')->findOrFail($id);
        $ujians = Ujian::all();
        $kategoris = KategoriSoal::all();

        return view('soal.edit', compact('soal', 'ujians', 'kategoris'));
    }

    public function update_soal(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $soal = Soal::findOrFail($id);

            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar')->store('soal', 'public');
                $soal->gambar = $gambar;
            }

            $soal->update([
                'ujian_id' => $request->ujian_id,
                'kategori_id' => $request->kategori_id,
                'pertanyaan' => $request->pertanyaan,
                'tipe' => $request->tipe,
                'kunci_jawaban' => $request->kunci_jawaban,
                'bobot' => $request->bobot,
            ]);

            // reset jawaban lama
            $soal->jawabans()->delete();

            if ($request->tipe == 'pg') {
                foreach ($request->opsi as $key => $opsi) {

                    $gambarOpsi = null;
                    if (isset($request->gambar_opsi[$key])) {
                        $gambarOpsi = $request->file('gambar_opsi')[$key]->store('jawaban', 'public');
                    }

                    Jawaban::create([
                        'soal_id' => $soal->id,
                        'opsi' => $key,
                        'isi_jawaban' => $opsi,
                        'gambar' => $gambarOpsi,
                        'is_benar' => ($request->jawaban_benar == $key)
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('soal.index')->with('success', 'Soal berhasil diupdate');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy_soal($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return back()->with('success', 'Soal berhasil dihapus');
    }

    public function import_soal(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
        'ujian_id' => 'required',
        'tipe' => 'required'
    ]);

    Excel::import(
        new SoalImport(
            $request->ujian_id,
            $request->kategori_id,
            $request->tipe
        ),
        $request->file('file')
    );

    return back()->with('success', 'Import berhasil');
}

}

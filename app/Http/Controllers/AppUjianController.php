<?php

namespace App\Http\Controllers;

use App\Imports\PesertaImport;
use App\Imports\SoalImport;
use App\Models\HasilUjian;
use App\Models\Jawaban;
use App\Models\JawabanSiswa;
use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\UserUjian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AppUjianController extends Controller
{

// app ujian untuk siswa 
    public function login()
{
    return view('appujian.login_ujian');
}

public function dashboard()
{
    // 1. Ambil data siswa yang sedang login
    $siswa = Auth::guard('user_ujian')->user();
    
    // 2. Ambil string kelas dari tabel user_ujians milik siswa (misal nilainya: "XII-RPL-1")
    $kelasSiswa = $siswa->kelas; 

    // 3. Tarik data ujian yang terhubung ke kelas siswa tersebut
    // 🟢 PERBAIKAN: Ditambahkan relasi hasilUjians yang difilter khusus untuk siswa ini
    $ujians = Ujian::with(['kelas', 'hasilUjians' => function($query) use ($siswa) {
        $query->where('user_id', $siswa->id);
    }])->whereHas('kelas', function($query) use ($kelasSiswa) {
        // PENTING: Ganti 'nama_kelas' dengan nama kolom nama kelas di tabel `kelas` kamu
        $query->where('nama_kelas', $kelasSiswa); 
    })->latest()->get();

    // 4. Update token otomatis jika sudah lewat 15 menit
    $ujians->each(function($ujian) {
        $ujian->getValidToken(); 
    });

    $now = Carbon::now();

    // 5. Kirim data ke view dashboard siswa
    return view('appujian.dashboard', compact('ujians', 'now', 'siswa'));
}


// 1. Menampilkan halaman konfirmasi sebelum ujian
public function konfirmasiUjian($id)
{
    $ujian = Ujian::with('mataPelajaran')->findOrFail($id);
    $siswa = Auth::guard('user_ujian')->user();

    // Validasi Waktu: Jika belum mulai atau sudah selesai, kembalikan ke dashboard
    $now = now();
    if ($now->lt($ujian->mulai) || $now->gt($ujian->selesai)) {
        return redirect()->route('siswa.dashboard')->with('error', 'Ujian tidak sedang aktif atau waktu telah habis.');
    }

    return view('appujian.konfirmasi', compact('ujian', 'siswa'));
}

// 2. Memvalidasi token yang dimasukkan siswa
public function validasiToken(Request $request, $id)
{
    $request->validate([
        'token_input' => 'required|string|size:6',
    ]);

    $ujian = Ujian::findOrFail($id);

    // Cocokkan token input (jadikan uppercase) dengan token yang ada di database
    if (strtoupper($request->token_input) !== $ujian->token) {
        return back()->with('error', 'Token yang Anda masukkan salah atau sudah kedaluwarsa. Silakan minta token terbaru ke proktor!');
    }

    // Jika token benar, simpan "izin" di session agar siswa bisa membuka lembar soal
    session(['izin_ujian_' . $ujian->id => true]);

    // Alihkan ke halaman lembar soal (route ini akan kita buat setelah ini)
    return redirect()->route('ujian.kerjakan', $ujian->id);
}

public function kerjakanSoal($id)
{
    $ujian = Ujian::with('soals.jawabans')->findOrFail($id);
    $siswa = Auth::guard('user_ujian')->user();

    // 1. Amankan Izin Token
    if (!session('izin_ujian_' . $id)) {
        return redirect()->route('ujian.login')->with('error', 'Akses ilegal. Token diperlukan.');
    }

    // 2. DETEKSI DOUBLE DEVICE (Sudah disinkronkan dengan perubahan session ID)
    if ($siswa->session_id !== session()->getId()) {
        Auth::guard('user_ujian')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('ujian.login')->with('error', 'Akun Anda terdeteksi login di perangkat atau browser lain!');
    }

    // 3. Ambil data hasil ujian (bisa null jika siswa baru pertama kali masuk)
    $hasilUjian = \App\Models\HasilUjian::where('user_id', $siswa->id)
                                        ->where('ujian_id', $id)
                                        ->first();

    // 🟢 PERBAIKAN 1: Jangan langsung kick ke login jika data null.
    // Buat objek kosong sementara di memori agar hitungan durasi di bawah tidak error.
    $isBaru = false;
    if (!$hasilUjian) {
        $isBaru = true;
        $hasilUjian = new \App\Models\HasilUjian();
        $hasilUjian->mulai = now(); // Set waktu mulai dummy untuk kalkulasi sisa waktu awal
    }

    // 4. Hitung sisa waktu dalam satuan detik
    $totalDurasiDetik = $ujian->durasi * 60; 
    $waktuMulai = \Carbon\Carbon::parse($hasilUjian->mulai);
    $detikBerjalan = now()->diffInSeconds($waktuMulai); 
    
    // Hitung sisa detik
    $sisaDetik = max(0, $totalDurasiDetik - $detikBerjalan);

    // Jika waktu habis DAN data memang sudah ada di DB, otomatis selesaikan
    if ($sisaDetik <= 0 && !$isBaru) {
        return $this->selesaiUjian($id);
    }

    $soals = $ujian->soals; 
    
    // Ambil jawaban jika data hasil ujian sudah resmi tersimpan di DB
    $jawabanSiswa = [];
    if (!$isBaru) {
        $jawabanSiswa = \App\Models\JawabanSiswa::where('hasil_ujian_id', $hasilUjian->id)
                                                ->pluck('jawaban_id', 'soal_id') 
                                                ->toArray();
    }

    // 🟢 PERBAIKAN 2: Pastikan variabel $hasilUjian ikut dikirim ke View Blade
    return view('appujian.lembar_soal_cat', compact('ujian', 'soals', 'siswa', 'jawabanSiswa', 'sisaDetik', 'hasilUjian'));
}

public function simpanJawaban(Request $request, $id)
{
    $siswa = Auth::guard('user_ujian')->user();
    
    // Cari data opsi jawaban yang dipilih siswa
    $pilihan = \App\Models\Jawaban::findOrFail($request->jawaban_id);

    // Ambil Sesi Utama di tabel hasil_ujians
    $hasilUjian = \App\Models\HasilUjian::where('user_id', $siswa->id)
                                        ->where('ujian_id', $id)
                                        ->firstOrFail();

    // Simpan ke tabel jawaban_siswas
    \DB::table('jawaban_siswas')->updateOrInsert(
        [
            'hasil_ujian_id' => $hasilUjian->id,
            'soal_id'        => $request->soal_id,
        ],
        [
            'jawaban_id' => $pilihan->id,
            'is_benar'   => $pilihan->is_benar, // Otomatis bernilai true/false sesuai database jawaban
            'updated_at' => now()
        ]
    );

    return response()->json(['success' => true]);
}

public function selesaiUjian(Request $request, $id)
{
    $siswa = Auth::guard('user_ujian')->user();
    
    // 🟢 1. PROTEKSI UTAMA: Jika sesi siswa habis / null, jangan biarkan query database berjalan
    if (!$siswa) {
        // Hapus token ujian agar tidak mengunci browser
        session()->forget('izin_ujian_' . $id);
        
        // Alihkan langsung ke halaman login dengan pesan yang ramah
        return redirect()->route('ujian.login')->with('error', 'Sesi pengerjaan telah berakhir atau akun Anda telah keluar.');
    }

    // 2. Jika siswa ada, baru lanjutkan proses pencarian sesi ujian
    $hasilUjian = \App\Models\HasilUjian::where('user_id', $siswa->id)
                            ->where('ujian_id', $id)
                            ->first(); // Gunakan first() biasa, jangan firstOrFail agar bisa kita handle manual

    // 🟢 2. PROTEKSI KEDUA: Jika data hasil_ujians tidak ditemukan (misal sudah dihapus atau sudah selesai duluan)
    if (!$hasilUjian) {
        session()->forget('izin_ujian_' . $id);
        return redirect()->route('ujian.login')->with('error', 'Data ujian tidak ditemukan atau sudah disubmit sebelumnya.');
    }

    // --- SISA KODE KALKULASI NILAI DI BAWAHNYA TETAP SAMA ---
    $ujian = \App\Models\Ujian::withCount('soals')->findOrFail($id);
    $totalSoal = $ujian->soals_count; 

    if ($totalSoal == 0) {
        $totalSoal = \DB::table('jawaban_siswas')->where('hasil_ujian_id', $hasilUjian->id)->count();
    }

    $jumlahBenar = \DB::table('jawaban_siswas')
                        ->where('hasil_ujian_id', $hasilUjian->id)
                        ->where('is_benar', true)
                        ->count();

    $nilaiPg = $totalSoal > 0 ? round(($jumlahBenar / $totalSoal) * 100, 2) : 0;
    $catatan = $request->input('status_catatan', 'Selesai Normal');

    $hasilUjian->update([
        'selesai'     => now(),
        'nilai_pg'    => $nilaiPg,
        'nilai_akhir' => $nilaiPg,
    ]);

    session()->forget('izin_ujian_' . $id);
    
    return view('appujian.hasil_sekor', [
        'ujian'       => $ujian,
        'siswa'       => $siswa,
        'nilai'       => $nilaiPg,
        'jumlahBenar' => $jumlahBenar,
        'totalSoal'   => $totalSoal,
        'catatan'     => $catatan
    ]);
}


public function simpanJurusan(Request $request, $id)
{
    $siswa = Auth::guard('user_ujian')->user();
    
    if (!$siswa) {
        return redirect()->route('ujian.login')->with('error', 'Sesi habis, silakan login kembali.');
    }

    // Validasi data di backend
    if (!$request->pilihan_1 || !$request->pilihan_2 || $request->pilihan_1 == $request->pilihan_2) {
        return redirect()->back()->with('error', 'Pilihan jurusan tidak valid.');
    }

    // Simpan ke database
    \App\Models\HasilUjian::updateOrCreate(
        ['user_id' => $siswa->id, 'ujian_id' => $id],
        [
            'pilihan_1' => $request->pilihan_1,
            'pilihan_2' => $request->pilihan_2,
            'mulai'     => now()
        ]
    );

    // 🟢 REFRESH HALAMAN: Kembali ke halaman kerjakanSoal dengan data yang sudah siap
    return redirect()->route('ujian.kerjakan', $id)->with('start_fullscreen', true);
}

//  ini batasnya 





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
        'selesai' => 'required|date|after_or_equal:mulai', // Ganti 'after' menjadi 'after_or_equal'
        'mata_pelajaran_id' => $request->tipe == 'sekolah'
            ? 'required'
            : 'nullable',

        'kategori_id' => 'required|array',
        'kelas_id' => 'required|array',
    ]);

    // handle mapel
    return DB::transaction(function () use ($request) {
        
        $mataPelajaranId = $request->tipe == 'cat' ? null : $request->mata_pelajaran_id;

        $ujian = Ujian::create([
            'nama_ujian' => $request->nama_ujian,
            'mata_pelajaran_id' => $mataPelajaranId,
            'durasi' => $request->durasi,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'tipe' => $request->tipe,
            'deskripsi' => $request->deskripsi,
        ]);

        $ujian->kategoris()->sync($request->kategori_id);
        $ujian->kelas()->sync($request->kelas_id);

        return back()->with('success', 'Ujian berhasil dibuat');
    });
}

public function edit_ujian($id)
{
    $ujian = Ujian::findOrFail($id);
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

    return view('appujian.editUjian', compact('ujians','ujian', 'total', 'aktif', 'selesai', 'update_ujian', 'kategoris', 'kelas', 'mapels'));

}

// 2. Memproses Update Data Ujian
public function update_ujian(Request $request, $id)
{
    $ujian = Ujian::findOrFail($id);

    $request->validate([
        'nama_ujian' => 'required|string|max:255',
        'durasi'     => 'required|integer',
        'mulai'      => 'required|date',
        'selesai'    => 'required|date|after:mulai',
    ]);

    // Update data ujian
    $ujian->update([
        'nama_ujian' => $request->nama_ujian,
        'durasi'     => $request->durasi,
        'mulai'      => $request->mulai,
        'selesai'    => $request->selesai,
        'deskripsi'  => $request->deskripsi,
        'tipe'       => $request->tipe,
    ]);

    // Sinkronisasi ulang tabel pivot kelas jika admin mengubah kelas yang ikut ujian
    if ($request->has('kelas_ids')) {
        $ujian->kelas()->sync($request->kelas_ids);
    }

    return redirect()->route('admin.ujian.index')->with('success', 'Data ujian berhasil diperbarui!');
}

// 3. Memproses Hapus Ujian dengan Proteksi Keamanan
public function destroy_ujian($id)
{
    $ujian = Ujian::findOrFail($id);

    // PROTEKSI: Cek apakah sudah ada riwayat nilai siswa untuk ujian ini
    // Memanfaatkan fungsi relasi hasilUjian() yang ada di model Ujian kamu
    if ($ujian->hasilUjian()->exists()) {
        return back()->with('error', 'Ujian ini tidak boleh dihapus karena sudah ada siswa yang mengerjakan dan memiliki nilai!');
    }

    // Jika aman/belum ada yang mengerjakan, hapus relasi di tabel jembatan baru hapus ujiannya
    $ujian->kelas()->detach(); // Hapus link ke kelas di tabel ujian_kelas
    $ujian->soals()->delete(); // Hapus soal-soal yang nempel di ujian ini (jika diperlukan cascading)
    $ujian->delete();          // Hapus data utama ujian

    return back()->with('success', 'Ujian berhasil dihapus dari sistem.');
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

        // 🟢 PERBAIKAN LOGIKA: Tentukan kunci jawaban berdasarkan tipe soal yang dipilih
        $kunciJawaban = null;
        if ($request->tipe === 'pg') {
            $kunciJawaban = $request->kunci_jawaban; // Mengambil pilihan A, B, C, D, E
        } elseif ($request->tipe === 'essay') {
            $kunciJawaban = $request->jawaban_esay;  // Mengambil teks pedoman essay
        }

        $soal = Soal::create([
            'ujian_id' => $request->ujian_id,
            'kategori_id' => $request->kategori_id,
            'pertanyaan' => $request->pertanyaan,
            'gambar' => $gambar,
            'tipe' => $request->tipe,
            'kunci_jawaban' => $kunciJawaban, // 🟢 Sekarang dinamis mengikuti jenis soal
            'bobot' => $request->bobot ?? 1,
        ]);

        // kalau PG
        if ($request->tipe == 'pg' && is_array($request->opsi)) {
            foreach ($request->opsi as $key => $opsi) {

                $gambarOpsi = null;
                // Proteksi pengecekan file gambar_opsi agar tidak memicu error undefined index
                if ($request->hasFile('gambar_opsi') && isset($request->file('gambar_opsi')[$key])) {
                    $gambarOpsi = $request->file('gambar_opsi')[$key]->store('jawaban', 'public');
                }

                Jawaban::create([
                    'soal_id' => $soal->id,
                    'opsi' => $key,
                    'isi_jawaban' => $opsi,
                    'gambar' => $gambarOpsi,
                    'is_benar' => ($request->kunci_jawaban == $key)
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

// peserta ujian 

public function index_peserta()
    {
        $pesertas = UserUjian::all();
        $ujians = Ujian::all();
        $kategoris = KategoriSoal::all();
        $kelas = Kelas::all();
        return view('appujian.index_peserta', compact('pesertas', 'ujians', 'kategoris', 'kelas'));
    }
public function destroy_peserta($id)
    {
        $soal = UserUjian::findOrFail($id);
        $soal->delete();

        return back()->with('success', 'Soal berhasil dihapus');
    }
    public function import_peserta(Request $request) 
{
    $request->validate([
        'kelas'        => 'required|string',
        'file_peserta' => 'required|mimes:xlsx,xls,csv|max:2048'
    ]);

    // 2. Ambil string kelas dari request form
    $kelasPilihan = $request->input('kelas');

    // 3. Oper variabel $kelasPilihan ke dalam class PesertaImport
    Excel::import(new PesertaImport($kelasPilihan), $request->file('file_peserta'));

    return back()->with('success', "Semua data peserta untuk kelas {$kelasPilihan} berhasil di-import!");
}

// monitor peserta 
public function monitor_peserta()
    {
        // Mengambil semua peserta yang statusnya sedang login (is_login = true)
        $pesertaAktif = UserUjian::where('is_login', true)->get();
        
        // Mengambil semua peserta untuk list keseluruhan
        $semuaPeserta = UserUjian::latest()->get();

        return view('appujian.monitor', compact('pesertaAktif', 'semuaPeserta'));
    }

    // 2. Fungsi krusial untuk Reset Login (Force Logout) dari Admin
    public function resetLoginPeserta($id)
    {
        $peserta = UserUjian::findOrFail($id);
        
        // Kembalikan status login dan hapus tracking device-nya
        $peserta->update([
            'is_login'   => false,
            'device_id'  => null,
            'session_id' => null
        ]);

        return back()->with('success', "Status login peserta bernama {$peserta->nama} berhasil di-reset!");
    }


    //pemetaan jurusan
    
public function downloadReport($ujianId)
{
    // A. DEFINISI KUOTA
    $maksKuota = ['DKV' => 30, 'TJKT' => 30, 'MPLB' => 80, 'PM' => 80];
    $kuotaTerpakai = ['DKV' => 0, 'TJKT' => 0, 'MPLB' => 0, 'PM' => 0];

    // B. AMBIL DATA SISWA & URUTKAN BERDASARKAN NILAI (PENTING!)
    $peserta = DB::table('hasil_ujians')
        ->join('user_ujians', 'hasil_ujians.user_id', '=', 'user_ujians.id')
        ->where('hasil_ujians.ujian_id', $ujianId)
        ->select('user_ujians.id as siswa_id', 'user_ujians.no_peserta', 'user_ujians.nama', 
                 'hasil_ujians.pilihan_1', 'hasil_ujians.pilihan_2', 'hasil_ujians.nilai_akhir')
        ->orderBy('hasil_ujians.nilai_akhir', 'desc') // Urutkan nilai tertinggi duluan
        ->get();

    // C. AMBIL SKOR PER KATEGORI
    $nilaiSiswa = DB::table('jawaban_siswas')
        ->join('hasil_ujians', 'jawaban_siswas.hasil_ujian_id', '=', 'hasil_ujians.id')
        ->join('soals', 'jawaban_siswas.soal_id', '=', 'soals.id')
        ->join('kategori_soals', 'soals.kategori_id', '=', 'kategori_soals.id')
        ->where('hasil_ujians.ujian_id', $ujianId)
        ->where('jawaban_siswas.is_benar', true)
        ->select('hasil_ujians.user_id', 'kategori_soals.nama as nama_kategori', DB::raw('SUM(soals.bobot) as skor'))
        ->groupBy('hasil_ujians.user_id', 'kategori_soals.nama')
        ->get()
        ->groupBy('user_id');

    // D. PROSES PEMETAAN
    $laporanFinal = [];
    foreach ($peserta as $p) {
        $skor = isset($nilaiSiswa[$p->siswa_id]) ? $nilaiSiswa[$p->siswa_id]->pluck('skor', 'nama_kategori')->toArray() : [];
        arsort($skor);
        $kategoriPrioritas = array_keys($skor);
        
        // Prioritas: Pilihan 1 -> Pilihan 2 -> Kategori dengan skor tertinggi
        $urutanJurusan = array_unique(array_merge([$p->pilihan_1, $p->pilihan_2], $kategoriPrioritas));
        
        $diterimaDi = 'Belum Terpetakan';
        foreach ($urutanJurusan as $j) {
            // Pastikan jurusan yang dipilih ada dalam daftar kuota
            if (isset($maksKuota[$j]) && $kuotaTerpakai[$j] < $maksKuota[$j]) {
                $diterimaDi = $j;
                $kuotaTerpakai[$j]++;
                break;
            }
        }

        // Distribusi Kelas (MPLB 1 / MPLB 2)
        // Catatan: Jika kuota 80, maka ada 40 siswa per kelas
        $kelasDiterima = '-';
        if ($diterimaDi != 'Belum Terpetakan') {
            // Menggunakan ceil untuk membagi dua kelas
            $nomorKelas = ($kuotaTerpakai[$diterimaDi] <= ($maksKuota[$diterimaDi] / 2)) ? 1 : 2;
            $kelasDiterima = $diterimaDi . " " . $nomorKelas;
        }

        $laporanFinal[] = [
            'no' => $p->no_peserta, 'nama' => $p->nama,
            'p1' => $p->pilihan_1, 'p2' => $p->pilihan_2,
            'skor' => $skor, 'jurusan' => $diterimaDi, 'kelas' => $kelasDiterima
        ];
    }

    return $this->exportToCSV($laporanFinal);
}

/**
     * Pastikan fungsi ini ada di dalam class AppUjianController
     */
    private function exportToCSV($data) 
    {
        $header = "No Peserta;Nama;Pilihan 1;Pilihan 2;Nilai DKV;Nilai TJKT;Nilai MPLB;Nilai PM;Jurusan;Kelas\n";
        $csvData = $header;
        
        foreach ($data as $row) {
            // Mengambil nilai skor dari array dengan aman
            $skorDKV  = $row['skor']['DKV'] ?? 0;
            $skorTJKT = $row['skor']['TJKT'] ?? 0;
            $skorMPLB = $row['skor']['MPLB'] ?? 0;
            $skorPM   = $row['skor']['PM'] ?? 0;

            $csvData .= $row['no'] . ";" . 
                        $row['nama'] . ";" . 
                        $row['p1'] . ";" . 
                        $row['p2'] . ";" .
                        $skorDKV . ";" . 
                        $skorTJKT . ";" . 
                        $skorMPLB . ";" . 
                        $skorPM . ";" . 
                        $row['jurusan'] . ";" . 
                        $row['kelas'] . "\n";
        }

        return response($csvData)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="Laporan_Pemetaan_Siswa_' . date('Ymd_His') . '.csv"');
    }
}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian CBT Terproteksi - {{ $ujian->nama_ujian }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Mengunci total seleksi teks agar tidak bisa di-copy */
        body { 
            -webkit-user-select: none; 
            -moz-user-select: none; 
            -ms-user-select: none; 
            user-select: none; 
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col font-sans">

    @if(!$hasilUjian->exists || empty($hasilUjian->pilihan_1))
<div id="cheatOverlay" class="fixed inset-0 bg-slate-900 z-50 flex flex-col items-center justify-center p-6 text-white text-center transition-all duration-300">
    <form id="formJurusan" action="{{ route('ujian.simpan-jurusan', $ujian->id) }}" method="POST" class="bg-slate-800 border border-slate-700 p-8 rounded-3xl max-w-md w-full shadow-2xl text-left">
        @csrf
        <div class="w-14 h-14 bg-blue-500/10 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-500/20">
            <i class="fa-solid fa-user-graduate text-2xl"></i>
        </div>
        
        <h1 class="text-xl font-black text-center text-white mb-1">KONFIRMASI DATA PESERTA</h1>
        <p class="mb-6 text-xs text-slate-400 text-center leading-relaxed">Silakan pilih pemetaan jurusan yang Anda minati sebelum memulai ujian.</p>

        <div class="space-y-4 mb-6 text-sm">
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Pilihan Jurusan 1</label>
                <select id="select_pilihan_1" name="pilihan_1" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 cursor-pointer">
                    <option value="">-- Pilih Jurusan Utama --</option>
                    <option value="Pemasaran (PM)">Pemasaran (PM)</option>
                    <option value="Manajemen Perkantoran & Layanan Bisnis (MPLB)">Manajemen Perkantoran & Layanan Bisnis (MPLB)</option>
                    <option value="Teknik Jaringan Komputer dan Telekomunikasi (TJKT)">Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</option>
                    <option value="Desain Komunikasi Visual (DKV)">Desain Komunikasi Visual (DKV)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Pilihan Jurusan 2</label>
                <select id="select_pilihan_2" name="pilihan_2" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500 cursor-pointer">
                    <option value="">-- Pilih Jurusan Cadangan --</option>
                    <option value="Pemasaran (PM)">Pemasaran (PM)</option>
                    <option value="Manajemen Perkantoran & Layanan Bisnis (MPLB)">Manajemen Perkantoran & Layanan Bisnis (MPLB)</option>
                    <option value="Teknik Jaringan Komputer dan Telekomunikasi (TJKT)">Teknik Jaringan Komputer dan Telekomunikasi (TJKT)</option>
                    <option value="Desain Komunikasi Visual (DKV)">Desain Komunikasi Visual (DKV)</option>
                </select>
            </div>
        </div>

        <button type="button" onclick="simpanJurusanDanMulai()" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 cursor-pointer transition text-center text-sm flex items-center justify-center gap-2">
            <i class="fa-solid fa-expand"></i> Simpan & Mulai Ujian Fullscreen
        </button>
    </form>
</div>
@endif

    <header class="bg-white border-b border-slate-200 p-4 sticky top-0 z-30 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-3">
            <button onclick="toggleSidebar()" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg cursor-pointer">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <h1 class="font-bold text-slate-800 text-base md:text-lg">{{ $ujian->nama_ujian }}</h1>
        </div>
        
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-1.5 rounded-xl font-mono text-lg font-bold">
            <i class="fa-solid fa-clock mr-1"></i>
            <span id="timer">00:00:00</span>
        </div>
    </header>

    <div class="flex-1 flex relative">
        <main class="flex-1 p-4 md:p-6 max-w-4xl mx-auto w-full transition-all duration-300">
            @forelse($soals as $index => $soal)
                <div id="box-soal-{{ $index }}" class="soal-card bg-white rounded-2xl shadow-sm border border-slate-200 p-6 {{ $index == 0 ? '' : 'hidden' }}">
                    <div class="text-sm font-bold text-blue-600 border-b border-slate-100 pb-3 mb-4 flex justify-between items-center">
                        <span>SOAL NOMOR {{ $index + 1 }}</span>
                        <span class="text-xs bg-slate-100 text-slate-500 py-1 px-2.5 rounded-md uppercase">{{ $soal->tipe }}</span>
                    </div>

                    <div class="text-slate-800 text-base md:text-lg leading-relaxed mb-6 font-medium">
                        {!! $soal->pertanyaan !!}
                    </div>

                    @if (!empty($soal->gambar))
                        <div class="my-6 flex justify-center lg:justify-start">
                            <div class="relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-2 shadow-sm transition-all duration-300 hover:shadow-md max-w-full sm:max-w-md md:max-w-lg">
                                <img 
                                    src="{{ asset('storage/' . $soal->gambar) }}" 
                                    alt="Gambar Soal {{ $soal->id ?? '' }}" 
                                    class="w-full h-auto object-contain rounded-xl transition-transform duration-500 hover:scale-[1.03] cursor-zoom-in"
                                    loading="lazy"
                                >
                            </div>
                        </div>
                    @endif

                    <div class="space-y-3">
                        @foreach($soal->jawabans as $jawaban)
                            <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-slate-200 hover:border-blue-500 hover:bg-blue-50/20 cursor-pointer transition group">
                                <input type="radio" name="radio_soal_{{ $soal->id }}" value="{{ $jawaban->id }}"
                                       {{ (isset($jawabanSiswa[$soal->id]) && $jawabanSiswa[$soal->id] == $jawaban->id) ? 'checked' : '' }}
                                       onchange="jawabSoal({{ $index }}, {{ $soal->id }}, {{ $jawaban->id }})"
                                       class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500">
                                <span class="font-bold uppercase text-slate-400 group-hover:text-blue-600 transition">{{ $jawaban->opsi }}.</span>
                                <span class="text-slate-700">{!! $jawaban->isi_jawaban !!}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center mt-10 pt-4 border-t border-slate-100 gap-2">
                        <button onclick="navigasi({{ $index - 1 }}, false)" class="px-5 py-2.5 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-xl font-bold text-sm cursor-pointer transition {{ $index == 0 ? 'invisible' : '' }}">
                            <i class="fa-solid fa-chevron-left mr-1"></i> Kembali
                        </button>

                        <div class="flex items-center gap-2">
                            <button id="btn-skip-{{ $index }}" onclick="navigasi({{ $index + 1 }}, true)" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold text-sm cursor-pointer transition {{ $index == count($soals) - 1 ? 'hidden' : '' }} {{ isset($jawabanSiswa[$soal->id]) ? 'hidden' : '' }}">
                                Lewati Soal <i class="fa-solid fa-forward ml-1"></i>
                            </button>

                            <button id="btn-next-{{ $index }}" onclick="navigasi({{ $index + 1 }}, false)" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm cursor-pointer transition {{ $index == count($soals) - 1 ? 'hidden' : '' }} {{ isset($jawabanSiswa[$soal->id]) ? '' : 'hidden' }}">
                                Simpan & Lanjut <i class="fa-solid fa-chevron-right ml-1"></i>
                            </button>

                            @if($index == count($soals) - 1)
                                <button onclick="submitSelesai()" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm cursor-pointer transition shadow-sm">
                                    <i class="fa-solid fa-check-double mr-1"></i> Selesai Ujian
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border p-8 text-center text-slate-500">
                    <i class="fa-solid fa-folder-open text-4xl mb-2 text-slate-300"></i>
                    <p>Data soal tidak ditemukan atau belum direlasikan.</p>
                </div>
            @endforelse
        </main>

        <aside id="sidebarNav" class="fixed inset-y-0 right-0 z-40 w-72 bg-white border-l border-slate-200 p-5 shadow-xl lg:shadow-none lg:static lg:block transform translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
            <div class="flex justify-between items-center mb-4 lg:mb-6">
                <h3><i class="fa-solid fa-th mr-1.5 text-blue-600"></i> Navigasi Nomor</h3>
                <button onclick="toggleSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="grid grid-cols-5 gap-2 overflow-y-auto pr-1 flex-1 content-start" id="grid-nomor">
                @foreach($soals as $index => $soal)
                    @php
                        $colorClass = 'bg-white text-slate-600 border-slate-200';
                        if (isset($jawabanSiswa[$soal->id])) {
                            $colorClass = 'bg-emerald-500 text-white border-emerald-500';
                        }
                    @endphp
                    <button id="btn-nav-{{ $index }}" onclick="navigasi({{ $index }}, false); closeSidebarOnMobile();"
                            class="nav-buttons w-full py-2.5 rounded-xl font-bold text-sm border transition text-center cursor-pointer {{ $colorClass }}">
                        {{ $index + 1 }}
                    </button>
                @endforeach
            </div>

            <div class="border-t border-slate-100 pt-4 mt-4 grid grid-cols-1 gap-2 text-xs font-semibold text-slate-500">
                <div class="flex items-center gap-2"><span class="w-3.5 h-3.5 rounded-md bg-emerald-500 border border-emerald-600"></span> Sudah Diisi (Hijau)</div>
                <div class="flex items-center gap-2"><span class="w-3.5 h-3.5 rounded-md bg-amber-400 border border-amber-500"></span> Dilewati (Kuning)</div>
                <div class="flex items-center gap-2"><span class="w-3.5 h-3.5 rounded-md bg-white border border-slate-200"></span> Belum Diisi (Putih)</div>
            </div>
        </aside>
    </div>

    <script>
        let currentIdx = 0;
        let totalSoal = {{ count($soals) }};
        let timeLeft = {{ $sisaDetik }}; 
        let isExamActive = false; // Dikunci mati di awal agar input select bebas di-klik

        // 1. TIMER ENGINE
        const timerCount = setInterval(() => {
            if (!isExamActive) return; 
            let h = Math.floor(timeLeft / 3600);
            let m = Math.floor((timeLeft % 3600) / 60);
            let s = timeLeft % 60;
            document.getElementById('timer').innerText = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
            if (timeLeft <= 0) { clearInterval(timerCount); forceSubmitSelesai(); }
            timeLeft--;
        }, 1000);

        // 2. CONTROLLER JURUSAN & FULLSCREEN ENTRY
        // ========================================================
// CONTROLLER JURUSAN & ENGINE ENTRY (PERBAIKAN TOTAL)
// ========================================================

function simpanJurusanDanMulai() {
    let p1 = document.getElementById('select_pilihan_1').value;
    let p2 = document.getElementById('select_pilihan_2').value;

    // 1. Validasi Input kosong
    if (!p1 || !p2) {
        alert("⚠️ Anda wajib memilih Pilihan Jurusan 1 dan Pilihan Jurusan 2 terlebih dahulu!");
        return;
    }

    // 2. Validasi Pilihan ganda sama
    if (p1 === p2) {
        alert("⚠️ Pilihan Jurusan 1 dan Pilihan Jurusan 2 tidak boleh sama!");
        return;
    }

    // 3. Ambil Form berdasarkan ID lalu paksa Submit secara native HTML
    const formElement = document.getElementById('formJurusan');
    if (formElement) {
        formElement.submit(); // 🟢 Ini akan memaksa halaman melakukan reload POST ke Laravel
    } else {
        alert("Sistem Error: Form data tidak ditemukan.");
    }
}

// Logika otomatis saat halaman selesai dimuat ulang (Setelah POST simpanJurusan)
window.addEventListener('DOMContentLoaded', () => {
    
    // Periksa apakah siswa SUDAH memiliki data jurusan di database
    // Kita gunakan check exists secara aman dari laravel
    @if($hasilUjian->exists && !empty($hasilUjian->pilihan_1))
        
        // 1. Sembunyikan paksa overlay pemilihan jurusan
        const overlay = document.getElementById('cheatOverlay');
        if(overlay) {
            overlay.classList.add('hidden');
        }

        // 2. Tampilkan soal nomor pertama (index 0) yang tadinya tersembunyi
        const soalPertama = document.getElementById('box-soal-0');
        if (soalPertama) {
            soalPertama.classList.remove('hidden');
        }
        
        // 3. Munculkan tombol klik aman pemicu Fullscreen browser
        let pemicuAwal = document.createElement('div');
        pemicuAwal.className = "fixed inset-0 bg-slate-900/95 z-50 flex items-center justify-center text-white font-bold cursor-pointer";
        pemicuAwal.innerHTML = `
            <div class="bg-slate-800 p-8 rounded-3xl border border-slate-700 text-center max-w-sm shadow-2xl">
                <div class="w-12 h-12 bg-blue-500/10 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-expand text-xl animate-pulse"></i>
                </div>
                <h3 class="text-lg font-bold mb-1">DATA TERKONFIRMASI</h3>
                <p class="mb-5 text-xs text-slate-400 leading-relaxed">Silakan klik tombol di bawah untuk membuka lembar soal dan mengaktifkan Mode Aman Ujian.</p>
                <button class="w-full py-3 bg-blue-600 hover:bg-blue-700 rounded-xl text-sm font-bold shadow-lg transition">Buka Lembar Soal</button>
            </div>
        `;
        document.body.appendChild(pemicuAwal);

        // Ketika tombol "Buka Lembar Soal" diklik, layar menjadi fullscreen dan soal siap dikerjakan
        pemicuAwal.addEventListener('click', () => {
            let elem = document.documentElement;
            if (elem.requestFullscreen) { elem.requestFullscreen(); }
            else if (elem.webkitRequestFullscreen) { elem.webkitRequestFullscreen(); }
            else if (elem.msRequestFullscreen) { elem.msRequestFullscreen(); }
            
            pemicuAwal.remove();
            
            // Hidupkan sistem pertahanan anti-cheat & timer
            setTimeout(() => {
                isExamActive = true; 
            }, 500);
        });
    @endif
});

        // ==========================================
        // 🛡️ ENGINE SENSITIF ANTI-CHEAT
        // ==========================================
        document.addEventListener('fullscreenchange', () => {
            if (!document.fullscreenElement && isExamActive) {
                pemicuBlokirLayar("KECURANGAN TERDETEKSI!", "Anda dilarang keras keluar dari mode Fullscreen!");
            }
        });

        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden' && isExamActive) {
                pemicuBlokirLayar("PELANGGARAN TERDETEKSI!", "Sistem mencatat Anda meninggalkan halaman ujian!");
            }
        });

        window.addEventListener('blur', () => {
            if (isExamActive) {
                pemicuBlokirLayar("PERINGATAN SISTEM!", "Fokus browser hilang!");
            }
        });

        function pemicuBlokirLayar(judul, deskripsi) {
            isExamActive = false; 
            alert("UJIAN DIHENTIKAN!\n\nAlasan: " + deskripsi + "\n\nJawaban Anda disimpan otomatis.");

            let form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('ujian.selesai', $ujian->id) }}";
            form.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status_catatan" value="Terdeteksi Kecurangan">
            `;
            document.body.appendChild(form);
            form.submit();
        }

        // 3. PROTEKSI KEYBOARD & KLIK KANAN
        document.addEventListener('contextmenu', e => e.preventDefault());
        document.addEventListener('keydown', e => {
            if (e.key === 'F12') e.preventDefault();
            if (e.ctrlKey && ['c', 'v', 'u', 's', 'p'].includes(e.key.toLowerCase())) {
                e.preventDefault();
                alert('Fitur ini dinonaktifkan demi keamanan ujian.');
            }
        });

        // 4. NAVIGASI NOMOR SOAL
        function navigasi(targetIdx, isSkipped = false) {
            if (targetIdx < 0 || targetIdx >= totalSoal) return;

            const currentBtn = document.getElementById(`btn-nav-${currentIdx}`);
            if (isSkipped && !currentBtn.classList.contains('bg-emerald-500')) {
                currentBtn.className = "nav-buttons w-full py-2.5 rounded-xl font-bold text-sm border text-center cursor-pointer bg-amber-400 text-white border-amber-500";
            }

            document.getElementById(`box-soal-${currentIdx}`).classList.add('hidden');
            document.getElementById(`box-soal-${targetIdx}`).classList.remove('hidden');

            currentIdx = targetIdx;
            efekActiveNomor();
        }

        function jawabSoal(index, soalId, jawabanId) {
            const btn = document.getElementById(`btn-nav-${index}`);
            btn.className = "nav-buttons w-full py-2.5 rounded-xl font-bold text-sm border text-center cursor-pointer bg-emerald-500 text-white border-emerald-500";

            const skipBtn = document.getElementById(`btn-skip-${index}`);
            const nextBtn = document.getElementById(`btn-next-${index}`);
            if (skipBtn) skipBtn.classList.add('hidden');
            if (nextBtn) nextBtn.classList.remove('hidden');

            fetch("{{ route('ujian.simpan-jawaban', $ujian->id) }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ soal_id: soalId, jawaban_id: jawabanId })
            }).catch(err => console.error(err));
        }

        function efekActiveNomor() {
            document.querySelectorAll('.nav-buttons').forEach((btn, i) => {
                if (i === currentIdx) { btn.classList.add('ring-4', 'ring-blue-400'); } 
                else { btn.classList.remove('ring-4', 'ring-blue-400'); }
            });
        }
        efekActiveNomor();

        function toggleSidebar() { document.getElementById('sidebarNav').classList.toggle('translate-x-full'); }
        function closeSidebarOnMobile() { if (window.innerWidth < 1024) { toggleSidebar(); } }

        function submitSelesai() {
            if (confirm("Apakah Anda yakin ingin mengakhiri ujian? Semua jawaban akan dikunci.")) {
                forceSubmitSelesai();
            }
        }

        function forceSubmitSelesai() {
            isExamActive = false; 
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('ujian.selesai', $ujian->id) }}";
            form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}">`;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>
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

    <div id="cheatOverlay" class="fixed inset-0 bg-slate-900 z-50 flex flex-col items-center justify-center p-6 text-white text-center transition-all duration-300">
        <div class="bg-slate-800 border border-slate-700 p-8 rounded-3xl max-w-md shadow-2xl">
            <div class="w-16 h-16 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-500/20">
                <i class="fa-solid fa-triangle-exclamation text-2xl animate-pulse"></i>
            </div>
            <h1 id="cheatTitle" class="text-2xl font-black text-red-500 mb-2">MODE AMAN AKTIF</h1>
            <p id="cheatDesc" class="mb-6 text-sm text-slate-400 leading-relaxed">
                Ujian harus dikerjakan dalam mode Layar Penuh (Fullscreen). Membuka tab baru, meminimalkan browser, atau berpindah ke aplikasi lain dilarang keras!
            </p>
            <button onclick="aktifkanFullscreen()" class="w-full px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 cursor-pointer transition">
                <i class="fa-solid fa-expand mr-1.5"></i> Masuk Fullscreen & Mulai
            </button>
        </div>
    </div>

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
                <h3 class="font-bold text-slate-800 text-base"><i class="fa-solid fa-th mr-1.5 text-blue-600"></i> Navigasi Nomor</h3>
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

        // 🟢 PERBAIKAN: Mengambil sisa detik akurat dari database backend
        let timeLeft = {{ $sisaDetik }}; 
        let isExamActive = false;

        // 1. TIMER ENGINE
        const timerCount = setInterval(() => {
            if (!isExamActive) return; // Kunci timer jika mode cheat aktif
            let h = Math.floor(timeLeft / 3600);
            let m = Math.floor((timeLeft % 3600) / 60);
            let s = timeLeft % 60;
            document.getElementById('timer').innerText = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
            if (timeLeft <= 0) { clearInterval(timerCount); forceSubmitSelesai(); }
            timeLeft--;
        }, 1000);

        // 2. CONTROLLER FULLSCREEN API (Paksa Mengunci Layar)
        function aktifkanFullscreen() {
            let elem = document.documentElement;
            if (elem.requestFullscreen) { elem.requestFullscreen(); } 
            else if (elem.webkitRequestFullscreen) { elem.webkitRequestFullscreen(); } 
            else if (elem.msRequestFullscreen) { elem.msRequestFullscreen(); }
            
            // Sembunyikan layar hitam blokir
            document.getElementById('cheatOverlay').classList.add('hidden');
            isExamActive = true;
        }

        // ==========================================
        // 🟢 KODE BARU: ENGINE ANTI-CHEAT SANGAT SENSITIF
        // ==========================================

        // 1. Deteksi Keluar dari Mode Fullscreen
        document.addEventListener('fullscreenchange', () => {
            if (!document.fullscreenElement && isExamActive) {
                pemicuBlokirLayar("KECURANGAN TERDETEKSI!", "Anda dilarang keras keluar dari mode Layar Penuh (Fullscreen) selama ujian!");
            }
        });

        // 2. Deteksi Pindah Tab, Minimize, Buka Aplikasi Lain (Paling Akurat)
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden' && isExamActive) {
                pemicuBlokirLayar("PELANGGARAN TERDETEKSI!", "Sistem mencatat Anda meninggalkan halaman ujian (Membuka tab baru, meminimalkan browser, atau membuka aplikasi lain)!");
            }
        });

        // 3. Backup tambahan jika fokus jendela hilang
        window.addEventListener('blur', () => {
            if (isExamActive) {
                pemicuBlokirLayar("PERINGATAN SISTEM!", "Fokus browser hilang! Jangan mencoba membuka jendela atau aplikasi lain.");
            }
        });

        function pemicuBlokirLayar(judul, deskripsi) {
            // 1. Matikan status aktif agar tidak memicu loop deteksi ganda
            isExamActive = false; 
            
            // 2. Berikan notifikasi singkat sebelum halaman dialihkan
            alert("UJIAN DIHENTIKANSecara Otomatis!\n\nAlasan: " + deskripsi + "\n\nSistem akan langsung menyimpan jawaban terakhir Anda dan mengalihkan ke halaman nilai.");

            // 3. Paksa submit ujian saat itu juga (menggunakan fungsi yang sudah kita buat sebelumnya)
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('ujian.selesai', $ujian->id) }}";
            
            // Kita sisipkan input hidden tambahan untuk menandai bahwa siswa ini selesai karena DISKUALIFIKASI / CURANG
            form.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="status_catatan" value="Terdeteksi Kecurangan">
            `;
            document.body.appendChild(form);
            form.submit();
        }

        // 5. BLOKIR FITUR BROWSER (Klik Kanan, Copy, Paste, Inspect Element)
        document.addEventListener('contextmenu', e => e.preventDefault()); // Mati klik kanan
        document.addEventListener('keydown', e => {
            // Blokir F12
            if (e.key === 'F12') e.preventDefault();
            // Blokir Ctrl+C, Ctrl+V, Ctrl+U, Ctrl+S
            if (e.ctrlKey && ['c', 'v', 'u', 's', 'p'].includes(e.key.toLowerCase())) {
                e.preventDefault();
                alert('Fitur ini dinonaktifkan demi keamanan ujian.');
            }
        });

        // 6. FUNGSI NAVIGASI DAN INTERAKSI SOAL
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

        // 7. FINISH EXAM CONTROLLER
        function submitSelesai() {
            if (confirm("Apakah Anda yakin ingin mengakhiri ujian? Semua jawaban akan dikunci.")) {
                forceSubmitSelesai();
            }
        }

        function forceSubmitSelesai() {
            isExamActive = false; // Matikan anti-cheat sebelum lompat halaman
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
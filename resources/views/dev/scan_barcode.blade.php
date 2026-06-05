<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner Absensi</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { margin: 0; background: #000; overflow: hidden; font-family: sans-serif; }
        #camera { position: fixed; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; }
        .overlay { position: fixed; bottom: 20px; width: 100%; text-align: center; color: white; z-index: 3; font-size: 16px; }
        #flash { position: fixed; inset: 0; background: rgba(0,255,0,0.25); display: none; z-index: 5; pointer-events: none; }
        #resultBox { position: fixed; top: 20px; width: 100%; text-align: center; z-index: 4; color: white; font-size: 24px; font-weight: bold; }
    </style>
</head>
<body>

<video id="camera" autoplay playsinline></video>

<div id="resultBox"></div>
<div class="overlay">Silakan Scan Kartu Absensi</div>
<div id="flash"></div>

<input type="text" id="scan" style="position: absolute; opacity: 0; z-index: -1;" autofocus autocomplete="off">

<audio id="beep" src="https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg" preload="auto"></audio>

<script>
const input = document.getElementById('scan');
const flash = document.getElementById('flash');
const resultBox = document.getElementById('resultBox');
const audioBeep = document.getElementById('beep');

let isScanning = true;
let lastKode = null;
let lastScanTime = 0;
let reloadTimer;

// 🔥 OPTIMALISASI 1: AUTO FOCUS TANPA INTERVAL
// Begitu input kehilangan fokus (blur), paksa fokus kembali instan tanpa ganggu proses ketik.
input.addEventListener('blur', () => {
    setTimeout(() => input.focus(), 10);
});
// Pastikan langsung fokus saat web dimuat
document.addEventListener('DOMContentLoaded', () => input.focus());
document.addEventListener('click', () => input.focus());

// 🔥 TIMER AUTO RELOAD (IDLE 10 MENIT)
function startReloadTimer() {
    clearTimeout(reloadTimer);
    reloadTimer = setTimeout(() => {
        location.reload();
    }, 10 * 60 * 1000);
}
startReloadTimer();

// 🔥 DETEKSI SCAN KILAT
input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        let kode = input.value.trim();
        input.value = ''; // Langsung kosongkan agar siap menerima scan berikutnya

        if (!kode || !isScanning) return;

        // Bersihkan karakter non-numerik jika barcode berupa angka
        kode = kode.replace(/[^0-9.]/g, ''); 

        // OPTIMALISASI 2: ANTI DOUBLE LOCK JANGKA WAKTU (Cooldown 3 Detik untuk kartu yang sama)
        const currentTime = new Date().getTime();
        if (kode === lastKode && (currentTime - lastScanTime) < 3000) {
            return; // Tolak jika kartu yang sama di-scan ulang dalam kurung waktu < 3 detik
        }

        lastKode = kode;
        lastScanTime = currentTime;

        kirimAbsen(kode);
    }
});

// 🔥 FUNCTION ABSEN
function kirimAbsen(kode) {
    // Kunci scanner agar tidak mengeksekusi request ajax bertumpuk
    isScanning = false; 

    // Suara dimainkan di awal agar feedback instan ke siswa (tidak menunggu server merespon)
    audioBeep.currentTime = 0;
    audioBeep.play().catch(()=>{});

    // Flash Hijau Instan
    flash.style.display = 'block';
    setTimeout(() => flash.style.display = 'none', 150);

    fetch(`/scann/barcode/absen/post/${encodeURIComponent(kode)}`)
    .then(res => res.json())
    .then(data => {
        startReloadTimer();

        resultBox.innerHTML = data.nama ?? data.message;

        Swal.fire({
            icon: data.status ? 'success' : 'error',
            title: data.message,
            timer: 800, // Dipercepat jadi 800ms agar perputaran antrean lebih kilat
            showConfirmButton: false
        });

        // Reset status scanning agar siap scan kartu (orang) berikutnya
        setTimeout(() => {
            isScanning = true;
            resultBox.innerHTML = '';
        }, 600); 
    })
    .catch(() => {
        Swal.fire({
            icon: 'error',
            title: 'Server error',
            timer: 1000,
            showConfirmButton: false
        });
        isScanning = true;
    });
}

// 🎥 PREVIEW KAMERA 
navigator.mediaDevices.getUserMedia({
    video: { facingMode: "environment" }
})
.then(stream => {
    const videoEl = document.getElementById('camera');
    if(videoEl) videoEl.srcObject = stream;
})
.catch(err => console.error("Camera info: Preview tidak aktif atau tidak diizinkan."));

// FULLSCREEN
document.addEventListener('click', function() {
    const el = document.documentElement;
    if (el.requestFullscreen) el.requestFullscreen();
}, { once: true });
</script>

</body>
</html>
{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Scanner Absensi</title>

    <!-- Library -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            margin: 0;
            background: #000;
        }

        #reader {
            width: 100%;
            max-width: 400px;
            margin: auto;
            margin-top: 20px;
            position: relative;
        }

        .scan-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background: red;
            animation: scan 2s infinite;
        }

        @keyframes scan {
            0% { top: 10%; }
            100% { top: 90%; }
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center">

    <!-- Kamera Scanner -->
    <div id="reader">
        <div class="scan-line"></div>
    </div>

    <div class="text-white mt-3 text-sm">Scan QR / Barcode Siswa</div>

    <!-- Hidden input untuk scanner alat -->
    <input type="text" id="scan" autofocus style="position:absolute; left:-9999px;">

    <!-- Sound -->
    <audio id="beep" src="https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg"></audio>

<script>
let isScanning = true;
let lastResult = null;

const html5QrCode = new Html5Qrcode("reader");


// 🔥 FUNCTION UTAMA
function kirimAbsen(rawKode) {

    // ✅ pastikan string
    let kode = String(rawKode).trim();

    // ✅ hanya angka & titik
    kode = kode.replace(/[^0-9.]/g, '');

    // console.log("KIRIM:", kode);

    if (!kode) return;

    // 🔒 anti double scan
    if (!isScanning) return;
    if (kode === lastResult) return;

    isScanning = false;
    lastResult = kode;

    fetch(`/scann/barcode/absen/post/${encodeURIComponent(kode)}`, {
        method: "GET",
        headers: {
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(data => {

        Swal.fire({
            icon: data.status ? 'success' : 'error',
            title: data.message,
            timer: 1500,
            showConfirmButton: false
        });

        document.getElementById('beep').play().catch(()=>{});

        setTimeout(() => {
            isScanning = true;
            lastResult = null;
        }, 2000);
    })
    .catch(() => {
        Swal.fire({
            icon: 'error',
            title: 'Server error',
            timer: 1500,
            showConfirmButton: false
        });

        setTimeout(() => {
            isScanning = true;
        }, 2000);
    });
}


// ✅ SCAN DARI KAMERA
function onScanSuccess(decodedText) {
    kirimAbsen(decodedText);
}

function onScanError() {}


// 🚀 START CAMERA
Html5Qrcode.getCameras().then(devices => {
    if (devices.length) {
        html5QrCode.start(
            devices[0].id,
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess,
            onScanError
        );
    }
}).catch(err => console.error("Camera error:", err));


// 🔥 SCANNER ALAT (FIX BUFFER)
let buffer = '';
let timeout = null;

const input = document.getElementById('scan');

input.addEventListener('input', function() {

    buffer += this.value;
    this.value = '';

    clearTimeout(timeout);

    timeout = setTimeout(() => {

        let kode = buffer.trim();

        // tetap izinkan titik
        kode = kode.replace(/[^0-9.]/g, '');

        // console.log("FINAL SCANNER:", kode);

        kirimAbsen(kode);

        buffer = '';

    }, 200); // delay kecil
});


// 🔒 AUTO FOCUS
setInterval(() => input.focus(), 500);

</script>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scanner Absensi</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    margin: 0;
    background: #000;
    overflow: hidden;
}

/* Kamera fullscreen */
#camera {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

/* Overlay bawah */
.overlay {
    position: fixed;
    bottom: 20px;
    width: 100%;
    text-align: center;
    color: white;
    z-index: 3;
    font-size: 16px;
}

/* Flash */
#flash {
    position: fixed;
    inset: 0;
    background: rgba(0,255,0,0.25);
    display: none;
    z-index: 5;
}

/* Nama siswa */
#resultBox {
    position: fixed;
    top: 20px;
    width: 100%;
    text-align: center;
    z-index: 4;
    color: white;
    font-size: 24px;
    font-weight: bold;
}
</style>
</head>

<body>

<!-- Kamera -->
<video id="camera" autoplay playsinline></video>

<!-- Nama siswa -->
<div id="resultBox"></div>

<!-- Info -->
<div class="overlay">Silakan Scan Kartu Absensi</div>

<!-- Flash -->
<div id="flash"></div>

<!-- Input hidden -->
<input type="text" id="scan" autofocus style="position:absolute; left:-9999px;">

<!-- Sound -->
<audio id="beep" src="https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg"></audio>

<script>
const input = document.getElementById('scan');
const flash = document.getElementById('flash');
const resultBox = document.getElementById('resultBox');

let isScanning = true;
let lastKode = null;
let reloadTimer;

// 🔥 AUTO FOCUS (WAJIB)
setInterval(() => input.focus(), 300);

// 🔥 TIMER AUTO RELOAD (IDLE 10 MENIT)
function startReloadTimer() {
    clearTimeout(reloadTimer);
    reloadTimer = setTimeout(() => {
        location.reload();
    }, 10 * 60 * 1000);
}

// start pertama
startReloadTimer();

// 🔥 DETEKSI SCAN SUPER CEPAT
input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {

        let kode = input.value.trim();
        input.value = '';

        if (!kode || !isScanning) return;

        kode = kode.replace(/[^0-9.]/g, '');

        // anti double
        if (kode === lastKode) return;
        lastKode = kode;

        kirimAbsen(kode);
    }
});

// 🔥 FUNCTION ABSEN
function kirimAbsen(kode) {

    isScanning = false;

    fetch(`/scann/barcode/absen/post/${encodeURIComponent(kode)}`)
    .then(res => res.json())
    .then(data => {

        // 🔁 reset timer karena ada aktivitas
        startReloadTimer();

        // 🔊 sound
        document.getElementById('beep').play().catch(()=>{});

        // 🟢 flash
        flash.style.display = 'block';
        setTimeout(() => flash.style.display = 'none', 200);

        // tampilkan nama
        resultBox.innerHTML = data.nama ?? data.message;

        // popup
        Swal.fire({
            icon: data.status ? 'success' : 'error',
            title: data.message,
            timer: 1000,
            showConfirmButton: false
        });

        // reset cepat
        setTimeout(() => {
            isScanning = true;
            lastKode = null;
            resultBox.innerHTML = '';
        }, 800);

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

// 🎥 KAMERA (PREVIEW SAJA)
navigator.mediaDevices.getUserMedia({
    video: { facingMode: "environment" }
})
.then(stream => {
    document.getElementById('camera').srcObject = stream;
})
.catch(err => console.error("Camera error:", err));

// 🔒 FULLSCREEN saat klik pertama
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
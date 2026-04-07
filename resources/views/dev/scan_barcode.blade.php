<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#000000">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Scanner Absensi</title>

    <!-- Library -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            margin: 0;
            background: #000;
            overflow: hidden;
        }

        /* 🔥 Kamera Fullscreen */
        #reader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1;
        }

        video {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }

        /* 🔴 Garis scan */
        .scan-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background: red;
            animation: scan 2s infinite;
            z-index: 3;
        }

        @keyframes scan {
            0% { top: 20%; }
            100% { top: 80%; }
        }

        /* 🟩 Box scanner */
        .scan-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 260px;
            height: 260px;
            transform: translate(-50%, -50%);
            border: 2px solid rgba(255,255,255,0.7);
            border-radius: 12px;
            z-index: 2;
        }

        /* 📝 Text bawah */
        .overlay-text {
            position: fixed;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 14px;
            z-index: 4;
        }

        /* 🟢 Flash sukses */
        .success-flash {
            position: fixed;
            inset: 0;
            background: rgba(0,255,0,0.2);
            z-index: 5;
            display: none;
        }
    </style>
</head>

<body>

    <!-- Kamera -->
    <div id="reader">
        <div class="scan-box"></div>
        <div class="scan-line"></div>
    </div>

    <!-- Overlay -->
    <div class="overlay-text">
        Scan Barcode / QR Siswa
    </div>

    <!-- Flash sukses -->
    <div id="flash" class="success-flash"></div>

    <!-- Input scanner -->
    <input type="text" id="scan" autofocus style="position:absolute; left:-9999px;">

    <!-- Sound -->
    <audio id="beep" src="https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg"></audio>

<script>
let isScanning = true;
let lastResult = null;

const html5QrCode = new Html5Qrcode("reader");


// 🔥 KIRIM ABSEN
function kirimAbsen(rawKode) {

    let kode = String(rawKode).trim();
    kode = kode.replace(/[^0-9.]/g, '');

    if (!kode) return;
    if (!isScanning) return;
    if (kode === lastResult) return;

    isScanning = false;
    lastResult = kode;

    fetch(`/scann/barcode/absen/post/${encodeURIComponent(kode)}`, {
        method: "GET",
        headers: { "Accept": "application/json" }
    })
    .then(res => res.json())
    .then(data => {

        // 🔊 sound
        document.getElementById('beep').play().catch(()=>{});

        // 🟢 flash effect
        const flash = document.getElementById('flash');
        flash.style.display = 'block';
        setTimeout(() => flash.style.display = 'none', 300);

        Swal.fire({
            icon: data.status ? 'success' : 'error',
            title: data.message,
            timer: 1500,
            showConfirmButton: false
        });

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


// 🎥 START CAMERA (TANPA SCAN)
Html5Qrcode.getCameras().then(devices => {
    if (devices.length) {
        html5QrCode.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: { width: 250, height: 250 }
            },
            () => {}, // ❌ disable scan kamera
            () => {}
        );
    }
}).catch(err => console.error("Camera error:", err));


// 🔥 SCANNER ALAT
let buffer = '';
let timeout = null;

const input = document.getElementById('scan');

input.addEventListener('input', function() {

    buffer += this.value;
    this.value = '';

    clearTimeout(timeout);

    timeout = setTimeout(() => {
        let kode = buffer.trim();
        kode = kode.replace(/[^0-9.]/g, '');

        kirimAbsen(kode);

        buffer = '';
    }, 150);
});


// ⚡ DETEKSI ENTER (lebih cepat)
input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        kirimAbsen(buffer);
        buffer = '';
    }
});


// 🔒 AUTO FOCUS
setInterval(() => input.focus(), 500);

</script>
<script>
function masukFullscreen() {
    const el = document.documentElement;

    if (el.requestFullscreen) {
        el.requestFullscreen();
    } else if (el.webkitRequestFullscreen) {
        el.webkitRequestFullscreen();
    } else if (el.msRequestFullscreen) {
        el.msRequestFullscreen();
    }
}

// auto jalan saat klik pertama
document.addEventListener('click', masukFullscreen, { once: true });
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
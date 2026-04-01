<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QR Scanner Absensi</title>

    <!-- Library -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            margin: 0;
            background: #000;
            font-family: sans-serif;
        }

        #reader {
            width: 100%;
            max-width: 500px;
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

        .info {
            color: white;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div id="reader">
    <div class="scan-line"></div>
</div>

<div class="info">Arahkan QR ke kamera...</div>

<!-- SOUND -->
<audio id="beep" src="https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg"></audio>

<script>
   let isScanning = true;
    let lastResult = null;

    const html5QrCode = new Html5Qrcode("reader");

    function onScanSuccess(decodedText) {

        // 🔒 cegah scan berulang
        if (!isScanning) return;

        // 🔒 cegah QR sama kebaca terus
        if (decodedText === lastResult) return;

        lastResult = decodedText;
        isScanning = false;

        console.log("QR:", decodedText);

        fetch(`/scann/barcode/absen/post/${decodedText}`, {
            method: "GET",
            headers: {
                "Accept": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {

            Swal.fire({
                icon: data.status ? 'success' : 'error',
                title: data.message,
                timer: 1500,
                showConfirmButton: false
            });

            // 🔊 suara (optional)
            let beep = new Audio('/beep.mp3');
            beep.play().catch(()=>{});

            // ⏱ reset scan setelah delay
            setTimeout(() => {
                isScanning = true;
                lastResult = null;
            }, 2000);

        })
        .catch(err => {
            console.error(err);

            Swal.fire({
                icon: 'error',
                title: 'Server error',
                text: 'Gagal koneksi ke server',
                timer: 1500,
                showConfirmButton: false
            });

            setTimeout(() => {
                isScanning = true;
            }, 2000);
        });
    }

    function onScanError(errorMessage) {
        // biarin aja (jangan spam console)
    }

    // 🚀 START CAMERA
    Html5Qrcode.getCameras().then(devices => {

        if (devices && devices.length) {

            let cameraId = devices[0].id;

            html5QrCode.start(
                cameraId,
                {
                    fps: 10,
                    qrbox: 250
                },
                onScanSuccess,
                onScanError
            );

        }
    }).catch(err => {
        console.error("Camera error:", err);
    });
</script>

</body>
</html>
{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Scanner</title>

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #000;
            overflow: hidden;
        }

        #reader {
            width: 100vw;
            height: 100vh;
        }

        /* Tombol ganti kamera */
        .camera-switch {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999;
            display: flex;
            gap: 15px;
        }

        .btn-cam {
            background: rgba(0,0,0,0.6);
            padding: 8px 14px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            font-size: 13px;
        }
    </style>
</head>
<body>

<!-- AREA SCANNER -->
<div id="reader"></div>

<!-- BUTTON SWITCH CAMERA -->
<div class="camera-switch">
    <div class="btn-cam" onclick="switchCamera('user')">Kamera Depan</div>
    <div class="btn-cam" onclick="switchCamera('environment')">Kamera Belakang</div>
</div>

<!-- LIBRARY QR -->
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let scanner;
    let currentMode = "environment"; // default kamera belakang

    function startScanner(facing) {
        if (scanner) {
            scanner.stop();
        }

        scanner = new Html5Qrcode("reader");

        let config = {
            fps: 15,
            qrbox: { width: 250, height: 250 }
        };

        Html5Qrcode.getCameras().then(cameras => {
            scanner.start(
                { facingMode: facing },
                config,
                qrCodeMessage => {
                    scanner.stop();
                    window.location.href = `/scann/barcode/absen/post/${qrCodeMessage}`;
                },
                errorMessage => {}
            );
        }).catch(err => {
            Swal.fire("Error", "Kamera tidak ditemukan!", "error");
        });
    }

    function switchCamera(mode) {
        currentMode = mode;
        startScanner(mode);
    }

    // Mulai pertama kali
    startScanner("environment");
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: {!! json_encode(session('success')) !!},
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: {!! json_encode(session('error')) !!},
        showConfirmButton: true
    });
</script>
@endif

</body>
</html> --}}

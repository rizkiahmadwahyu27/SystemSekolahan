<!DOCTYPE html>
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
</html>

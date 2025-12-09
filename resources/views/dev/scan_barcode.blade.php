<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QR Scanner</title>

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            background: #000;
        }

        video {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        /* --- Camera Switch Radio --- */
        .camera-option {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 9999;
        }

        input[type="radio"] { display: none; }

        .option-label {
            background: rgba(0,0,0,0.5);
            padding: 6px 12px;
            border-radius: 10px;
            color: #fff;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .dot {
            width: 14px;
            height: 14px;
            border: 2px solid white;
            border-radius: 50%;
            margin-right: 6px;
            position: relative;
        }

        input[type="radio"]:checked + .dot::after {
            content:"";
            width: 8px;
            height: 8px;
            background:white;
            border-radius:50%;
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
        }
    </style>

</head>
<body>

    <!-- Camera Preview -->
    <video id="preview"></video>

    <!-- Camera Switch -->
    <div class="camera-option">
        <label class="option-label">
            <input type="radio" name="camera" value="0" checked>
            <span class="dot"></span> Front
        </label>

        <label class="option-label">
            <input type="radio" name="camera" value="1">
            <span class="dot"></span> Back
        </label>
    </div>

    <!-- LIBRARIES -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            scanPeriod: 5,
            mirror: false
        });

        // Redirect setelah scan
        scanner.addListener('scan', function (content) {
            window.location.href = `absen/post/${content}`;
        });

        // Load camera
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length < 1) {
                Swal.fire("Error", "Tidak ada kamera ditemukan!", "error");
                return;
            }

            // Default kamera depan (index 0)
            scanner.start(cameras[0]);

            // Switch kamera
            $('input[name="camera"]').on('change', function() {
                let camID = $(this).val();

                if (cameras[camID]) {
                    scanner.start(cameras[camID]);
                } else {
                    Swal.fire("Error", "Kamera tidak tersedia!", "error");
                }
            });

        }).catch(function(e) {
            Swal.fire("Error", e.message, "error");
        });
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: {!! json_encode(session('success')) !!},
                showConfirmButton: false,
                timer: 2500
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: {!! json_encode(session('error')) !!},
            });
        </script>
    @endif

</body>
</html>

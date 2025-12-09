<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QR Scanner</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

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
            background: #000;
        }

        /* Radio custom - container */
        .camera-option {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 9999;
        }

        /* Hide input asli */
        input[type="radio"] {
            display: none;
        }

        /* Kotak custom radio */
        .custom-radio {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #fff;
            display: inline-block;
            position: relative;
            margin-right: 5px;
        }

        /* Titik dalam */
        input[type="radio"]:checked + .custom-radio::after {
            content: "";
            width: 10px;
            height: 10px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .option-label {
            color: #fff;
            font-size: 12px;
            padding: 5px 10px;
            background: rgba(0,0,0,0.5);
            border-radius: 8px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
    </style>

</head>
<body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Instascan -->
    <script src="https://cdn.jsdelivr.net/npm/instascan@1.0.0/instascan.min.js"></script>

    <video id="preview"></video>

    <!-- Radio Camera -->
    <div class="camera-option">
        <label class="option-label">
            <input type="radio" name="camera" value="0" checked>
            <span class="custom-radio"></span> Front
        </label>

        <label class="option-label">
            <input type="radio" name="camera" value="1">
            <span class="custom-radio"></span> Back
        </label>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            scanPeriod: 5,
            mirror: false
        });

        scanner.addListener('scan', function (content) {
            window.location.href = `absen/post/${content}`;
        });

        // Load camera
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length === 0) {
                Swal.fire("Error", "Tidak ada kamera ditemukan", "error");
                return;
            }

            // Start kamera pertama
            scanner.start(cameras[0]);

            // Ganti kamera jika radio diganti
            $('input[name="camera"]').on('change', function() {
                let camIndex = $(this).val();
                if (cameras[camIndex]) {
                    scanner.start(cameras[camIndex]);
                } else {
                    Swal.fire("Error", "Kamera tidak ditemukan!", "error");
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
                timer: 2500,
                showConfirmButton: false
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

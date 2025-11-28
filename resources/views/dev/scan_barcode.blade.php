<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css”> 
    <title>QR Scanner</title>
    <style>
        /* Hide the default radio button */
        input[type="radio"] {
            display: none;
        }

        /* Style the custom radio button */
        .custom-radio {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #999;
            position: relative;
            cursor: pointer;
        }

        /* Style the inner circle (dot) */
        .custom-radio::after {
            content: "";
            display: block;
            width: 12px;
            height: 12px;
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0; /* Initially invisible */
        }

        /* Show the inner circle when the radio button is checked */
        input[type="radio"]:checked + .custom-radio::after {
            opacity: 1;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .video-container {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            background: #000;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover; /* supaya tidak gepeng */
        }
        .video-full {
            width: 100vw !important;
            height: 100vh !important;
            object-fit: cover;
        }

    </style>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 
    <div>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <div style="margin:0;">
            <video id="preview" class="video-full"></video>
        </div>
        <script type="text/javascript">
            var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
            scanner.addListener('scan', function (content) {
                window.location.href = `absen/post/${content}`;
            });
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    $('[name="options"]').on('change', function () {
                        if ($(this).val() == 1) {
                            if (cameras[0] != "") {
                                scanner.start(cameras[0]);
                            } else {
                                alert('No Front camera found!');
                            }
                        } else if ($(this).val() == 2) {
                            if (cameras[1] != "") {
                                scanner.start(cameras[1]);
                            } else {
                                alert('No Back camera found!');
                            }
                        }
                    });
                } else {
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
                alert(e);
            });
        </script>
        <div data-toggle="buttons" style="display: absolute; justify-content: center; margin-top:-40px">
            <div style="display: flex; justify-content: center;">
                <div style="margin-right: 5px; background: #ffff; padding: 5px; border-radius: 10px;">
                    <label style="font-size: 10px">
                        <input type="radio" name="options" class="custom-radio" value="1" autocomplete="off" checked> Front Camera
                    </label>
                </div>
                <div style="margin-left: 5px; background: #ffff; padding: 5px; border-radius: 10px;">
                    <label style="font-size: 10px">
                        <input type="radio" name="options" class="custom-radio" value="2" autocomplete="off"> Back Camera
                    </label>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success', 
                title: 'Berhasil!',
                text: {!! json_encode(session('success')) !!}, // Pastikan menggunakan json_encode untuk amannya
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: {!! json_encode(session('error')) !!},
                showConfirmButton: true,
            });
        </script>
    @endif

</body>
</html>

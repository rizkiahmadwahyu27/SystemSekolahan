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
    </style>
</head>
<body style="background-color: rgb(38, 34, 34)">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <!-- Place your left sidebar ads here -->
            </div>
            <div class="col">
                <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
                <div class="col-sm-12">
                    <video id="preview" class="p-1 border" style="width:100%; height: 80%;"></video>
                </div>
                <script type="text/javascript">
                    var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                    scanner.addListener('scan', function (content) {
                        window.location.href = `scan/absen/post/${content}`;
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
                <div data-toggle="buttons" style="display: flex; justify-content: center;">
                    <div style="margin-top: 10px; margin-right: 10px; background: #ffff; padding: 10px; border-radius: 10px;">
                        <label>
                            <input type="radio" name="options" class="custom-radio" value="1" autocomplete="off" checked> Front Camera
                        </label>
                    </div>
                    <div style="margin-top: 10px; margin-left: 10px; background: #ffff; padding: 10px; border-radius: 10px;">
                        <label>
                            <input type="radio" name="options" class="custom-radio" value="2" autocomplete="off"> Back Camera
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <!-- Place your right sidebar ads here -->
            </div>
        </div>
    </div>
</body>
</html>

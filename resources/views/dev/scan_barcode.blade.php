<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Preview Kamera</title>

<style>
    body {
        margin: 0;
        background: #000;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        background: #000;
    }

    #error {
        color: red;
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 18px;
    }

    #btnFlip {
        position: absolute;
        bottom: 30px;
        right: 30px;
        padding: 12px 20px;
        border: none;
        border-radius: 10px;
        background: rgba(255,255,255,0.8);
        font-size: 16px;
        cursor: pointer;
    }
</style>
</head>
<body>

<div id="error"></div>
<video id="preview" autoplay playsinline></video>

<button id="btnFlip">🔄 Ganti Kamera</button>

<script>
let currentFacingMode = "user"; // default kamera depan
let stream;

// Fungsi mulai kamera
async function startCamera() {
    const video = document.getElementById('preview');
    const errorBox = document.getElementById('error');

    if (stream) {
        // hentikan stream lama
        stream.getTracks().forEach(track => track.stop());
    }

    try {
        stream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: currentFacingMode },
            audio: false
        });

        video.srcObject = stream;

    } catch (error) {
        console.error(error);

        if (error.name === "NotAllowedError") {
            errorBox.innerHTML = "Izin kamera ditolak. Izinkan kamera di browser.";
        } else if (error.name === "NotFoundError") {
            errorBox.innerHTML = "Kamera tidak ditemukan.";
        } else {
            errorBox.innerHTML = "Error kamera: " + error.message;
        }
    }
}

// Tombol flip kamera
document.getElementById("btnFlip").addEventListener("click", () => {
    currentFacingMode = currentFacingMode === "user" ? "environment" : "user";
    startCamera();
});

// Jalankan kamera pertama kali (kamera depan default)
startCamera();
</script>

@if(session('success'))
    <script>
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: {!! json_encode(session('success')) !!}, showConfirmButton: false, timer: 3000 }); 
    </script> 
@endif 
@if(session('error')) 
    <script> 
        Swal.fire({ icon: 'error', title: 'Oops...', text: {!! json_encode(session('error')) !!}, showConfirmButton: true, }); 
    </script> 
@endif

</body>
</html>

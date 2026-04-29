<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aktifkan Notifikasi</title>

    <!-- ✅ Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ✅ Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
</head>

<body class="bg-gradient-to-br from-blue-500 to-indigo-600 min-h-screen p-2 flex justify-center items-center">

<div class="bg-white shadow-xl p-6 w-full rounded-2xl">

    <h2 class="text-4xl font-bold text-center text-gray-800 mb-6">
        🔔 Aktifkan Notifikasi
    </h2>

    <p class="text-center text-gray-500 mb-6 text-3xl">
        Pilih nama siswa untuk menerima notifikasi kehadiran
    </p>

    <div class="mb-24 text-2xl w-full">
        <label class="block font-semibold mb-2 text-gray-700">
            Pilih Siswa
        </label>

        <select id="siswaSearch" class="w-full">
            <option value="">Cari nama siswa...</option>
            @foreach ($data_siswa as $siswa)
                <option value="{{$siswa->nis}}">
                    {{$siswa->nama}} ({{$siswa->nis}})
                </option>
            @endforeach
        </select>
    </div>

    <button onclick="aktifkanNotif()"
        class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg mt-auto">
        Aktifkan Notifikasi
    </button>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new TomSelect("#siswaSearch", {
        create: false,
        sortField: { field: "text", direction: "asc" }
    });
});
</script>
<script>
window.urlBase64ToUint8Array = function(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/');

    const raw = atob(base64);
    return Uint8Array.from([...raw].map(c => c.charCodeAt(0)));
}
</script>
<script>
let swReg = null;

// helper wajib
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/');

    const raw = atob(base64);
    return Uint8Array.from([...raw].map(c => c.charCodeAt(0)));
}

// register service worker
async function initSW() {
    if (!('serviceWorker' in navigator)) {
        alert('Browser tidak support SW');
        return null;
    }

    if (!swReg) {
        swReg = await navigator.serviceWorker.register('/sw.js');
        console.log('SW ready');
    }

    return swReg;
}

// fungsi utama
window.aktifkanNotif = async function () {
    try {
        let nis = document.getElementById('siswaSearch').value;
        if (!nis) return alert("Pilih siswa dulu!");

        if (Notification.permission === 'denied') {
            return alert('Notifikasi diblokir di browser');
        }

        const permission = await Notification.requestPermission();
        if (permission !== "granted") {
            return alert("Izin ditolak");
        }

        const reg = await initSW();
        if (!reg) return;

        const key = "{{ $vapidKey }}";

        let existing = await reg.pushManager.getSubscription();
        if (existing) await existing.unsubscribe();

        const subscription = await reg.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(key)
        });

        await fetch('/save-subscription', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                nis: nis,
                subscription: subscription
            })
        });

        alert("Notifikasi aktif!");
    } catch (err) {
        console.error("ERROR NOTIF:", err);
        alert("Gagal aktifkan notif");
    }
};
</script>
</body>
</html>
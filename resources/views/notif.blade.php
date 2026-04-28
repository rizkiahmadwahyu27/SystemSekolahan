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

<body class="bg-gradient-to-br from-blue-500 to-indigo-600 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md">

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
        🔔 Aktifkan Notifikasi
    </h2>

    <p class="text-center text-gray-500 mb-6 text-sm">
        Pilih nama siswa untuk menerima notifikasi kehadiran
    </p>

    <!-- 🔍 Pilih siswa -->
    <div class="mb-5">
        <label class="block text-sm font-semibold mb-2 text-gray-700">
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

    <!-- 🔔 Button -->
    <button onclick="aktifkanNotif()"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 shadow-md">
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
let swReg = null;

// REGISTER SW DULU
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js')
        .then(reg => {
            swReg = reg;
            console.log('SW ready');
        })
        .catch(err => console.error(err));
}

async function getSW() {
    if (!swReg) {
        swReg = await navigator.serviceWorker.ready;
    }
    return swReg;
}

window.aktifkanNotif = async function () {

    let nis = document.getElementById('siswaSearch').value;
    if (!nis) return alert("Pilih siswa dulu!");

    // CEK PERMISSION DULU
    if (Notification.permission === 'denied') {
        return alert('Notifikasi diblokir, silakan aktifkan di setting browser');
    }

    const permission = await Notification.requestPermission();
    if (permission !== "granted") return alert("Izin ditolak");

    const key = "{{ $vapidKey }}";

    const reg = await getSW();

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
};
</script>
</body>
</html>
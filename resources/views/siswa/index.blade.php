<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SMK Pelita Jatibarang') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow-xl m-4">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Rekapitulasi Absensi Murid</h2>

        {{-- Kontainer Grafik dengan Styling Tailwind CSS --}}
        <div class="relative w-full md:w-1/2 mx-auto" style="height: 400px;">
            <canvas id="absensiChart"></canvas>
        </div>

    </div>
<script>
    // 1. Definisikan Data dari PHP dan parse JSON
    // Catatan: Jika error JSON masih muncul, coba hapus JSON.parse()
    // sehingga: const chartData = {!! $chartData !!}; 
    const chartData = {!! $chartData !!}; 

    // 2. Ambil elemen Canvas
    const ctx = document.getElementById('absensiChart');
    
    // Cek apakah elemen ditemukan untuk menghindari error
    if (ctx) {
        // 3. Inisialisasi Chart DENGAN VARIABEL YANG BENAR (chartData)
        new Chart(ctx, {
            type: 'pie',
            data: {
                // *** PERBAIKAN: GUNAKAN chartData, bukan chartDataStatic ***
                labels: chartData.labels,
                datasets: [{
                    label: 'Jumlah Hari',
                    data: chartData.data, 
                    backgroundColor: chartData.backgroundColor,
                    borderColor: '#ffffff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Distribusi Kehadiran Murid' }
                }
            }
        });
    } else {
        console.error("Elemen canvas dengan ID 'absensiChart' tidak ditemukan.");
    }
</script>
</x-app-layout>
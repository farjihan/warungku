<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <canvas id="chartMingguan"></canvas>
        </div>
    </div>

    @if($barangHabis->count())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-auto text-center max-w-md w-full" role="alert">
            <strong class="font-bold">Peringatan!</strong>
            <span class="block sm:inline">Barang berikut stoknya sudah mendekati habis:</span>
            <ul class="list-disc pl-5 mt-2">
                @foreach($barangHabis as $barang)
                    <li>{{ $barang->nama }} (Stok: {{ $barang->stok }})</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const konteks = document.getElementById('chartMingguan').getContext('2d');
            new Chart(konteks, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Total Penjualan (Rp)',
                        data: @json($data),
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
</x-app-layout>
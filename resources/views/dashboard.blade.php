<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <canvas id="chartMingguan"></canvas>
        </div>
    </div>
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
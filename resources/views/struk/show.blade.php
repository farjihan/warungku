<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">🧾 Struk Transaksi Warung</h2>
    </x-slot>

    <div class="print:block max-w-lg mx-auto p-4 bg-white shadow-md rounded">
        <p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>
        <p><strong>Pembeli:</strong> {{ $transaksi->pembeli ?? '-' }}</p>

        <table class="w-full mt-4 border-collapse border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-2 py-1">Barang</th>
                    <th class="border px-2 py-1">Qty</th>
                    <th class="border px-2 py-1">Harga</th>
                    <th class="border px-2 py-1">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detail as $d)
                    <tr class="text-center">
                        <td class="border px-2 py-1">{{ $d->barang->nama }}</td>
                        <td class="border px-2 py-1">{{ $d->jumlah }}</td>
                        <td class="border px-2 py-1">Rp {{ number_format($d->harga_satuan) }}</td>
                        <td class="border px-2 py-1">Rp {{ number_format($d->jumlah * $d->harga_satuan) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="mt-4 font-bold">Total Bayar: Rp {{ number_format($transaksi->total_harga) }}</p>
        <p class="text-sm mt-2">Terima kasih telah berbelanja 🙏</p>
    </div>

    <div class="print:hidden mt-6 text-center space-x-3">
        <button onclick="kirimWhatsApp()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Kirim ke WhatsApp
        </button>
        <a href="{{ route('transaksi.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            ← Kembali
        </a>
    </div>

    <script>
        function kirimWhatsApp() {
            const nomor = "628123456789"; // Ganti sesuai nomor pembeli
            const pesan = encodeURIComponent(`🧾 *Struk Transaksi Warung*%0A
Tanggal: {{ $transaksi->tanggal }}%0A
Pembeli: {{ $transaksi->pembeli ?? '-' }}%0A
Total: Rp{{ number_format($transaksi->total_harga) }}%0A
Terima kasih 🙏`);

            const waAppURL = `whatsapp://send?phone=${nomor}&text=${pesan}`;
            const waWebURL = `https://wa.me/${nomor}?text=${pesan}`;

            window.location.href = waAppURL;

            setTimeout(() => {
                window.open(waWebURL, '_blank');
            }, 1000);
        }
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">🧾 Struk Transaksi Warung</h2>
    </x-slot>

    <div class="print:block max-w-lg mx-auto p-4 bg-white shadow-md rounded">
        <p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>
        <p><strong>Pembeli:</strong> {{ $transaksi->pembeli ?? '-' }}</p>

        <table class="w-full mt-4 border-collapse border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-2 py-1">Barang</th>
                    <th class="border px-2 py-1">Qty</th>
                    <th class="border px-2 py-1">Harga</th>
                    <th class="border px-2 py-1">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detail as $d)
                    <tr class="text-center">
                        <td class="border px-2 py-1">{{ $d->barang->nama }}</td>
                        <td class="border px-2 py-1">{{ $d->jumlah }}</td>
                        <td class="border px-2 py-1">Rp {{ number_format($d->harga_satuan) }}</td>
                        <td class="border px-2 py-1">Rp {{ number_format($d->jumlah * $d->harga_satuan) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="mt-4 font-bold">Total Bayar: Rp {{ number_format($transaksi->total_harga) }}</p>
        <p class="text-sm mt-2">Terima kasih telah berbelanja 🙏</p>
    </div>

    <div class="print:hidden mt-6 text-center space-x-3">
        <button onclick="kirimWhatsApp()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Kirim ke WhatsApp
        </button>
        <a href="{{ route('transaksi.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            ← Kembali
        </a>
    </div>

    <script>
        function kirimWhatsApp() {
            const nomor = "628123456789"; // Ganti sesuai nomor pembeli
            const pesan = encodeURIComponent(`🧾 *Struk Transaksi Warung*%0A
Tanggal: {{ $transaksi->tanggal }}%0A
Pembeli: {{ $transaksi->pembeli ?? '-' }}%0A
Total: Rp{{ number_format($transaksi->total_harga) }}%0A
Terima kasih 🙏`);

            const waAppURL = `whatsapp://send?phone=${nomor}&text=${pesan}`;
            const waWebURL = `https://wa.me/${nomor}?text=${pesan}`;

            window.location.href = waAppURL;

            setTimeout(() => {
                window.open(waWebURL, '_blank');
            }, 1000);
        }
    </script>
</x-app-layout>

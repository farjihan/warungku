<x-app-layout>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">🧾 Struk Transaksi Warung</h2>
    </x-slot>

    <div class="print:block max-w-lg mx-auto mt-5 p-4 bg-white shadow-md rounded">
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
        <button onclick="printStruk()" class=" bg-gray-400 text-white px-4 py-2 border-none rounded ">Print 🖨️</button>
        <button onclick="bukaOverlayWA()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Kirim ke WhatsApp 📲
        </button>

        <div id="area-prompt" class="p-4"></div>
        <a href="{{ route('transaksi.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            ← Kembali
        </a>
    </div>

    <!-- Overlay WhatsApp -->
    <div id="wa-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Masukkan Nomor WhatsApp</h2>

            <label for="wa-number" class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Nomor (628xx)</label>
            <input type="text" id="wa-number"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Contoh: 6281234567890">

            <div class="flex justify-end mt-4 space-x-2">
                <button onclick="tutupOverlayWA()"
                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                <button onclick="kirimStrukWhatsApp()"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Kirim</button>
            </div>
        </div>
    </div>

    <script>
        function printStruk() {
            window.print();
        }

        window.onafterprint = function () {
            window.location.href = "{{ route('transaksi.index') }}";
        }

        function bukaOverlayWA() {
            document.getElementById('wa-overlay').classList.remove('hidden');
        }

        function tutupOverlayWA() {
            document.getElementById('wa-overlay').classList.add('hidden');
        }


        function kirimStrukWhatsApp() {
            const nomor = document.getElementById("wa-number").value;
            if (!nomor) {
                alert("Masukkan nomor WhatsApp terlebih dahulu.");
                return;
            }

        const pesan = `🧾 *Struk Transaksi Warung* 🧾
📅 *Tanggal:* {{ $transaksi->tanggal }}
👤 *Pembeli:* {{ $transaksi->pembeli ?? '-' }}

🛒 *Rincian Barang:*
@foreach($transaksi->detail as $item)
- {{ $item->barang->nama }} ({{ $item->jumlah }} x Rp{{ number_format($item->harga_satuan) }}) = *Rp{{ number_format($item->subtotal) }}*
@endforeach

💰 *Total:* *Rp{{ number_format($transaksi->total_harga) }}*

🙏 Terima kasih telah berbelanja di warung kami!
        `;

        const encodedPesan = encodeURIComponent(pesan.trim());
        const waURL = `https://api.whatsapp.com/send?phone=${nomor}&text=${encodeURIComponent(pesan)}`;
        window.open(waURL, '_blank');

            tutupOverlayWA();
        }
    </script>




</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Detail Transaksi</h2>
    </x-slot>
    <div class=" max-w-4xl mx-auto mt-6 bg-white shadow p-6 rounded">
        <h3 class="text-lg font-bold mb-4 ">Transaksi Tanggal {{ $transaksi->tanggal }}</h3>
        <p><strong>Pembeli:</strong> {{ $transaksi->pembeli ?? '-' }}</p>
        <p><strong>Total:</strong> {{ number_format($transaksi->total_harga) }}</p>

        <h4 class="mt-6 font-semibold">Barang Terjual:</h4>
        <table class="wfull mt-2 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border">Barang</th>
                    <th class="py-2 px-4 border">Jumlah</th>
                    <th class="py-2 px-4 border">Harga Satuan</th>
                    <th class="py-2 px-4 border">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->detail as $d )
                    <tr>
                        <td class="y-2 px-4 border">{{ $d->barang->nama }}</td>
                        <td class="y-2 px-4 border">{{ $d->jumlah }}</td>
                        <td class="y-2 px-4 border">Rp {{ number_format($d->harga_satuan) }}</td>
                        <td class="y-2 px-4 border">Rp {{ number_format($d->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <a href="{{ route('struk.show', $transaksi->id) }}" class="text-blue-600 ">Buat Struk</a>
        </div>
        <div class="mt-4">
            <a href="{{ route('transaksi.index') }}" class="text-blue-600 ">Kembali ke Daftar</a>
        </div>
    </div>
</x-app-layout>
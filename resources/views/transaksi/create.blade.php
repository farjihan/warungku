<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Transaksi Baru</h2>
    </x-slot>

    <form action="{{ route('transaksi.store') }}" method="POST" class="max-w-xl mx-auto mt-6 space-y-4">
        @csrf

        <div>
            <label for="tanggal" class="block font-medium">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal"
                class="w-full border p-2 rounded"
                value="{{ date('Y-m-d') }}" required>
        </div>

        <div>
            <label for="pembeli" class="block font-medium">Nama Pembeli (opsional)</label>
            <input type="text" name="pembeli" id="pembeli"
                class="w-full border p-2 rounded">
        </div>

        <div id="keranjang">
            <h4 class="font-semibold mb-2">Barang yang Dibeli</h4>
            
            <div class="item mb-4 border p-3 rounded relative">
                <button type="button" onclick="hapusItem(this)"
                    class="absolute top-1 right-1 text-red-600">🗑</button>

                <input type="text" placeholder="Cari barang..." class="search-barang w-full border rounded mb-2 p-1">

                <select name="barang_id[]" onchange="isiHarga(this)"
                    class="w-full border rounded mb-2 barang-dropdown" required>
                    <option value="" data-harga="0">-- Pilih Barang --</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->id }}" data-harga="{{ $b->harga_ecer }}">
                            {{ $b->nama }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>

                <input type="number" name="jumlah[]" placeholder="Jumlah"
                    class="w-full border rounded mb-2" required>

                <input type="number" name="harga_satuan[]" placeholder="Harga Jual"
                    class="w-full border rounded harga-satuan" required>
            </div>
        </div>

        <button type="button" onclick="tambahItem()"
            class="bg-gray-600 text-white px-4 py-1 mt-2 rounded">+ Tambah Barang</button>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Simpan Transaksi</button>
        </div>
    </form>

    @push('scripts')
        @vite('resources/js/transaksi-create.js')
    @endpush
</x-app-layout>
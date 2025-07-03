<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Transaksi</h2>
    </x-slot>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST"
        class="max-w-xl mx-auto mt-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="tanggal" class="block font-medium">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="w-full border p-2 rounded"
                value="{{ old('tanggal', $transaksi->tanggal) }}" required readonly>
        </div>

        <div>
            <label for="pembeli" class="block font-medium">Nama Pembeli</label>
            <input type="text" name="pembeli" id="pembeli" class="w-full border p-2 rounded"
                value="{{ old('pembeli', $transaksi->pembeli) }}" readonly>
        </div>

        <div id="keranjang">
            <h4 class="font-semibold mb-2">Barang yang Dibeli</h4>

            @foreach ($transaksi->detail as $index => $item)
                <div class="item mb-4 border p-3 rounded relative">
                    <button type="button" onclick="hapusItem(this)" class="absolute top-1 right-1 text-red-600">🗑</button>

                    <select name="barang_id[]" class="w-full border rounded mb-2" required>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}" data-harga="{{ $b->harga_ecer }}" @if ($item->barang_id == $b->id)
                            selected @endif>
                                {{ $b->nama }} (Stok: {{ $b->stok }})
                            </option>
                        @endforeach
                    </select>

                    <input type="number" name="jumlah[]" placeholder="Jumlah" class="w-full border rounded mb-2" required
                        value="{{ $item->jumlah }}">

                    <input type="number" name="harga_satuan[]" placeholder="Harga Jual"
                        class="w-full border rounded harga-satuan" required value="{{ $item->harga_satuan }}">
                </div>
            @endforeach
        </div>


        <template id="item-template">
            <div class="item mb-4 border p-3 rounded relative">
                <button type="button" onclick="hapusItem(this)" class="absolute top-1 right-1 text-red-600">🗑</button>
                <input type="text" class="search-barang w-full border mb-2 rounded" placeholder="Cari barang..." />

                <select name="barang_id[]" class="w-full border rounded mb-2" required>
                    @foreach ($barang as $b)
                        <option value="{{ $b->id }}" data-harga="{{ $b->harga_ecer }}">
                            {{ $b->nama }} (Stok: {{ $b->stok }})
                        </option>
                    @endforeach
                </select>
                <input type="number" name="jumlah[]" placeholder="Jumlah" class="w-full border rounded mb-2" required>
                <input type="number" name="harga_satuan[]" placeholder="Harga Jual"
                    class="harga-satuan w-full border rounded" required>

            </div>
        </template>


        <button type="button" onclick="tambahItem()" class="bg-gray-600 text-white px-4 py-1 mt-2 rounded">+ Tambah
            Barang</button>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Simpan Transaksi</button>
        </div>
    </form>

    @push('scripts')
        @vite('resources/js/transaksi-create.js')
    @endpush
</x-app-layout>
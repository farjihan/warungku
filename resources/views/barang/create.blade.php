<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah Barang</h2>
    </x-slot>

  <form action="{{ route('barang.store') }}" method="POST" class="max-w-md mx-auto mt-6 space-y-4">
    @csrf

    <div>
        <label for="nama" class="block font-medium" >Nama Barang</label>
        <input type="text" name="nama" id="nama" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label for="kategori" class="block font-medium">Kategori</label>
        <input type="text" name="kategori" id="kategori" class="w-full border p-2 rounded">
    </div>
      <div>
        <label for="satuan" class="block font-medium">Satuan</label>
        <input type="text" name="satuan" id="satuan" class="w-full border p-2 rounded" value="pcs">
    </div>
    <div>
        <label for="stok" class="block font-medium">Stok</label>
        <input type="number" name="stok" id="stok" class="w-full border p-2 rounded" value="0">
    </div>
    <div>
        <label for="harga_ecer" class="block font-medium">Harga Ecer</label>
        <input type="text" name="harga_ecer" id="harga_ecer" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label for="harga_grosir" class="block font-medium">Harga Grosir</label>
        <input type="text" name="harga_grosir" id="harga_grosir" class="w-full border p-2 rounded">
    </div>
    <div class="flex justify-end space-x-2">
        <a href="{{ 'barang.index' }}" class="text-gray-600">Batal</a>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </div>
  </form>
</x-app-layout>
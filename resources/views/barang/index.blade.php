<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Barang</h2>
    </x-slot>

<div class="container mx-auto p-4">
        <div class="mt-5">
        <a href="{{ route('barang.create') }}" class="bg-green-500 text-white m-2 px-4 py-2 rounded ">Tambah Barang</a>
    </div>

    <table class="w-full mt-4 border">
        <thead class="font-bold bg-gray-200 text-lg">
            <tr>
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga Ecer</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $barang)
                <tr class="text-center border ">
                    <td class="px-3 py-3">{{ $barang->nama }}</td>
                    <td class="px-3 py-3">{{ $barang->stok }}</td>
                    <td class="px-3 py-3">Rp {{ number_format($barang->harga_ecer, 0, ',', ',') }}</td>
                    <td class="px-3 py-3">

                        <a href="{{ route('barang.edit', $barang) }}" class="me-2">✏️</a>
                        <form action="{{ route('barang.destroy', $barang) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onClick="return confirm('Yakin Hapus')">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> 
</div>

</x-app-layout>
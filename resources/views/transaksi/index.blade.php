<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Transaksi</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto mt-6">
        <a href="{{ route('transaksi.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Transaksi
        </a>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 ">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded p-4 overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 px-4">#</th>
                        <th class="text-left py-2 px-4">Tanggal</th>
                        <th class="text-left py-2 px-4">Pembeli</th>
                        <th class="text-left py-2 px-4">Total Harga</th>
                        <th class="text-left py-2 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="text-left py-2 px-4">{{ $loop->iteration }}</td>
                            <td class="text-left py-2 px-4">{{ $transaksi->tanggal }}</td>
                            <td class="text-left py-2 px-4">{{ $transaksi->pembeli ?? '-' }}</td>
                            <td class="text-left py-2 px-4">Rp {{ number_format($transaksi->total_harga) }}</td>
                            <td class="text-left py-2 px-4">
                                <a href="{{ route('transaksi.show', $transaksi) }}" class="text-blue-600">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 ">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
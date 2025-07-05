@extends('layouts.dashboard')

@section('title', 'Manajemen Produk')

@section('content')

    {{-- Tampilkan notifikasi sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white p-8 rounded-xl shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-poppins font-bold text-slate-800">Daftar Produk</h2>
            <a href="{{ route('admin.products.create') }}" class="bg-slate-800 text-white font-poppins text-sm font-semibold py-2.5 px-4 rounded-lg hover:bg-slate-700 transition-colors">
                + Tambah Produk Baru
            </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="border-b-2 border-slate-200 bg-slate-50">
                <tr>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500 uppercase">Nama Produk</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500 uppercase">Kategori</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500 uppercase">Harga</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b border-slate-100">
                        <td class="p-4 font-semibold text-slate-700 flex items-center">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-md mr-4 object-cover">
                            <span class="whitespace-nowrap">{{ $product->name }}</span>
                        </td>
                        <td class="p-4 text-slate-600">{{ $product->category->name ?? 'N/A' }}</td>
                        <td class="p-4 font-semibold text-slate-700">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-4 whitespace-nowrap">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 font-semibold mr-4">Edit</a>

                            {{-- FORM UNTUK MENGHAPUS PRODUK --}}
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-6 text-slate-500">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection
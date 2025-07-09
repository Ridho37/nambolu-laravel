@extends('layouts.dashboard') {{-- Sesuaikan dengan nama file layout admin Anda --}}

@section('content')

    {{-- Notifikasi akan muncul di sini jika ada pesan 'success' dari controller --}}
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Produk</h1>
        <a href="{{ route('create') }}" class="px-4 py-2 bg-slate-800 text-white font-semibold rounded-lg shadow-md hover:bg-slate-700 transition-colors duration-300">
            + Tambah Produk
        </a>
    </div>

    {{-- Tabel untuk menampilkan daftar produk --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3  text-sm font-poppins font-semibold text-slate-500">Gambar</th>
                        <th scope="col" class="px-6 py-3  text-sm font-poppins font-semibold text-slate-500">Nama Produk</th>
                        <th scope="col" class="px-6 py-3  text-sm font-poppins font-semibold text-slate-500">Kategori</th>
                        <th scope="col" class="px-6 py-3  text-sm font-poppins font-semibold text-slate-500">Harga</th>
                        <th scope="col" class="px-6 py-3  text-sm font-poppins font-semibold text-slate-500 text-center">Stok</th>
                        <th scope="col" class="px-6 py-3  text-sm font-poppins font-semibold text-slate-500 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->category->name }}</td>
                            <td class="px-6 py-4">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center"><span class="px-3 py-1 text-s font-semibold rounded-full {{ $product->stock < 10 ?'text-red-800 bg-red-100':'text-green-800 bg-green-100 ' }}">{{ $product->stock }}</span></td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('edit', $product->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                    
                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('destroy', $product->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                Belum ada data produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    {{-- Paginasi --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>

@endsection
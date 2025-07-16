@extends('layouts.dashboard')

@section('content')

    {{-- Notifikasi sukses --}}
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

    {{-- Tabel Produk --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 font-poppins font-semibold text-slate-500">Gambar</th>
                        <th class="px-6 py-3 font-poppins font-semibold text-slate-500">Nama Produk</th>
                        <th class="px-6 py-3 font-poppins font-semibold text-slate-500">Kategori</th>
                        <th class="px-6 py-3 font-poppins font-semibold text-slate-500">Harga</th>
                        <th class="px-6 py-3 font-poppins font-semibold text-slate-500 text-center">Stok</th>
                        <th class="px-6 py-3 font-poppins font-semibold text-slate-500 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="bg-white border-b hover:bg-gray-50">

                            {{-- Gambar --}}
                            <td class="px-6 py-4 font-semibold">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md">
                            </td>

                            {{-- Nama Produk + Label Baru --}}
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                <div class="flex items-center space-x-2">
                                    <span>{{ $product->name }}</span>
                                    @if ($product->created_at >= now()->subDays(5))
                                        <span class="text-xs bg-rose-500 text-white font-semibold px-2 py-0.5 rounded-full">Baru</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Kategori --}}
                            <td class="px-6 py-4">{{ $product->category->name }}</td>

                            {{-- Harga --}}
                            <td class="px-6 py-4">Rp{{ number_format($product->price, 0, ',', '.') }}</td>

                            {{-- Stok + Status --}}
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full
                                    @if ($product->stock < 5)
                                        bg-red-100 text-red-800
                                    @elseif ($product->stock < 10)
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-green-100 text-green-800
                                    @endif">
                                    {{ $product->stock }}
                                </span>
                                @if ($product->stock < 5)
                                    <span class="ml-2 text-xs font-semibold text-red-500">(Stok Menipis)</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('edit', $product->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
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

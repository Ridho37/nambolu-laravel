@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Produk --}}
    <div class="bg-white p-6 rounded-xl shadow-md">
        <p class="text-sm font-medium text-gray-500">Jumlah Produk Aktif</p>
        <p class="text-3xl font-poppins font-bold text-slate-800 mt-1">{{ $totalProducts }}</p>
    </div>

    {{-- Total Kategori --}}
    <div class="bg-white p-6 rounded-xl shadow-md">
        <p class="text-sm font-medium text-gray-500">Kategori Produk</p>
        <p class="text-3xl font-poppins font-bold text-slate-800 mt-1">{{ $totalCategories }}</p>
    </div>

    {{-- Stok Hampir Habis --}}
    <div class="bg-white p-6 rounded-xl shadow-md">
        <p class="text-sm font-medium text-gray-500">Stok Hampir Habis</p>
        <p class="text-3xl font-poppins font-bold text-red-500 mt-1">{{ $lowStockCount }}</p>
    </div>
</div>

{{-- Produk Baru Ditambahkan --}}
<div class="bg-white p-6 rounded-xl shadow-md mb-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-poppins font-bold text-slate-800">Produk Baru Ditambahkan</h3>
        <a href="{{ route('create') }}" class="bg-slate-800 text-white font-poppins text-sm font-semibold py-2 px-4 rounded-lg hover:bg-slate-700 transition-colors">Tambah Produk</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="border-b-2 border-slate-100">
                <tr>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Nama</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Kategori</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Deskripsi</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Harga</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentProducts as $recentProduct)
                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                        <td class="p-4 font-semibold text-slate-700 flex items-center">
                            <img src="{{ asset('storage/'.$recentProduct->image) }}" alt="{{ $recentProduct->name }}" class="w-10 h-10 rounded-md mr-4 object-cover">
                            {{ $recentProduct->name }}
                        </td>
                        <td class="p-4 text-slate-600">
                            {{ $recentProduct->category?->name ?? 'Tidak ada kategori!' }}
                        </td>
                        <td class="p-4 text-slate-600">
                            {{ \Illuminate\Support\Str::limit($recentProduct->description, 50) }}
                        </td>
                        <td class="p-4 font-semibold text-slate-700">
                            Rp{{ number_format($recentProduct->price, 0, ',', '.') }}
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if ($recentProduct->stock < 5)
                                    text-red-800 bg-red-100
                                @elseif ($recentProduct->stock < 10)
                                    text-yellow-800 bg-yellow-100
                                @else
                                    text-green-800 bg-green-100
                                @endif">
                                {{ $recentProduct->stock }} Tersedia
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            Belum ada produk baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@extends('layouts.dashboard')

@section('title', 'Products')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-poppins font-bold text-slate-800">Produk</h3>
        <a href="{{ url('/admin/dashboard/product/create') }}" class="bg-slate-800 text-white font-poppins text-sm font-semibold py-2 px-4 rounded-lg hover:bg-slate-700 transition-colors">Tambah Produk</a>
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
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b border-slate-100">
                        <td class="p-4 font-semibold text-slate-700 flex items-center">
                            <img src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-md mr-4 object-cover">
                            {{ $product->name }}
                        </td>
                        <td class="p-4 text-slate-600">{{ $product->category->name }}</td>
                        <td class="p-4 text-slate-600">{{ $product->description }}</td>
                        <td class="p-4 font-semibold text-slate-700">Rp {{ number_format($product->price, 0, ',', '.') }}, -</td>
                        <td class="p-4"><span class="px-3 py-1 text-xs font-semibold {{ $product->stock < 10 ?'text-red-800 bg-red-100':'text-green-800 bg-green-100 ' }} rounded-full">{{ $product->stock }} Tersedia</span></td>
                        <td class="p-4 text-center">
                            <a href="{{ route('edit', $product->id) }}" class="text-green-600 hover:underline">Edit</a>
                            <form action="{{ route('destroy', $product->id) }}" method="POST" class="inline-block ml-4"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini? Semua isi di dalamnya juga akan terhapus!')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
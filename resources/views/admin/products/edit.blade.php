@extends('layouts.dashboard')

@section('title', 'Edit Produk')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-2xl mx-auto">
    <h2 class="text-2xl font-poppins font-bold text-slate-800 mb-6">Edit Produk: {{ $product->name }}</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form action mengarah ke route update, dengan method PUT/PATCH --}}
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Method spoofing untuk update --}}
        <div class="space-y-4">

            {{-- Helper old() diisi dengan data produk saat ini --}}
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="bg-gray-50 border border-gray-300 text-slate-800 rounded-lg block w-full p-2.5" required>
            </div>

            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700">Kategori</label>
                <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-slate-800 rounded-lg block w-full p-2.5" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" class="bg-gray-50 border border-gray-300 text-slate-800 rounded-lg block w-full p-2.5" required>
            </div>

            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-slate-800 rounded-lg block w-full p-2.5" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Gambar Produk</label>
                <div class="mb-2">
                    <img src="{{ asset('images/' . $product->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded-lg">
                </div>
                <input type="file" id="image" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100">
                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah gambar.</p>
            </div>

            <div class="flex justify-end pt-4">
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Batal</a>
                <button type="submit" class="text-white bg-slate-800 hover:bg-slate-700 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                    Update Produk
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
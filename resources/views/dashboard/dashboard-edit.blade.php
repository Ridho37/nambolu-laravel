@extends('layouts.dashboard')

{{-- TAMBAHKAN BLOK DEBUG INI --}}
@if ($errors->any())
    <div class="bg-red-500 text-white p-4 m-6 rounded-lg">
        <h3 class="font-bold">DEBUG: Ditemukan Error Validasi!</h3>
        <pre>{{ print_r($errors->all()) }}</pre>
    </div>
@endif

{{-- AKHIR BLOK DEBUG --}}
@section('title', 'Tambah Produk Baru')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-xl font-poppins font-bold text-slate-800 mb-6">Edit data</h3>

    {{-- Menampilkan Pesan Error Validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-5" role="alert">
            <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
            <ul class="mt-2 list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form action="{{ route('update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Produk --}}
            <div>
                <label for="name" class="block text-sm font-medium text-slate-600 mb-1">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="w-full placeholder-slate-400 border-slate-300 rounded-lg shadow-sm focus:border-rose-500 focus:ring-rose-500" placeholder="Kue ulang tahun"  required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori Produk (Dropdown Dinamis) --}}
            <div>
                <label for="category_id" class="block text-sm font-medium text-slate-600 mb-1">Kategori</label>
                <select name="category_id" id="category_id" class="w-full border-slate-300 rounded-lg shadow-sm focus:border-rose-500 focus:ring-rose-500" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    {{-- Variabel $categories dikirim dari ProductController@create --}}
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label for="price" class="block text-sm font-medium text-slate-600 mb-1">Harga (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="150000" class="w-full placeholder-slate-400 border-slate-300 rounded-lg shadow-sm focus:border-rose-500 focus:ring-rose-500" required min="0">
                 @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Stok --}}
            <div>
                <label for="stock" class="block text-sm font-medium text-slate-600 mb-1">Stok</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" placeholder="5" class="w-full placeholder-slate-400 border-slate-300 rounded-lg shadow-sm focus:border-rose-500 focus:ring-rose-500" required min="0">
                @error('stock')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-slate-600 mb-1">Deskripsi Produk</label>
            <textarea name="description" id="description" rows="4" placeholder="Kue nya enak sekali" class="w-full placeholder-slate-400 border-slate-300 rounded-lg shadow-sm focus:border-rose-500 focus:ring-rose-500">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Upload Gambar --}}
        <div class="mt-6">
            <label for="image" class="block text-sm font-medium text-slate-600 mb-1">Gambar Produk</label>
            {{-- tampilkan gambar saat ini --}}
            <div class="mt-2 mb-2">
                <span class="block text-xs font-medium text-slate-500">Gambar Saat Ini:</span>
                @if ($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-48 h-16 object-cover rounded-md mt-1 max-h-10">
                @else
                    <p class="text-sm text-slate-400 mt-1">Tidak ada gambar.</p>
                @endif
            </div>
            {{-- input gambar baru --}}
            <input type="file" name="image" id="image" class="w-full placeholder-slate-400 border border-slate-300 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100">
            <p class="text-xs text-slate-500 mt-1">Maksimal 2MB.</p>
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Tombol Aksi --}}
        <div class="mt-8 flex justify-end">
            <a href="{{ route('products') }}" class="bg-slate-200 text-slate-700 font-poppins font-semibold py-2 px-6 rounded-lg hover:bg-slate-300 transition-colors mr-4">
                Batal
            </a> 
            <button type="submit" class="bg-slate-800 text-white font-poppins font-semibold py-2 px-6 rounded-lg hover:bg-slate-700 transition-colors">
                Edit Produk
            </button>
        </div>
    </form>
</div>
@endsection
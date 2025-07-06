@extends('layouts.dashboard')

@section('title', 'Categories')

@section('content')
{{-- form tambah kategori --}}
<div class="bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-xl font-poppins font-bold text-slate-800 mb-6">Tambah Kategori</h3>

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
    
    <form action="{{ route('cstore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> </div> --}}
        {{-- Nama Kategori --}}
        <div class="mt-6">
            <label for="name" class="block text-sm font-medium text-slate-600 mb-1">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full placeholder-slate-400 border-slate-300 rounded-lg shadow-sm focus:border-rose-500 focus:ring-rose-500" placeholder="Bolu"  required>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        {{-- Deskripsi --}}
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-slate-600 mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="4" placeholder="kue kue an" class="w-full placeholder-slate-400 border-slate-300 rounded-lg shadow-sm focus:border-rose-500 focus:ring-rose-500">{{ old('description') }}</textarea>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-slate-800 text-white font-poppins font-semibold py-2 px-6 rounded-lg hover:bg-slate-700 transition-colors">
                Simpan Kategori
            </button>
        </div>
    </form>
</div>

{{-- table kategori --}}
<div class="bg-white p-6 rounded-xl shadow-md mt-6">
    <h3 class="text-xl font-poppins font-bold text-slate-800 mb-6">Data Kategori</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="border-b-2 border-slate-100">
                <tr>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">No.</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Nama</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Deskripsi</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @forelse ($categories as $category)
                    <tr class="border-b border-slate-100">
                        <td class="p-4 text-slate-700 items-center">{{ $no++ }}</td>
                        <td class="p-4 text-slate-700 items-center">{{ $category->name }}</td>
                        <td class="p-4 text-slate-700">{{ ($category->description)==null?'-':$category->description }}</td>
                        <td class="p-4 text-slate-700 text-center">
                            <form action="{{ route('cdestroy', $category->id) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua produk di dalamnya juga akan terhapus!')">
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
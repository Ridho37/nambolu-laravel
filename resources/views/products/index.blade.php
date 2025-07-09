@extends('layouts.app')

@section('title', $title ?? 'Semua Menu Bolu Gulung')

@section('content')
    {{-- Bagian Header Halaman --}}
    <div class="bg-white">
        <div class="my-16">
            <div class="container mx-auto px-5">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-poppins font-bold text-slate-800">{{ $title ?? 'Menu Bolu Gulung' }}</h1>
                    <p class="text-lg md:text-xl text-gray-600 font-lato mt-4 max-w-2xl mx-auto">
                        Temukan semua varian bolu gulung premium dari Nambolu. Dibuat dengan cinta dan bahan-bahan terbaik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian Utama dengan Latar Belakang Abu-abu --}}
    <section class="bg-slate-50 py-16">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ============================================= --}}
            {{-- ==== BAGIAN FILTER KATEGORI (KODE BARU) ==== --}}
            {{-- ============================================= --}}
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-16">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-poppins font-semibold text-slate-800">Telusuri Berdasarkan Kategori</h3>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-3 md:gap-4">
                    {{-- Tombol untuk "Semua" --}}
                    <a href="{{ route('products.index') }}" 
                       class="font-poppins font-medium py-2 px-5 rounded-full transition-all duration-300 border-2 
                              {{ !request('category') ? 'bg-slate-800 text-white border-slate-800' : 'bg-white text-slate-700 border-gray-300 hover:bg-slate-800 hover:text-white hover:border-slate-800' }}">
                        Semua
                    </a>
                    {{-- Loop untuk setiap kategori --}}
                    @isset($categories)
                        @foreach ($categories as $category)
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                               class="font-poppins font-medium py-2 px-5 rounded-full transition-all duration-300 border-2
                                      {{ request('category') == $category->slug ? 'bg-slate-800 text-white border-slate-800' : 'bg-white text-slate-700 border-gray-300 hover:bg-slate-800 hover:text-white hover:border-slate-800' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    @endisset
                </div>
            </div>

            {{-- Grid Produk --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-shadow duration-300 group flex flex-col">
                        <div class="overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" alt="{{ $product->name }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">                        </div>
                        <div class="p-6 flex-grow flex flex-col text-left">
                            <h3 class="text-xl font-poppins font-semibold text-slate-800">{{ $product->name }}</h3>
                            <p class="font-lato text-sm text-gray-500 mt-1 flex-grow">{{ Str::limit($product->description, 100) }}</p>
                            <div class="mt-auto pt-4">
                                <p class="text-lg text-rose-600 font-bold font-poppins mb-3">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="block text-center w-full bg-slate-800 text-white font-poppins py-2.5 px-4 rounded-lg hover:bg-slate-700 transition-colors duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-3 text-center py-16">
                        <p class="text-2xl font-poppins text-gray-500">
                            Oops! Produk tidak ditemukan.
                        </p>
                        <p class="mt-2 text-gray-400">Coba kata kunci atau kategori lain.</p>
                    </div>
                @endforelse
            </div>

            {{-- Paginasi --}}
             @isset($products)
                <div class="mt-16">
                    {{ $products->links() }}
                </div>
            @endisset
        </div>
    </section>
@endsection
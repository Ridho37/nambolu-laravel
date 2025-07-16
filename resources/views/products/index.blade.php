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

            {{-- Filter Kategori --}}
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-10">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-poppins font-semibold text-slate-800">Telusuri Berdasarkan Kategori</h3>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-3 md:gap-4">
                    <a href="{{ route('products.index') }}" 
                       class="font-poppins font-medium py-2 px-5 rounded-full transition-all duration-300 border-2 
                              {{ !request('category') ? 'bg-slate-800 text-white border-slate-800' : 'bg-white text-slate-700 border-gray-300 hover:bg-slate-800 hover:text-white hover:border-slate-800' }}">
                        Semua
                    </a>
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

            {{-- Form Pencarian --}}
            <div class="mb-12 max-w-2xl mx-auto">
                <form action="{{ route('products.index') }}" method="GET" class="flex gap-3">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-slate-500">
                    <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-full hover:bg-slate-700 transition">
                        Cari
                    </button>
                </form>
            </div>

          {{-- Dropdown Urutan Harga --}}
            <div class="mb-8 flex justify-end">
                <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-3">
                    {{-- Simpan query sebelumnya --}}
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <label for="sort" class="text-sm font-medium text-slate-700 font-poppins">
                        Urutkan Harga:
                    </label>
                    <div class="relative">
                        <select name="sort" id="sort" onchange="this.form.submit()"
                                class="block appearance-none w-full bg-white border border-gray-300 text-slate-700 py-2 px-4 pr-10 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-slate-500">
                            <option value="">-- Pilih --</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Termurah</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Termahal</option>
                        </select>
                        {{-- Icon panah --}}
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Grid Produk --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-shadow duration-300 group flex flex-col">
                        <div class="overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6 flex-grow flex flex-col text-left">
                            <h3 class="text-xl font-poppins font-semibold text-slate-800">{{ $product->name }}</h3>

                            {{-- Label Produk Baru --}}
                            @if($product->created_at->gt(now()->subDays(1)))
                                <span class="inline-block mt-2 text-xs font-semibold text-green-600 bg-green-100 px-3 py-1 rounded-full">
                                    Baru!
                                </span>
                            @endif

                            {{-- Label stok hampir habis --}}
                            @isset($product->stock)
                                @if($product->stock > 0 && $product->stock <= 5)
                                    <span class="inline-block mt-2 text-xs font-semibold text-red-600 bg-red-100 px-3 py-1 rounded-full">
                                        Sisa {{ $product->stock }}!
                                    </span>
                                @endif
                            @endisset
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
                    {{ $products->withQueryString()->links() }}
                </div>
            @endisset
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('title', 'Semua Menu Bolu Gulung')

@section('content')
    <div class="bg-white">
        <div class="my-16">
            <div class="container mx-auto px-5">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-poppins font-bold text-slate-800">Menu Bolu Gulung</h1>
                    <p class="text-lg md:text-xl text-gray-600 font-lato mt-4 max-w-2xl mx-auto">
                        Temukan semua varian bolu gulung premium dari Nambolu. Dibuat dengan cinta dan bahan-bahan terbaik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-slate-50 py-16">
        {{-- Bagian filter kategori sudah dihapus --}}

        {{-- Grid Produk --}}
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-shadow duration-300 group flex flex-col">
                        <div class="overflow-hidden">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-6 flex-grow flex flex-col text-left">
                            <h3 class="text-xl font-poppins font-semibold text-slate-800">{{ $product->name }}</h3>
                            <p class="font-lato text-sm text-gray-500 mt-1 flex-grow">{{ $product->description }}</p>
                            <div class="mt-auto pt-4">
                                <p class="text-lg text-rose-600 font-bold font-poppins mb-3">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="block text-center w-full bg-slate-800 text-white font-poppins py-2.5 px-4 rounded-lg hover:bg-slate-700 transition-colors duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-gray-500">
                        Saat ini belum ada produk yang tersedia.
                    </p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
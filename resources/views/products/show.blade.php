@extends('layouts.app')

{{-- Judul halaman akan diisi dengan nama produk --}}
@section('title', $product->name)

@section('content')
    <div class="bg-white py-12 md:py-20">
        <div class="container mx-auto px-6">
            {{-- Link untuk kembali ke halaman semua produk --}}
            <div class="mb-8">
                <a href="{{ route('products.index') }}" class="text-slate-600 hover:text-rose-600 font-semibold">
                    &larr; Kembali ke Semua Menu
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                <div class="w-full">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow-lg object-cover">
                </div>

                <div>
                    <h1 class="text-4xl font-poppins font-bold text-slate-800 mb-4">{{ $product->name }}</h1>
                    <p class="text-2xl text-rose-600 font-poppins font-bold mb-6">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                    <div class="prose max-w-none text-gray-600 font-lato leading-relaxed">
                        <p>{{ $product->description }}</p>
                        {{-- Anda bisa menambahkan deskripsi yang lebih panjang di sini nanti --}}
                    </div>

                    <div class="mt-8">
                        <a href="https://wa.me/62895412174058?text=Halo,%saya%tertarik%membeli%{{ $product->name }}%seharga%Rp{{ number_format($product->price, 0, ',', '.') }}" class="w-full bg-slate-800 text-white font-bold font-poppins py-3 px-6 rounded-lg hover:bg-slate-700 transition-colors duration-300">
                            Tambah ke Keranjang (Fitur Selanjutnya)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
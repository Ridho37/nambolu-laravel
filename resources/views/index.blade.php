@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<section class="relative bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/hero1.png') }}')" id="home">
    <div class="absolute inset-0 bg-black/50 z-10"></div>
    <div class="relative container mx-auto z-20">
        <div class="text-center align-text-top">
            <h1 class="text-5xl lg:text-6xl font-poppins font-bold text-white leading-tight mb-4">
                Freshly Baked, <br>Made with Love.
            </h1>
            <p class="text-xl text-gray-200 font-lato mb-8">
                Nikmati cita rasa bolu gulung terbaik, dibuat dari bahan premium tanpa pengawet.
            </p>
            <a href="#Product" class="bg-rose-800 text-white font-bold font-poppins py-3 px-8 rounded-lg shadow-md hover:bg-rose-600 transition-all duration-300">
                Lihat Produk
            </a>
        </div>
    </div>
</section>

<section id="About" class="py-24 bg-white">
    <div class="container mx-auto px-5">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div>
                <img src="{{ asset('images/about.jpg') }}" class="rounded-lg shadow-lg w-full" alt="Dapur Nambolu">
            </div>
            <div class="leading-relaxed">
                <h2 class="text-4xl font-poppins font-bold text-slate-800 mb-6">About Nambolu</h2>
                <div class="font-lato text-lg text-gray-700 space-y-4">
                    <p>Nambolu adalah toko kue rumahan yang mengkhususkan diri dalam bolu lembut dan nikmat. Kami menggunakan bahan-bahan berkualitas dan resep pilihan untuk menghasilkan rasa yang autentik, tanpa bahan pengawet.</p>
                    <p>Berawal dari dapur kecil, Nambolu tumbuh berkat dukungan pelanggan yang setia. Karena bagi kami, bolu bukan sekadar kue tapi bagian dari cerita manis dalam hidupmu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="Product" class="bg-slate-50 py-24">
    <div class="container mx-auto px-5">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-poppins font-bold text-slate-800">Our Best Sellers</h2>
            <p class="text-lg text-gray-600 font-lato mt-2">Pilihan favorit pelanggan kami.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($products as $product)
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-shadow duration-300 group flex flex-col">
                <div class="overflow-hidden">
                    <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6 flex-grow flex flex-col text-left">
                    <h3 class="text-xl font-poppins font-semibold text-slate-800">{{ $product['name'] }}</h3>
                    <p class="font-lato text-sm text-gray-500 mt-1">{{ $product['description'] }}</p>
                    <div class="mt-auto pt-4">
                        <p class="text-lg text-rose-600 font-bold font-poppins mb-3">Rp{{ number_format($product['price'], 0, ',', '.') }}</p>

                        <a href="{{ url('/products/' . Str::slug($product['name'])) }}" class="block text-center w-full bg-slate-800 text-white font-poppins py-2.5 px-4 rounded-lg hover:bg-slate-700 transition-colors duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-16">
            <a href="{{ url('/products') }}" class="bg-rose-800 text-white font-bold font-poppins py-3 px-8 rounded-lg shadow-md hover:bg-rose-600 transition-all duration-300">Lihat Semua Menu</a>
        </div>
    </div>
</section>

<section id="Contact" class="bg-slate-50 py-20"> <div class="container mx-auto px-5">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-poppins font-bold text-slate-800">Hubungi Kami</h2>
            <p class="text-lg text-gray-600 font-lato mt-2">Punya pertanyaan atau ingin memesan? Kami siap membantu.</p>
        </div>

        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-start">
            
            <form action="kirim-pesan.php" method="POST"> <div class="grid grid-cols-1 gap-6">
                    
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Anda</label>
                        <input type="text" id="nama" name="nama" class="bg-white border border-gray-300 text-slate-800 rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-3 transition-all duration-300" placeholder="Rendy Wijaya" required>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Anda</label>
                        <input type="email" id="email" name="email" class="bg-white border border-gray-300 text-slate-800 rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-3 transition-all duration-300" placeholder="nama@email.com" required>
                    </div>

                    <div>
                        <label for="pesan" class="block mb-2 text-sm font-medium text-gray-900">Pesan Anda</label>
                        <textarea id="pesan" name="pesan" rows="6" class="bg-white border border-gray-300 text-slate-800 rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-3 transition-all duration-300" placeholder="Tuliskan pertanyaan atau pesanan Anda di sini..." required></textarea>
                    </div>

                </div>
                <button type="submit" class="mt-8 w-full text-white bg-rose-800 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 font-bold rounded-lg px-8 py-3 text-center transition-all duration-300 shadow-md hover:shadow-lg">
                    Kirim Pesan
                </button>
            </form>

            <div class="space-y-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-start gap-4">
                        <div class="text-rose-800 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-poppins font-semibold text-slate-800">Alamat Kami</h3>
                            <address class="text-gray-600 not-italic mt-1">
                                Jl. Ring Road Utara, Ngringin, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281
                            </address>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex items-start gap-4">
                        <div class="text-rose-800 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99 0-3.903-.52-5.586-1.456l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.451-4.437-9.887-9.888-9.888-5.452 0-9.888 4.436-9.889 9.888.001 2.228.651 4.315 1.731 6.086l-.476 1.745 1.789-.466z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-poppins font-semibold text-slate-800">WhatsApp</h3>
                            <a href="https://wa.me/62895412174058?text=Halo,%20saya%20tertarik%20dengan%20produk%20Nambolu." target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-rose-800 transition-colors duration-300">+62 895-4121-74058</a>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex items-start gap-4">
                        <div class="text-rose-800 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-poppins font-semibold text-slate-800">Email</h3>
                            <a href="mailto:order@nambolu.com" class="text-gray-600 hover:text-rose-800 transition-colors duration-300">order@nambolu.com</a>
                        </div>
                    </div>
                </div>
                <div class="border border-gray-300 mx-auto rounded-lg overflow-hidden h-72 shadow-sm">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.2818403508622!2d110.4064711753654!3d-7.7599048922591765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a599bd3bdc4ef%3A0x6f1714b0c4544586!2sUniversitas%20Amikom%20Yogyakarta!5e0!3m2!1sid!2sid!4v1750698714081!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
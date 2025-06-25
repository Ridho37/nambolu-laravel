<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nambolu - @yield('title', 'Freshly Baked Goods')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-lato text-gray-800">

    <nav class="bg-white sticky top-0 z-50 shadow-lg">
        <div class="container flex justify-between items-center px-5 py-4 mx-auto">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" class="w-10" alt="Nambolu Logo">
                <h1 class="text-3xl pl-3 my-auto font-poppins font-bold text-slate-800">Nambolu</h1>
            </a>

            <div id="main-nav" class="hidden md:flex space-x-8 text-lg font-poppins text-slate-800">
                <a href="/#home" class="nav-link transition-colors duration-300 ease-in-out hover:text-rose-600" data-target-id="home">Home</a>
                <a href="/#About" class="nav-link transition-colors duration-300 ease-in-out hover:text-rose-600" data-target-id="About">About</a>
                <a href="/#Product" class="nav-link transition-colors duration-300 ease-in-out hover:text-rose-600" data-target-id="Product">Products</a>
                <a href="/#Contact" class="nav-link transition-colors duration-300 ease-in-out hover:text-rose-600" data-target-id="Contact">Contact</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-800 text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid md:grid-cols-3 gap-12 text-center md:text-left">
                <div class="mb-6 md:mb-0">
                    <h2 class="text-2xl font-poppins font-bold text-white">Nambolu</h2>
                    <p class="mt-4 text-gray-400 leading-relaxed">
                        Toko kue rumahan dengan resep otentik yang menyajikan bolu gulung premium, dibuat dari bahan-bahan pilihan tanpa pengawet.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-poppins font-semibold tracking-wider uppercase">Tautan Cepat</h3>
                    <nav class="mt-4 space-y-2">
                        <a href="/#home" class="block text-gray-400 hover:text-white transition-colors duration-300">Home</a>
                        <a href="/#About" class="block text-gray-400 hover:text-white transition-colors duration-300">About</a>
                        <a href="{{ url('/products') }}" class="block text-gray-400 hover:text-white transition-colors duration-300">Semua Menu</a>
                        <a href="/#Contact" class="block text-gray-400 hover:text-white transition-colors duration-300">Hubungi Kami</a>
                    </nav>
                </div>
                <div>
                    <h3 class="text-lg font-poppins font-semibold tracking-wider uppercase">Hubungi Kami</h3>
                    <div class="mt-4 space-y-2 text-gray-400">
                        <p>Condongcatur, Yogyakarta</p>
                        <p>
                            <a href="https://wa.me/62895412174058?text=Halo,%20saya%20tertarik%20dengan%20produk%20Nambolu." target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors duration-300">
                                WhatsApp: +62 895-4121-74058
                            </a>
                        </p>
                        <p>
                            <a href="mailto:order@nambolu.com" class="hover:text-white transition-colors duration-300">
                                Email: order@nambolu.com
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <hr class="my-10 border-slate-700">
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <div class="mb-6 md:mb-0">
                    <p class="text-gray-400">© {{ date('Y') }} Nambolu. All rights reserved.</p>
                </div>
                <div class="flex gap-5">
                    {{-- Ikon Media Sosial --}}
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
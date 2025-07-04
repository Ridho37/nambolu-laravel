<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'di panggang tidak direbus')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-lato" x-data="{ sidebarOpen: false }">

    <div class="flex min-h-screen">
        <aside 
            class="fixed inset-y-0 left-0 z-50 flex-shrink-0 w-64 overflow-y-auto bg-slate-800 text-white transform -translate-x-full lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">
            
            <div class="p-6">
                <a href="{{ url('/') }}" class="flex items-center text-white">
                    <img src="{{ asset('images/logo.png') }}" class="w-10" alt="Nambolu Logo">
                    <h1 class="text-2xl pl-3 my-auto font-poppins font-bold">Nambolu</h1>
                </a>
            </div>

            <nav class="px-4 text-lg space-y-2">
                {{-- 
                    Logika untuk menu aktif:
                    request()->routeIs('admin.dashboard') akan bernilai true jika rute saat ini adalah 'admin.dashboard'.
                    'bg-rose-600 text-white font-semibold' adalah kelas untuk menu aktif.
                    'text-slate-300 hover:bg-slate-700' adalah kelas untuk menu tidak aktif.
                --}}
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-rose-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" viewBox="0 0 24 24" fill="currentColor"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.products.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-rose-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span>Produk</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-rose-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h.01M7 11h.01M16 3a1 1 0 011 1v2.5a1 1 0 01-1 1H8a1 1 0 01-1-1V4a1 1 0 011-1h8zM7 15h.01M7 19h.01M16 15a1 1 0 011 1v2.5a1 1 0 01-1 1H8a1 1 0 01-1-1V16a1 1 0 011-1h8z"></path></svg>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('admin.promotions.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.promotions.*') ? 'bg-rose-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m-5.5.5a.5.5 0 11-1 0 .5.5 0 011 0zM15.5 15.5a.5.5 0 11-1 0 .5.5 0 011 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M14.5 11.9a3 3 0 01-4.2 0L5.5 7.1a3 3 0 010-4.2 3 3 0 014.2 0l4.8 4.8a3 3 0 010 4.2z"></path></svg>
                    <span>Promosi</span>
                </a>
                
                <a href="{{ route('admin.settings.index') }}" 
                class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-rose-600 text-white font-semibold' : 'text-slate-300 hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <div class="absolute bottom-0 w-full px-4 mb-4">
                <form action="{{ route('admin.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-3 mt-2 text-slate-300 hover:bg-slate-700 rounded-lg transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        <span>Logout</span>
                    </button>
                </form>
                 
            </div>
        </aside>


        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                 <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                </button>
                <div class="hidden lg:block text-2xl font-poppins font-bold text-slate-800">Dashboard</div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="flex items-center space-x-2">
                            <img src="https://i.pravatar.cc/40" alt="Avatar" class="w-10 h-10 rounded-full">
                            <div class="hidden md:block text-left">
                                <div class="font-poppins font-semibold text-sm text-slate-700">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-slate-500">Store Manager</div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- main -->
            <main class="flex-1 p-6 lg:p-8">
                @yield('content')
            </main>
            {{-- end main --}}
            
        </div>
    </div>
</body>
</html>
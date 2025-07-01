@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-md">
        <p class="text-sm font-medium text-gray-500">Jumlah Produk Aktif</p>
        <p class="text-3xl font-poppins font-bold text-slate-800 mt-1">{{ $totalProducts }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-md">
        <p class="text-sm font-medium text-gray-500">Kategori Produk</p>
        <p class="text-3xl font-poppins font-bold text-slate-800 mt-1">{{ $totalCategories }}</p>
    </div>
    {{-- <div class="bg-white p-6 rounded-xl shadow-md">
        <p class="text-sm font-medium text-gray-500">Promosi Aktif</p>
        <p class="text-3xl font-poppins font-bold text-slate-800 mt-1">3</p>
    </div> --}}
    <div class="bg-white p-6 rounded-xl shadow-md">
        <p class="text-sm font-medium text-gray-500">Stok Hampir Habis</p>
        <p class="text-3xl font-poppins font-bold text-slate-800 mt-1">5</p>
    </div>
</div>

<div class="bg-white p-6 rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-poppins font-bold text-slate-800">Produk Baru Ditambahkan</h3>
        <a href="dashboard-product.html" class="bg-slate-800 text-white font-poppins text-sm font-semibold py-2 px-4 rounded-lg hover:bg-slate-700 transition-colors">Tambah Produk</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="border-b-2 border-slate-100">
                <tr>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Nama</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Kategori</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Deskripsi</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Harga</th>
                    <th class="p-4 text-sm font-poppins font-semibold text-slate-500">Stok</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-slate-100">
                    <td class="p-4 font-semibold text-slate-700 flex items-center">
                        <img src="{{ asset('images/bolugulung/bolukeju.jpeg') }}" alt="Bolu Pandan" class="w-10 h-10 rounded-md mr-4 object-cover">
                        Bolu Gulung Pandan
                    </td>
                    <td class="p-4 text-slate-600">Bolu Gulung</td>
                    <td class="p-4 font-semibold text-slate-700">Rp 45.000</td>
                    <td class="p-4"><span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">30 Tersedia</span></td>
                </tr>
                <tr class="border-b border-slate-100">
                    <td class="p-4 font-semibold text-slate-700 flex items-center">
                            <img src="{{ asset('images/bolugulung/bolukeju.jpeg') }}" alt="Bolu Keju" class="w-10 h-10 rounded-md mr-4 object-cover">
                        Bolu Gulung Keju
                    </td>
                    <td class="p-4 text-slate-600">Bolu Gulung</td>
                    <td class="p-4 font-semibold text-slate-700">Rp 50.000</td>
                    <td class="p-4"><span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">8 Tersedia</span></td>
                </tr>
                <tr class="border-b border-slate-100">
                    <td class="p-4 font-semibold text-slate-700 flex items-center">
                        <img src="{{ asset('images/bolugulung/bolukeju.jpeg') }}" alt="Bolu Cokelat" class="w-10 h-10 rounded-md mr-4 object-cover">
                        Bolu Gulung Cokelat
                    </td>
                    <td class="p-4 text-slate-600">Bolu Gulung</td>
                    <td class="p-4 font-semibold text-slate-700">Rp 50.000</td>
                    <td class="p-4"><span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">25 Tersedia</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
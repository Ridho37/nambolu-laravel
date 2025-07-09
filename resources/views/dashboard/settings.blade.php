@extends('layouts.dashboard')

@section('title', ' | Pengaturan')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">

        <h1 class="text-3xl font-poppins font-bold text-slate-800 mb-6">Pengaturan Situs</h1>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            <div class="space-y-6">

                {{-- Nama Situs --}}
                <div>
                    <label for="site_name" class="block mb-2 text-sm font-medium text-gray-900">Nama Situs</label>
                    <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5">
                </div>

                {{-- Tagline Situs --}}
                <div>
                    <label for="site_tagline" class="block mb-2 text-sm font-medium text-gray-900">Tagline Situs</label>
                    <input type="text" id="site_tagline" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5">
                </div>

                <hr>

                {{-- Alamat Toko --}}
                <div>
                    <label for="store_address" class="block mb-2 text-sm font-medium text-gray-900">Alamat Toko</label>
                    <textarea id="store_address" name="store_address" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                </div>

                {{-- Telepon Toko --}}
                <div>
                    <label for="store_phone" class="block mb-2 text-sm font-medium text-gray-900">No. Telepon/WhatsApp</label>
                    <input type="text" id="store_phone" name="store_phone" value="{{ old('store_phone', $settings['store_phone'] ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5">
                </div>

                {{-- Email Toko --}}
                <div>
                    <label for="store_email" class="block mb-2 text-sm font-medium text-gray-900">Email Toko</label>
                    <input type="email" id="store_email" name="store_email" value="{{ old('store_email', $settings['store_email'] ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5">
                </div>

            </div>

            <div class="mt-8">
                <button type="submit" class="text-white bg-slate-800 hover:bg-slate-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
@endsection
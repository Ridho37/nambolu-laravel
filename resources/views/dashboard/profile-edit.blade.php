@extends('layouts.dashboard')

@section('title', ' | Edit Profil')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        
        <h1 class="text-3xl font-poppins font-bold text-slate-800 mb-6">Edit Profil</h1>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Nama --}}
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5" required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="my-6">
                
                <p class="text-gray-500 text-sm">Kosongkan bagian password jika Anda tidak ingin mengubahnya.</p>

                {{-- Password Baru --}}
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password Baru</label>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password Baru --}}
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5">
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" class="text-white bg-slate-800 hover:bg-slate-700 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
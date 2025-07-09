@extends('layouts.dashboard')

@section('title', ' | Kotak Masuk')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Kotak Masuk Pesan</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $message->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 font-semibold">{{ $message->name }}</td>
                            <td class="px-6 py-4">{{ $message->email }}</td>
                            <td class="px-6 py-4">{{ Str::limit($message->message, 100) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-500">
                                Belum ada pesan yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@endsection
@extends('layouts.dashboard')

@section('title', 'Aktivitas Admin')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-poppins font-bold text-slate-800 mb-4">Aktivitas Terakhir Admin</h2>
        @if ($logs->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-700">
                    <thead class="border-b bg-gray-50">
                        <tr>
                            <th class="py-3 px-4">Waktu</th>
                            <th class="py-3 px-4">Nama Admin</th>
                            <th class="py-3 px-4">Aksi</th>
                            <th class="py-3 px-4">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr class="border-b hover:bg-gray-50 align-top">
                                <td class="py-2 px-4 whitespace-nowrap">{{ $log->created_at->format('d M Y, H:i') }}</td>
                                <td class="py-2 px-4 whitespace-nowrap">{{ $log->admin_name }}</td>
                                <td class="py-2 px-4 whitespace-nowrap">{{ $log->action }}</td>
                                <td class="py-2 px-4">{!! $log->description !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        @else
            <p class="text-gray-500">Belum ada aktivitas admin tercatat.</p>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <h2>Anda menerima pesan baru dari website Nambolu!</h2>
    <hr>
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Pesan:</strong></p>
    <p>
        {{ $data['message'] }}
    </p>
@endsection
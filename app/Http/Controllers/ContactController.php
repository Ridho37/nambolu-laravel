<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validasi menggunakan 'name', 'email', 'message'
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validatedData);

        // Mengirim notifikasi 'success' kembali ke halaman
        return back()->with('success', 'Pesan Anda telah berhasil terkirim!')->withFragment('Contact');
    }
}
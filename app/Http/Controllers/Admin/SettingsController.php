<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman form pengaturan.
     */
    public function index()
    {
        // Ambil semua setting dari database dan ubah menjadi array asosiatif
        // Hasilnya akan seperti: ['site_name' => 'Nambolu', 'site_address' => '...']
        $settings = Setting::pluck('value', 'key');

        return view('dashboard.settings', compact('settings'));
    }

    /**
     * Mengupdate data pengaturan.
     */
    public function update(Request $request)
    {
        // Validasi input jika diperlukan
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'store_address' => 'nullable|string',
            'store_phone' => 'nullable|string|max:20',
            'store_email' => 'nullable|email|max:255',
        ]);

        // Loop melalui semua data yang divalidasi dan simpan ke database
        foreach ($validated as $key => $value) {
            // updateOrCreate akan membuat setting jika belum ada, atau mengupdatenya jika sudah ada
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
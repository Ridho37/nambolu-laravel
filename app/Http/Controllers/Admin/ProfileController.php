<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil pengguna yang sedang login.
     */
    public function edit()
    {
        // Mengirim data pengguna yang sedang otentikasi ke view
        return view('dashboard.profile-edit', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Mengupdate data profil pengguna.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        // ==========================================================
        // ==== BAGIAN BARU UNTUK ME-REFRESH SESI PENGGUNA ====
        // ==========================================================
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::login($user); // Login kembali dengan data user yang sudah diupdate

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function register(Request $request)
{
    // Validasi inputan
    $validated = $request->validate([
        'name' => 'required',
        'username' => 'required',
        'password' => 'required',
        'role' => 'required',
        'alamat' => '',
        'no_hp' => '',
        'foto' => 'required|image|mimes:png,jpg,jpeg,svg'
    ]);

    $imageName = time() . '.' . $request->foto->extension();
    $request->foto->storeAs('public/photos', $imageName);
    $validated['foto'] = $imageName; // Simpan nama file foto ke dalam array validated
    //dd($imageName);

    // Cek apakah username sudah ada
    if (User::where('username', $validated['username'])->exists()) {
        return redirect()->back()->withErrors(['username' => 'Username telah digunakan! Gunakan username lain!'])->withInput();
    }

    // Enkripsi password
    $validated['password'] = bcrypt($validated['password']);

    // Simpan data user ke database
    User::create($validated);
    return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
}

}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function get()
    {
        try
            {
                $users = User::all();
                return view('user/index', compact('users'));
            }
        catch(Exception $e)
            {
                return view('user/index', compact('users'))->with('errshow', 'Gagal tampil data pengguna');
            }
    }
    // public function insert(Request $request)
    // {
    //     //validasi inputan
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'username' => 'required',
    //         'password' => 'required',
    //         'role' => 'required',
    //         'alamat' => '',
    //         'no_hp' => '',
    //         'foto' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048'
    //     ]);

    //     $imageName = time().'.'.$request->image->extension();

    //     $request->file('foto')->store('foto', 'public');

    //     if (User::where('username', $validated['username'])->exists()) {
    //         // Redirect back with error message
    //         return redirect()->back()->withErrors(['username' => 'Username telah digunakan! Gunakan username lain!'])->withInput();
    //     }

    //     $validated['password'] = bcrypt($validated['password']);
    //     User::create($validated);
    //     return redirect('/pengguna');
    // }

    public function insert(Request $request)
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
    dd($imageName);

    // Cek apakah username sudah ada
    if (User::where('username', $validated['username'])->exists()) {
        return redirect()->back()->withErrors(['username' => 'Username telah digunakan! Gunakan username lain!'])->withInput();
    }

    // Enkripsi password
    $validated['password'] = bcrypt($validated['password']);

    // Simpan data user ke database
    User::create($validated);

    return redirect('/pengguna');
}


    public function delete(User $id)
    {
        $id->delete();
        return redirect('/pengguna');

    }

    public function update(Request $request, User $id)
    {
        // validasi inputan
        $validated = $request->validate([
            'alamat' => '',
            'no_hp' => '',
        ]);

        $id->update($validated);

        return redirect('/profil');
    }


    public function getUser()
    {
        $user = Auth::user();
        return view('auth/profil', compact('user'));

    }

    public function getData()
    {
        $users = User::where('role', 'pb')->get();
        return view('pembina/index', compact('users'));
    }

}

//DB::table('users')->insert(['name'=>'annisa','username'=>'admin','password'=>Hash::make('admin'), 'role'=>'admin'])

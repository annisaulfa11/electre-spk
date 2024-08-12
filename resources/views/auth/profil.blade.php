@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a><span class="text-main font-semibold">My Profile</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bg-white border rounded-md mx-3 my-3 py-7 px-4 gap-y-3">
        <div class="flex flex-row justify-center items-center mb-7">
            <img src="{{ asset('storage/photos/' . $user->foto) }}" alt="Foto {{ $user->name }}" class="flex justify-center w-20 h-20 rounded-full text-center">
        </div>
        <div class="flex flex-row items-center mb-7">
            <label class="mb-1 text-main text-sm font-semibold w-1/5">Nama Pengguna</label>
            <input type="text" class="ml-8 w-full h-9 text-gray-500 border rounded-sm bg-slate-200 border-slate-400 focus:outline-none focus:ring-0 focus:border-main capitalize" readonly value="{{$user->name}}">
        </div>
        <div class="flex flex-row items-center mb-7">
            <label class="mb-1 text-main text-sm font-semibold w-1/5">Username</label>
            <input type="text" class="ml-8 w-full h-9 text-gray-500 border rounded-sm bg-slate-200 border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly value="{{$user->username}}">
        </div>
        <div class="flex flex-row items-center mb-7">
            <label  class="mb-1 text-main text-sm font-semibold w-1/5">Role</label>
            <input type="text" class="ml-8 w-full h-9 text-gray-500 border rounded-sm bg-slate-200 border-slate-400 focus:outline-none focus:ring-0 focus:border-main capitalize" readonly value="{{$user->role}}">
        </div>
        <form action="/profil/{{$user->id}}" method="POST">
            @csrf
            @method('put')
            <div class="flex flex-row items-center mb-7">
                <label for="alamat" class="mb-1 text-main text-sm font-semibold w-1/5">Alamat</label>
                <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat" class="ml-8 w-full h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main capitalize"  value="{{ $user->alamat}}">
            </div>
            <div class="flex flex-row items-center mb-7">
                <label for="no_hp" class="mb-1 text-main text-sm font-semibold w-1/5">No. HP</label>
                <input type="text" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP" class="ml-8 w-full h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main capitalize"  value="{{ $user->no_hp}}">
            </div>
            <div class="flex justify-center">
                <button type="submit" class="text-white bg-main px-10 py-2 rounded-md hover:bg-emerald-800">Simpan</button>
            </div>
        </form>

    </div>
</div>

@endsection

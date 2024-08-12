@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/pengguna"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Pengguna</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Tambah Pengguna</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bg-white border rounded-md mx-3 my-3 py-3 px-4">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-3 rounded relative" role="alert">
                @foreach ($errors->all() as $error)
                    <strong class="font-bold">{{ $error }}</strong>
                @endforeach
            </div>
        @endif
        <form action="/pengguna/tambah" method="POST" class="flex flex-col gap-y-7">
            @csrf
            <div class="flex flex-col ">
                <label for="name" class="mb-1 text-main text-xs font-semibold">NAMA LENGKAP<span class="text-red-700">*</span></label>
                <input type="text" name="name" id="name" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
            </div>
            <div class="flex flex-col ">
                <label for="username" class="mb-1 text-main text-xs font-semibold">USERNAME<span class=" text-red-700">*</span></label>
                <input type="text" name="username" id="username" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('username')}}">
            </div>
            <div class="flex flex-col ">
                <label for="password" class="mb-1 text-main text-xs font-semibold">PASSWORD<span class="text-red-700">*</span></label>
                <input type="password" name="password" id="password" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('password')}}">
            </div>
            <div class="flex flex-col ">
                <label for="role" class="mb-1 text-main text-xs font-semibold">ROLE<span class="text-red-700">*</span></label>
                <select name="role" required id="role" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                    <option value="">Pilih role</option>
                    <option value="admin" class="">Admin</option>
                    <option value="pb">Pembina Wilayah</option>
                    <option value="ortu">Orang Tua</option>
                </select>
            </div>
            <div class="flex flex-col ">
                <label for="alamat" class="mb-1 text-main text-xs font-semibold">ALAMAT</label>
                <input type="text" name="alamat" id="alamat" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" value="{{ old('alamat')}}">
            </div>
            <div class="flex flex-col ">
                <label for="no_hp" class="mb-1 text-main text-xs font-semibold">NO HP</label>
                <input type="text" name="no_hp" id="no_hp" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" value="{{ old('no_hp')}}">
            </div>
            <div>
                <button type="submit" class="text-white bg-main px-10 py-2 rounded-md hover:bg-emerald-800">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

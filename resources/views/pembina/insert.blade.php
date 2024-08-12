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
        <form action="/pengguna/tambah" method="POST" class="flex flex-col gap-y-7">
            @csrf
            <div class="flex flex-col ">
                <label for="name" class="mb-1 text-main text-xs font-semibold">NAMA LENGKAP</label>
                <input type="text" name="name" id="name" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
            </div>
            <div class="flex flex-col ">
                <label for="username" class="mb-1 text-main text-xs font-semibold">USERNAME</label>
                <input type="text" name="username" id="username" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
            </div>
            <div class="flex flex-col ">
                <label for="password" class="mb-1 text-main text-xs font-semibold">PASSWORD</label>
                <input type="password" name="password" id="password" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
            </div>
            <div class="flex flex-col ">
                <label for="role" class="mb-1 text-main text-xs font-semibold">ROLE</label>
                <select name="role" required id="role" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                    <option value="">Pilih role</option>
                    <option value="admin" class="">Admin</option>
                    <option value="pb">Pembina Wilayah</option>
                    <option value="ortu">Orang Tua</option>
                </select>
            </div>
            <div>
                <button type="submit" class="text-white bg-main px-10 py-2 rounded-md hover:bg-emerald-800">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

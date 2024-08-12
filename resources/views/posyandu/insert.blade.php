@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/posyandu"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Posyandu</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Tambah Posyandu</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bg-white border rounded-md mx-3 my-3 py-3 px-4">
        <form action="/posyandu/tambah" method="POST" class="flex flex-col gap-y-7">
            @csrf
            <div class="flex flex-col ">
                <label for="nama_posyandu" class="mb-1 text-main text-xs font-semibold">NAMA POSYANDU</label>
                <input type="text" name="nama_posyandu" id="nama_posyandu" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
            </div>
            <div class="flex flex-col ">
                <label for="alamat" class="mb-1 text-main text-xs font-semibold">ALAMAT</label>
                <input type="text" name="alamat" id="alamat" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
            </div>
            <div class="flex flex-col select">
                <label for="kelurahan" class="mb-1 text-main text-xs font-semibold">KELURAHAN</label>
                <select data-te-select-init name="kelurahan" id="kelurahan" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                    <option value="-">Pilih kelurahan</option>
                    <option value="Pisang">Pisang</option>
                    <option value="Binuang Kampung Dalam">Binuang Kampung Dalam</option>
                    <option value="Piai Tangah">Piai Tangah</option>
                    <option value="Cupak Tangah">Cupak Tangah</option>
                    <option value="Kapalo Koto">Kapalo Koto</option>
                    <option value="Koto Lua">Koto Lua</option>
                    <option value="Lambung Bukit">Lambung Bukit</option>
                    <option value="Limau Manis">Limau Manis</option>
                </select>
            </div>
            <div>
                <button type="submit" class="text-white bg-main px-10 py-2 rounded-md hover:bg-emerald-800">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

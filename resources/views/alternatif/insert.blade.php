@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/alternatif"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Alternatif</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Tambah Alternatif</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bg-white border rounded-md mx-3 my-3 py-3 px-4">
        <form action="/alternatif/tambah" method="POST" class="flex flex-col gap-y-7">
            @csrf
            <div class="flex flex-col ">
                <label for="nama" class="mb-1 text-main text-xs font-semibold">NAMA</label>
                <input type="text" name="nama" id="nama" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
            </div>
            <div class="flex flex-col ">
                <label for="umur" class="mb-1 text-main text-xs font-semibold">UMUR</label>
                <input type="number" name="umur" id="umur" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ old('name')}}">
            </div>
            @can('admin')
            <div class="flex flex-col select">
                <label for="id_ortu" class="mb-1 text-main text-xs font-semibold">ORANG TUA</label>
                <select data-te-select-init data-te-select-filter="true" name="id_ortu" id="id_ortu" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                    <option value="-">Pilih orang tua</option>
                    @foreach ($orangtua as $ortu)
                    <option value="{{ $ortu->id }}">{{$ortu->id}}-{{$ortu->name}}</option>
                    @endforeach
                </select>
            </div>
            @endcan
            @can('pb')
            <div class="flex flex-col select">
                <label for="id_ortu" class="mb-1 text-main text-xs font-semibold">ORANG TUA</label>
                <select data-te-select-init data-te-select-filter="true" name="id_ortu" id="id_ortu" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                    <option value="-">Pilih orang tua</option>
                    @foreach ($orangtua as $ortu)
                    <option value="{{ $ortu->id }}">{{$ortu->id}}-{{$ortu->name}}</option>
                    @endforeach
                </select>
            </div>
            @endcan
            @can('ortu')
            <div class="hidden">
                <input type="hidden" name="id_ortu" id="id_ortu" class="hidden" required value="{{ $orangtua->id}}">
            </div>
            @endcan

            <div class="flex flex-col select ">
                <label for="id_posyandu" class="mb-1 text-main text-xs font-semibold">POSYANDU</label>
                <select data-te-select-init name="id_posyandu" id="id_posyandu" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                    <option value="-">Pilih posyandu</option>
                    @foreach ($posyandus as $posyandu)
                    <option value="{{ $posyandu->id }}">{{$posyandu->nama_posyandu}} - {{$posyandu->kelurahan}} </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="text-white bg-main px-10 py-2 rounded-md hover:bg-emerald-800">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

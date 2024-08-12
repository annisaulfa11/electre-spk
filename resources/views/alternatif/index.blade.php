@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56 flex flex-col">
    <div class="h-12 flex flex-col bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between">
            <ul>
                <li>
                    @can('admin')
                    <a href="/alternatif"><span class="text-main font-semibold">Data Alternatif</span></a>
                    @endcan
                    @can('pb')
                    <a href="/alternatif"><span class="text-main font-semibold">Data Alternatif</span></a>
                    @endcan
                    @can('ortu')
                    <a href="/anak"><span class="text-main font-semibold">Data Anak</span></a>
                    @endcan
                </li>
            </ul>
            @can('admin')
            <ul>
                <li>
                    <a href="/alternatif/tambah" class="bg-main px-5 py-2 rounded-md hover:bg-emerald-800"><span class="text-white">Tambah</span></a>
                </li>
            </ul>
            @endcan
            @can('ortu')
            <ul>
                <li>
                    <a href="/alternatif/tambah" class="bg-main px-5 py-2 rounded-md hover:bg-emerald-800"><span class="text-white">Tambah</span></a>
                </li>
            </ul>
            @endcan

        </nav>
    </div>
    <div class="flex h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Nama</th>
                    <th class="py-3.5 pl-4 text-center text-sm break-normal font-semibold text-slate-900 sm:pl-6">Umur<br>(bulan)</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Nama Ortu</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">No. HP</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Alamat</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Posyandu</th>
                    @can('admin')
                    <th class="py-3.5 pl-4 pr-4 text-center text-sm break-normal font-semibold text-slate-900 sm:pl-6">Opsi</th>
                    @endcan
                    @can('ortu')
                    <th class="py-3.5 pl-4 pr-4 text-center text-sm break-normal font-semibold text-slate-900 sm:pl-6">Opsi</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($alternatifs as $alternatif)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$alternatif->nama}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-wrap text-center text-sm break-normal text-slate-900 sm:pl-6">{{$alternatif->umur}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$alternatif->user->name}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$alternatif->user->no_hp}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$alternatif->user->alamat}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$alternatif->posyandu->nama_posyandu}}</td>
                    @can('admin')
                    <td class="py-3.5 pl-4 pr-3 text-center text-lg  text-slate-900 sm:pl-6">
                        <a href="/alternatif/{{$alternatif->id}}/update"><i class='bx bx-edit text-yellow-300'></i></a>
                        <a onclick="return confirm ('Yakin menghapus alternatif ini?')" href="/alternatif/{{$alternatif->id}}"><i class='bx bx-trash text-green-500'></i></a>
                    </td>
                    @endcan
                    @can('ortu')
                    <td class="py-3.5 pl-4 pr-3 text-center text-lg  text-slate-900 sm:pl-6">
                        <a href="/alternatif/{{$alternatif->id}}/update"><i class='bx bx-edit text-yellow-300'></i></a>
                        <a onclick="return confirm ('Yakin menghapus alternatif ini?')" href="/alternatif/{{$alternatif->id}}"><i class='bx bx-trash text-green-500'></i></a>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection


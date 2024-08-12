@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex w-full justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/pembina-wilayah"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Pembina Wilayah</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Posyandu</span></a>
                </li>
            </ul>
            <ul>
                <li>
                    <a id="open-modal" class="bg-main px-5 py-2 rounded-md hover:bg-emerald-800 text-white">Tambah</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="flex h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">Posyandu</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">Kelurahan</th>
                    <th class="py-3.5 pl-4 pr-4 text-center text-sm font-semibold break-normal text-slate-900 sm:pl-6">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($datas as $data)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$data->posyandu->nama_posyandu}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$data->posyandu->kelurahan}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-center text-lg  text-slate-900 sm:pl-6">
                        <a onclick="return confirm ('Yakin menghapus posyandu dari pembina wilayah ini?')" href="/pembina-wilayah/{{$id_user}}/posyandu/{{$data->id}}"><i class='bx bx-trash text-green-500'></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
<div id="info-popup" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
        <form action="/pembina-wilayah/{{$id_user}}/posyandu/tambah" method="POST">
            @csrf
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
                <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">
                    <h3 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Tambah Posyandu</h3>
                    <div class="flex flex-col">
                        <label for="id_posyandu" class="mb-1 hidden text-main text-xs font-semibold">POSYANDU</label>
                        <select data-te-select-init data-te-select-filter="true" name="id_posyandu" id="id_posyandu" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value="-">Pilih posyandu</option>
                            @foreach ($posyandus as $posyandu)
                            <option value="{{ $posyandu->id }}">{{$posyandu->nama_posyandu}} - {{$posyandu->kelurahan}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="hidden">
                        <label for="id_user" class="mb-1 text-main text-xs font-semibold"></label>
                        <input type="integer" name="id_user" id="id_user" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{ $id_user}}">
                    </div>
                </div>
                <div class="justify-center items-center pt-0 space-y-4 sm:flex sm:space-y-0 mt-6">
                    <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                        <button id="close-modal" type="button"  class="py-2 px-6 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300">Batal</button>
                        <button id="confirm-button" type="submit" class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-main sm:w-auto hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-primary-300">Simpan</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection



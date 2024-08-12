@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56 flex flex-col">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/kriteria"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Kriteria</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Subkriteria</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="flex h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Keterangan</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Bobot</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($subkriterias as $subkriteria)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$subkriteria->keterangan}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-wrap text-left text-sm  text-slate-900 sm:pl-6">{{$subkriteria->bobot}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection


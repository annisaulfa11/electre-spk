@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56 flex flex-col">
    <div class="h-12 flex  bg-white border rounded-md mx-3 my-3 border-slate-200 px-4  drop-shadow-sm">
        <nav class="flex flex-row w-full justify-between items-center">
            <ul class="flex">
                <li>
                    <a href="/hasil"><span class="text-main font-semibold">Data Rekap</span></a>
                </li>
            </ul>
            <ul>
        </nav>
    </div>
    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Created_at</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $d)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$d->created_at}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-lg  text-slate-900 sm:pl-6">
                        <a href="/rekap/{{$d->id}}"><i class='bx bx-printer text-yellow-300'></i></a>
                        @can('admin')
                        <a onclick="return confirm ('Yakin menghapus rekap ini?')" href="/rekap/{{$d->id}}/hapus"><i class='bx bx-trash text-green-500'></i></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection


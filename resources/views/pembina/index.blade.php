@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex flex-col bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between">
            <ul>
                <li>
                    <a href="/pengguna"><span class="text-main font-semibold">Data Pembina Wilayah</span></a>
                </li>
            </ul>

        </nav>
    </div>
    <div class="flex h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">Nama Lengkap</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">Username</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">Posyandu</th>
                    <th class="py-3.5 pl-4 pr-4 text-center text-sm font-semibold break-normal text-slate-900 sm:pl-6">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($users as $user)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$user->name}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-wrap text-left break-normal text-sm  text-slate-900 sm:pl-6">{{$user->username}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">@foreach ($user->pembina as $pos){{$pos->posyandu->nama_posyandu}}, @endforeach</td>
                    <td class="py-3.5 pl-4 pr-3 text-center text-lg  text-slate-900 sm:pl-6">
                        <a href="/pembina-wilayah/{{$user->id}}/posyandu"><i class='bx bx-detail text-green-500'></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection



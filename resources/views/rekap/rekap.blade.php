@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56 flex flex-col">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex w-full justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/rekap"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Rekap</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Rekap Perhitungan</span></a>
                </li>
            </ul>
            <ul>
                <li>
                    <button onclick="printContent()" class="bg-main px-5 h-8.5 rounded-md hover:bg-emerald-800"><span class="text-white">Cetak</span></button>
                </li>
            </ul>
        </nav>
    </div>
    <div id="printContent" class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Nama</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Posyandu</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Orang tua</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No. HP</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Alamat</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">Ranking</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Status</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $ranking = 1;
                @endphp
                @foreach ($data as $d)
                    @php
                        $keterangan = json_decode($d->keterangan, true);
                    @endphp
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$keterangan['nama']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$keterangan['posyandu']['nama_posyandu']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$keterangan['user']['name']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$keterangan['user']['no_hp']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$keterangan['user']['alamat']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ $ranking++ }}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">@if ($keterangan['status'] == 1)
                        Menerima
                    @else
                        Tidak menerima
                    @endif</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
    <script>
        function printContent() {
            var content = document.getElementById("printContent").innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>

@endsection


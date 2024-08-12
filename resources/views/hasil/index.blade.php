@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56 flex flex-col">
    <div class="h-12 flex  bg-white border rounded-md mx-3 my-3 border-slate-200 px-4  drop-shadow-sm">
        <nav class="flex flex-row w-full justify-between items-center">
            <ul class="flex items-center">
                <li class="flex items-center">
                    <a><span class="text-main font-semibold">Hasil Perhitungan</span></a>
                    @can('admin')
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a href="/hasil/proses"><span class="text-gray-500 hover:text-main hover:font-semibold">Proses Perhitungan</span></a>
                    @endcan
                </li>
            </ul>
            @can('admin')
            <ul class="flex items-center">
                <li>
                    <form action="/hasil/simpan" method="POST" class="flex items-center">
                        @csrf
                        <input type="hidden" name="array" value="{{ json_encode($ket) }}">
                        <button type="submit" class="text-white bg-main px-5 h-8.5 rounded-md hover:bg-emerald-800">Simpan ke rekap</button>
                    </form>
                </li>
            </ul>
            @endcan
            @can('pb')
            <ul>
                <li>
                    <button onclick="printContent()" class="bg-main px-5 h-8.5 rounded-md hover:bg-emerald-800"><span class="text-white">Cetak</span></button>
                </li>
            </ul>
            @endcan
        </nav>
    </div>
    <div id="printContent" class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    @can('admin')
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Rank</th>
                    @endcan
                    @can('pb')
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                    @endcan
                    @can('ortu')
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                    @endcan
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Nama</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Posyandu</th>
                    @can('pb')
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Orang tua</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">No. HP</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Alamat</th>
                    @endcan
                    @can('admin')
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Orang tua</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">No. HP</th>
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Alamat</th>
                    @endcan
                    <th class="py-3.5 pl-4 text-left text-sm break-normal font-semibold text-slate-900 sm:pl-6">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $ranking = 1;
                @endphp
                @foreach ($rank as $r)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$r['anak']['nama']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$r['anak']['posyandu']['nama_posyandu']}}</td>
                    @can('pb')
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$r['anak']['user']['name']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$r['anak']['user']['no_hp']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$r['anak']['user']['alamat']}}</td>
                    @endcan
                    @can('admin')
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$r['anak']['user']['name']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$r['anak']['user']['no_hp']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$r['anak']['user']['alamat']}}</td>
                    @endcan
                    <td class="py-3.5 pl-4 pr-3 text-left text-lg text-slate-900 sm:pl-6">
                        @can('admin')
                        <form action="/hasil" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="hasil" class="hidden" value="{{ json_encode($r)}}">
                            <input type="hidden" name="status" value="0"> <!-- Default status value -->
                            <input name="status" type="checkbox" onchange="this.form.submit()" id="status" value="1" {{ $r->status == 1 ? 'checked' : '' }}>
                            <label for="status" class="text-left text-sm text-slate-900">Menerima</label>
                        </form>
                        @endcan
                        <label for="status" class="text-left text-sm text-slate-900">
                        @can('pb')

                        @if ($r->status == 1)
                            Menerima
                        @else
                            Tidak menerima
                        @endif
                        @endcan

                        @can('ortu')
                        @if ($r->status == 1)
                            Menerima
                        @else
                            Tidak menerima
                        @endif
                        @endcan
                        </label>
                    </td>
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



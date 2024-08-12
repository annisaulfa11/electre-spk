@extends('layouts.navbar')
@section('container')


<div class="sm:ml-56 flex flex-col">
    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif
    <div class="h-12 flex flex-col bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between">
            <ul>
                @can('admin')
                <li>
                    <a href="/penilaian"><span class="text-main font-semibold">Data Penilaian</span></a>
                </li>
                @endcan
                @can('pb')
                <li>
                    <a href="/penilaian"><span class="text-main font-semibold">Data Penilaian</span></a>
                </li>
                @endcan
                @can('ortu')
                <li>
                    <a href="/data"><span class="text-main font-semibold">Data Penilaian</span></a>
                </li>
                @endcan
            </ul>
            @can('admin')
            <ul>
                <li>
                    <a href="/penilaian/tambah" class="bg-main px-5 py-2 rounded-md hover:bg-emerald-800"><span class="text-white">Tambah</span></a>
                </li>
            </ul>
            @endcan
            @can('pb')
            <ul>
                <li>
                    <a href="/penilaian/tambah" class="bg-main px-5 py-2 rounded-md hover:bg-emerald-800"><span class="text-white">Tambah</span></a>
                </li>
            </ul>
            @endcan
        </nav>
    </div>

    <div class="flex flex-col h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm w-auto overflow-x-scroll">
        <div class="flex items-center justify-between mb-3">
            <select data-te-select-init id="filter" class="bg-white border rounded-md px-4 py-2">
                <option value="all">Semua</option>
                <option value="true">Lengkap</option>
                <option value="false">Tidak Lengkap</option>
            </select>
        </div>
        <table class="w-auto overflow-x-scroll">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left break-normal text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold break-normal text-slate-900 sm:pl-6">Nama</th>
                    @foreach($kriterias as $kriteria)
                    <th class="py-3.5 pl-4 text-left break-normal capitalize text-sm font-semibold text-slate-900 sm:pl-6">{{ $kriteria->kriteria }}</th>
                    @endforeach
                    <th class="py-3.5 pl-4 pr-4 text-center break-normal text-sm font-semibold text-slate-900 sm:pl-6">Opsi</th>
                </tr>
            </thead>
            <tbody id="penilaian-table">
                @php
                    $no = 1;
                @endphp
                @foreach($penilaians as $id_alternatif => $data)
                <tr class="{{ $data['is_complete'] ? 'true' : 'false' }}">
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm break-normal text-slate-900 sm:pl-6">{{$data['nama']}}</td>
                    @foreach($kriterias as $kriteria)
                        @php
                            $subkriteria = array_shift($data['subkriteria']);
                        @endphp
                        <td class="py-3.5 pl-4 pr-3 text-left text-sm text-slate-900 sm:pl-6">{{ $subkriteria }}</td>
                    @endforeach
                    <td class="py-3.5 pl-4 pr-3 text-center text-lg  text-slate-900 sm:pl-6 justify-end">
                        @can('admin')
                        <a href="/penilaian/{{$data['id_anak']}}/update"><i class='bx bx-edit text-yellow-300'></i></a>
                        <a onclick="return confirm ('Yakin menghapus penilaian ini?')" href="/penilaian/{{$data['id_anak']}}"><i class='bx bx-trash text-green-500'></i></a>
                        @endcan
                        @can('pb')
                        <a href="/penilaian/{{$data['id_anak']}}/update"><i class='bx bx-edit text-yellow-300'></i></a>
                        <a onclick="return confirm ('Yakin menghapus penilaian ini?')" href="/penilaian/{{$data['id_anak']}}"><i class='bx bx-trash text-green-500'></i></a>
                        @endcan
                        @can("ortu")
                        <a href="/penilaian/{{$data['id_anak']}}/update"><i class='bx bx-edit text-yellow-300'></i></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    document.getElementById('filter').addEventListener('change', function() {
        var filterValue = this.value;
        var rows = document.querySelectorAll('#penilaian-table tr');
        rows.forEach(function(row) {
            if (filterValue === 'all') {
                row.style.display = '';
            } else if (filterValue === 'true' && row.classList.contains('true')) {
                row.style.display = '';
            } else if (filterValue === 'false' && row.classList.contains('false')) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection


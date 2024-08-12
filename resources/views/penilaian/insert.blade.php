@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/penilaian"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Penilaian</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Tambah Penilaian</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bg-white border rounded-md mx-3 my-3 py-3 px-4">
        @if (session()->has('failed'))
        <div class="mb-3 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            {{session('Data sudah ditambahkan!')}}
            <strong class="font-bold ">Gagal menambahkan data! Data penilaian sudah ada!</strong>
          </div>
        @endif
        <form action="/penilaian/tambah" method="POST" class="flex flex-col w-full gap-y-7">
            @csrf
            <div class="flex flex-col">
                <div class="flex flex-col gap-y-7">
                    @can('admin')
                    <div class="flex flex-col select">
                        <label for="id_anak" class="mb-1 text-main text-xs font-semibold">NAMA</label>
                        <select data-te-select-init data-te-select-filter="true" name="id_anak" id="id_anak" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            @foreach ($alternatifs as $alternatif)
                            <option value="{{ $alternatif->id }}">{{$alternatif->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-wrap -mx-4">
                        @foreach ($kriterias as $kriteria)
                        <div class="w-full md:w-1/2 px-4 mb-4">
                            <div class="flex flex-col select">
                                <label for="status_gizi_{{ $kriteria->id }}" class="mb-1 text-main text-xs font-semibold uppercase">
                                    {{ $kriteria->kriteria }}
                                </label>
                                <select data-te-select-init required name="id_subkriteria[]" id="status_gizi_{{ $kriteria->id }}" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                                    <option value=""></option>
                                    @foreach ($kriteria->subkriteria as $subkriteria)
                                    <option value="{{ $subkriteria->id }}">{{ $subkriteria->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endcan
                    @can('pb')
                    <div class="flex flex-col select">
                        <label for="id_anak" class="mb-1 text-main text-xs font-semibold">NAMA</label>
                        <select data-te-select-init data-te-select-filter="true" name="id_anak" id="id_anak" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            @foreach ($alternatifs as $alternatif)
                            <option value="{{ $alternatif->id }}">{{$alternatif->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col select">
                        <label for="status_gizi" class="mb-1 text-main text-xs font-semibold uppercase">status gizi</label>
                        <select data-te-select-init name="id_subkriteria[]" id="status_gizi" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            @foreach ($kriterias[0]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}">{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                    @endcan
                    @can("ortu")
                    <div class="select hidden">
                        <label for="id_anak" class="mb-1 text-main text-xs font-semibold">NAMA</label>
                        <input type="number" name="id_anak" id="id_anak" class="h-9 text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly value="{{ $id->id}}">
                    </div>
                    <div class="flex flex-col select">
                        <label for="penghasilan_ortu" class="mb-1 text-main text-xs font-semibold uppercase">penghasilan orang tua</label>
                        <select data-te-select-init required name="id_subkriteria[]" id="penghasilan_ortu" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value=""></option>
                            @foreach ($kriterias[1]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}">{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col select">
                        <label for="jml_tanggungan" class="mb-1 text-main text-xs font-semibold uppercase">jumlah tanggungan</label>
                        <select data-te-select-init required name="id_subkriteria[]" id="jml_tanggungan" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required>
                            <option value=""></option>
                            @foreach ($kriterias[2]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}">{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col select">
                        <label for="pekerjaan_kepkel" class="mb-1 text-main text-xs font-semibold uppercase">pekerjaan kepala keluarga</label>
                        <select data-te-select-init required name="id_subkriteria[]" id="pekerjaan_kepkel" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value=""></option>
                            @foreach ($kriterias[3]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}">{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col select">
                        <label for="material_lantai" class="mb-1 text-main text-xs font-semibold uppercase">material lantai rumah </label>
                        <select data-te-select-init required name="id_subkriteria[]" id="material_lantai" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value=""></option>
                            @foreach ($kriterias[4]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}">{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                    @endcan
                </div>
            </div>
            <div>
                <button type="submit" class="text-white bg-main px-10 py-2 rounded-md hover:bg-emerald-800">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

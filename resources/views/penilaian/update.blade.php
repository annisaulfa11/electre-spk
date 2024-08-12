@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    @can('admin')
                    <a href="/penilaian"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Penilaian</span></a>
                    @endcan
                    @can('pb')
                    <a href="/penilaian"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Penilaian</span></a>
                    @endcan
                    @can('ortu')
                    <a href="/data"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Penilaian</span></a>
                    @endcan
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Edit Penilaian</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bg-white border rounded-md mx-3 my-3 py-3 px-4">
        <form action="/penilaian/{{$id->id}}" method="POST" class="flex flex-col gap-y-7">
            @csrf
            @method('put')
            <div class="flex flex-row">
                <div class="flex flex-col w-full pr-8 gap-y-7">
                    <div class="flex flex-col select">
                        <label for="id_alternatif" class="mb-1 text-main text-xs font-semibold">NAMA</label>
                        <input type="text" name="nama" id="nama" class="h-9 text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly value="{{ $id->nama}}">
                    </div>
                    @can('pb')
                    <div class="flex flex-col select">
                        <label for="status_gizi" class="mb-1 text-main text-xs font-semibold uppercase">status gizi</label>
                        <input type="hidden" name="idpen[]" value="{{ $data[0]->id }}">
                        <select data-te-select-init name="id_subkriteria[]" id="status_gizi" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value="-">Pilih status gizi</option>
                            @foreach ($kriterias[0]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}" @if ($data[0]->id_subkriteria == $kriteria->id) selected @endif>{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>

                    @endcan
                    @can('ortu')
                    {{--  <div class="flex flex-col select">
                        <label for="status_gizi" class="mb-1 text-main text-xs font-semibold uppercase">status gizi</label>
                        @php
                            $status_gizi = '';
                            $id_status = 0;
                        @endphp
                        @foreach ($kriterias[0]->subkriteria as $kriteria)
                            @if ($data[0]->id_subkriteria == $kriteria->id)
                                @php
                                    $status_gizi = $kriteria->keterangan;
                                    $id_status = $kriteria->id;
                                @endphp
                            @endif
                        @endforeach
                        <input type="text" name="status_gizi" id="status_gizi"  placeholder="{{$status_gizi}}" class="h-9 text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly>
                        <input type="hidden" class="hidden" value="{{ $id_status }}">
                    </div>  --}}
                    <div class="flex flex-wrap -mx-2">
                        @foreach ($kriterias as $index => $kriteria)
                            @php
                                // Check if $data[$index] exists, otherwise set it to null
                                $penilaian = isset($data[$index]) ? $data[$index] : null;
                            @endphp
                            <div class="w-full md:w-1/2 px-2 mb-4">
                                <div class="flex flex-col select">
                                    @if (strtolower($kriteria->kriteria) == 'status gizi')
                                        <label class="mb-1 text-main text-xs font-semibold uppercase">{{ $kriteria->kriteria }}</label>
                                        <input type="hidden" name="idpen[]" value="{{ $penilaian ? $penilaian->id : '' }}">
                                        <input type="text" name="status_gizi" id="status_gizi"  placeholder="{{$penilaian->subkriteria->keterangan}}" class="h-9 text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly>
                                        <input type="hidden" name="id_subkriteria[]" value="{{ $penilaian->subkriteria->id }}">
                                    @else
                                        <label class="mb-1 text-main text-xs font-semibold uppercase">{{ $kriteria->kriteria }}</label>
                                        <!-- Include hidden input for Penilaian ID -->
                                        <input type="hidden" name="idpen[]" value="{{ $penilaian ? $penilaian->id : '' }}">
                                        <select data-te-select-init name="id_subkriteria[]" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required>
                                            <option value=""></option>
                                            @foreach ($kriteria->subkriteria as $subkriteria)
                                                <option value="{{ $subkriteria->id }}" @if ($penilaian && $penilaian->id_subkriteria == $subkriteria->id) selected @endif>{{ $subkriteria->keterangan }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endcan

                    @can("admin")
                    <div class="flex flex-wrap -mx-2">
                        @foreach ($kriterias as $index => $kriteria)
                            @php
                                // Check if $data[$index] exists, otherwise set it to null
                                $penilaian = isset($data[$index]) ? $data[$index] : null;
                            @endphp
                            <div class="w-full md:w-1/2 px-2 mb-4">
                                <div class="flex flex-col select">
                                    <label class="mb-1 text-main text-xs font-semibold uppercase">{{ $kriteria->kriteria }}</label>
                                    <!-- Include hidden input for Penilaian ID -->
                                    <input type="hidden" name="idpen[]" value="{{ $penilaian ? $penilaian->id : '' }}">
                                    <select data-te-select-init name="id_subkriteria[]" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required>
                                        <option value=""></option>
                                        @foreach ($kriteria->subkriteria as $subkriteria)
                                            <option value="{{ $subkriteria->id }}" @if ($penilaian && $penilaian->id_subkriteria == $subkriteria->id) selected @endif>{{ $subkriteria->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>




                    {{--  <div class="flex flex-col select">
                        <label for="status_gizi" class="mb-1 text-main text-xs font-semibold uppercase">status gizi</label>
                        <select data-te-select-init name="id_subkriteria[]" id="status_gizi" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value="-">Pilih status gizi</option>
                            @foreach ($kriterias[0]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}" @if ($data[0]->id_subkriteria == $kriteria->id) selected @endif>{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col select">
                        <label for="penghasilan_ortu" class="mb-1 text-main text-xs font-semibold uppercase">penghasilan orang tua</label>
                        <select data-te-select-init name="id_subkriteria[]" id="penghasilan_ortu" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value="-">Pilih penghasilan orang tua</option>
                            @foreach ($kriterias[1]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}" @if ($data[1]->id_subkriteria == $kriteria->id) selected @endif>{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-col w-1/2 gap-y-7">
                    <div class="flex flex-col select">
                        <label for="jml_tanggungan" class="mb-1 text-main text-xs font-semibold uppercase">jumlah tanggungan</label>
                        <select data-te-select-init name="id_subkriteria[]" id="jml_tanggungan" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value="-">Pilih jumlah tanggungan</option>
                            @foreach ($kriterias[2]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}" @if ($data[2]->id_subkriteria == $kriteria->id) selected @endif>{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col select">
                        <label for="pekerjaan_kepkel" class="mb-1 text-main text-xs font-semibold uppercase">pekerjaan kepala keluarga</label>
                        <select data-te-select-init name="id_subkriteria[]" id="pekerjaan_kepkel" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value="-">Pilih pekerjaan kepala keluarga</option>
                            @foreach ($kriterias[3]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}" @if ($data[3]->id_subkriteria == $kriteria->id) selected @endif>{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col select">
                        <label for="material_lantai" class="mb-1 text-main text-xs font-semibold uppercase">material lantai rumah </label>
                        <select data-te-select-init name="id_subkriteria[]" id="material_lantai" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                            <option value="-">Pilih jumlah tanggungan</option>
                            @foreach ($kriterias[4]->subkriteria as $kriteria)
                            <option value="{{ $kriteria->id }}" @if ($data[4]->id_subkriteria == $kriteria->id) selected @endif>{{$kriteria->keterangan}} </option>
                            @endforeach
                        </select>
                    </div>  --}}
                    @endcan
                @can('pb')
                    </div>
                @endcan
                @can('admin')
                    </div>
                @endcan

            </div>
            <div>
                <button type="submit" class="text-white bg-main px-10 py-2 rounded-md hover:bg-emerald-800">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

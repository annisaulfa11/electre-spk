@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/kriteria"><span class="text-gray-500 hover:text-main hover:font-semibold">Data Kriteria</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Tambah Kriteria</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bg-white border rounded-md mx-3 my-3 py-3 px-4">
        <form action="/kriteria/tambah" method="POST" class="flex flex-col gap-y-7">
            @csrf
            <div class="flex flex-col ">
                <label for="kriteria" class="mb-1 text-main text-xs font-semibold">KRITERIA</label>
                <input type="text" name="kriteria" id="kriteria" class="h-9 text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required value="{{old('kriteria') }}">
            </div>
            <div class="flex flex-col select">
                <label for="bobot_kriteria" class="mb-1 text-main text-xs font-semibold">BOBOT</label>
                <select data-te-select-init name="bobot_kriteria" id="bobot" class="h-fit text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" required>
                    <option value="5">Sangat penting</option>
                    <option value="4">Penting</option>
                    <option value="3">Cukup penting</option>
                    <option value="2">Tidak penting</option>
                    <option value="1">Sangat tidak penting</option>
                </select>
            </div>
            <div>
                <h3 class="mb-1 text-main text-xs font-semibold">SUBKRITERIA</h3>
                <div class="flex flex-row justify-between w-full gap-x-3 mb-3">
                    <input type="text" name="keterangan[]" id="keterangan" placeholder="Masukkan keterangan subkriteria" class="h-9 w-full text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" >
                    <input type="text" placeholder="Sangat Diprioritaskan" class="h-9 w-full text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly>
                    <input type="number" class="hidden" name="bobot[]" value="5">
                </div>
                <div class="flex flex-row justify-between w-full gap-x-3 mb-3">
                    <input type="text" name="keterangan[]" id="keterangan" placeholder="Masukkan keterangan subkriteria" class="h-9 w-full text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" >
                    <input type="text" placeholder="Diprioritaskan" class="h-9 w-full text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly>
                    <input type="number" class="hidden" name="bobot[]" value="4">
                </div><div class="flex flex-row justify-between w-full gap-x-3 mb-3">
                    <input type="text" name="keterangan[]" id="keterangan" placeholder="Masukkan keterangan subkriteria" class="h-9 w-full text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                    <input type="text" placeholder="Cukup Diprioritaskan" class="h-9 w-full text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly>
                    <input type="number" class="hidden" name="bobot[]" value="3">
                </div><div class="flex flex-row justify-between w-full gap-x-3 mb-3">
                    <input type="text" name="keterangan[]" id="keterangan" placeholder="Masukkan keterangan subkriteria" class="h-9 w-full text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" >
                    <input type="text" placeholder="Tidak Diprioritaskan" class="h-9 w-full text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly>
                    <input type="number" class="hidden" name="bobot[]" value="2">
                </div><div class="flex flex-row justify-between w-full gap-x-3">
                    <input type="text" name="keterangan[]" id="keterangan" placeholder="Masukkan keterangan subkriteria" class="h-9 w-full text-gray-500 border rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main">
                    <input type="text" placeholder="Sangat Tidak Diprioritaskan" class="h-9 w-full text-gray-500 border bg-slate-200 rounded-sm border-slate-400 focus:outline-none focus:ring-0 focus:border-main" readonly>
                    <input type="number" class="hidden" name="bobot[]" value="1">
                </div>
            </div>
            <div>
                <button type="submit" class="text-white bg-main px-10 py-2 rounded-md hover:bg-emerald-800">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

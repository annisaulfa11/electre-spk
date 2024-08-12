@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56 flex flex-col">
    <div class="flex flex-col bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <h2 class="text-center text-main font-bold uppercase">Sistem pendukung keputusan penentuan balita penerima PMT Pemulihan pada puskesmas pauh menggunakan metode electre</h2>
    </div>
    <div class="flex flex-row mx-3 mb-3 justify-evenly gap-x-3">

        @can('admin')
        <ul class="flex w-full orange text-white border rounded-md  px-4 py-3 drop-shadow-sm">
            <a href="/posyandu" class="flex flex-col w-full justify-between">
                <div>
                    <h2>Posyandu</h2>
                    <h5 class="mt-2 text-sm">Total posyandu {{$posyandu}}</h5>
                </div>
                <div class="flex items-end justify-between mt-4">
                    <h5 class="text-sm">View detail</h5>
                    <i class='bx bx-right-arrow-alt text-xl leading-none'></i>
                </div>
            </a>
        </ul>
        <ul class="flex w-full yellow text-white border rounded-md  px-4 py-3 drop-shadow-sm">
            <a href="/kriteria" class="flex flex-col w-full justify-between">
                <div class="">
                    <h2>Kriteria</h2>
                    <h5 class="mt-2 text-sm">Total kriteria {{$kriteria}}</h5>
                </div>
                <div class="flex items-end justify-between ">
                    <h5 class="text-sm">View detail</h5>
                    <i class='bx bx-right-arrow-alt text-xl leading-none'></i>
                </div>
            </a>
        </ul>
        <ul class="flex w-full blue text-white border rounded-md  px-4 py-3 drop-shadow-sm">
            <a href="/alternatif" class="flex flex-col w-full justify-between">
                <div class="">
                    <h2>Alternatif</h2>
                    <h5 class="mt-2 text-sm">Total alternatif {{$anak}}</h5>
                </div>
                <div class="flex items-end justify-between ">
                    <h5 class="text-sm">View detail</h5>
                    <i class='bx bx-right-arrow-alt text-xl leading-none'></i>
                </div>
            </a>
        </ul>
        <ul class="flex w-full purple text-white border rounded-md  px-4 py-3 drop-shadow-sm">
            <a href="/penilaian" class="flex flex-col w-full justify-between">
                <div class="">
                    <h2>Penilaian</h2>
                    <h5 class="mt-2 text-sm">Total penilaian {{$penilaian}}</h5>
                </div>
                <div class="flex items-end justify-between ">
                    <h5 class="text-sm">View detail</h5>
                    <i class='bx bx-right-arrow-alt text-xl leading-none'></i>
                </div>
            </a>
        </ul>
        @elsecan('pb')
        <ul class="flex w-full yellow text-white border rounded-md  px-4 py-3 drop-shadow-sm">
            <a href="/kriteria" class="flex flex-col w-full justify-between">
                <div class="">
                    <h2>Kriteria</h2>
                    <h5 class="mt-2 text-sm">Total kriteria  {{$kriteria}}</h5>
                </div>
                <div class="flex items-end justify-between ">
                    <h5 class="text-sm">View detail</h5>
                    <i class='bx bx-right-arrow-alt text-xl leading-none'></i>
                </div>
            </a>
        </ul>
        <ul class="flex w-full blue text-white border rounded-md  px-4 py-3 drop-shadow-sm">
            <a href="/alternatif" class="flex flex-col w-full justify-between">
                <div class="">
                    <h2>Alternatif</h2>
                    <h5 class="mt-2 text-sm">Total alternatif {{$anak}}</h5>
                </div>
                <div class="flex items-end justify-between ">
                    <h5 class="text-sm">View detail</h5>
                    <i class='bx bx-right-arrow-alt text-xl leading-none'></i>
                </div>
            </a>
        </ul>
        <ul class="flex w-full purple text-white border rounded-md  px-4 py-3 drop-shadow-sm">
            <a href="/penilaian" class="flex flex-col w-full justify-between">
                <div class="">
                    <h2>Penilaian</h2>
                    <h5 class="mt-2 text-sm">Total penilaian {{$penilaian}}</h5>
                </div>
                <div class="flex items-end justify-between ">
                    <h5 class="text-sm">View detail</h5>
                    <i class='bx bx-right-arrow-alt text-xl leading-none'></i>
                </div>
            </a>
        </ul>
        @endcan
    </div>
    <div class="flex flex-row mx-3 mb-3 justify-evenly gap-x-3">
        <div class="flex flex-col bg-white w-full border rounded-md  px-4 py-3 drop-shadow-sm">
            <h3 class="text-center text-main font-semibold mb-4">Sistem Pendukung Keputusan</h3>
            <p class="text-justify mb-8">Sistem Pendukung Keputusan (SPK) adalah sebuah sistem informasi yang digunakan untuk mendukung proses pengambilan keputusan dalam suatu organisasi atau perusahaan. Tujuan utama SPK adalah menyediakan bantuan dalam pengambilan keputusan yang melibatkan aspek-aspek kompleks dengan menyajikan informasi yang relevan dan terstruktur. SPK memanfaatkan metode matematika atau statistika untuk mengolah data dan informasi, yang kemudian menghasilkan rekomendasi atau opsi keputusan yang dapat digunakan oleh para pengambil keputusan (Sarwandi et al., 2023).</p>
            <h3 class="text-center text-main font-semibold mb-4">Metode ELECTRE</h3>
            <p class="text-justify mb-8">Metode ELECTRE adalah salah satu metode pengambilan keputusan yang dikembangkan di Eropa oleh Bernard Roy pada tahun 1960-an. Metode ini digunakan untuk mengatasi kekurangan solusi dalam pengambilan keputusan. Singkatan dari ELECTRE adalah Elimination Et Choix Traduisant la Realite, yang dalam Bahasa Inggris berarti "Elimination and Choice Expressing Reality." Metode ELECTRE adalah sebuah pendekatan pengambilan keputusan dalam Multi Attribute Decision Making (MADM), yang memungkinkan seleksi alternatif berdasarkan kriteria tertentu yang digunakan. Metode ELECTRE efektif untuk situasi MADM yang melibatkan kriteria baik kualitatif maupun kuantitatif. Prinsip yang mendasari metode ini adalah menangani peringkat alternatif dengan memanfaatkan perbandingan berpasangan antar alternatif berdasarkan kriteria yang telah ditentukan sebelumnya (Putra, 2022).</p>
            <h3 class="text-center text-main font-semibold mb-4">Petunjuk Penggunaan Aplikasi</h3>
            @can("admin")
            <p class="text-justify">
                <b>Tahapan Penggunaan Aplikasi :</b> <br>
                1. Mengisi <a href="/kriteria"><u>data kriteria</u></a> yang dibutuhkan. <br>
                2. Mengisi data balita (<a href="/alternatif"><u>data alternatif</u></a>). <br>
                3. Mengisi <a href="/penilaian"><u>data penilaian</u></a> balita berdasarkan kriteria yang ada. <br>
                4. Melihat <a href="/hasil/proses"><u>proses dan hasil perhitungan</u></a>.
            </p>
            @endcan
            @can("pb")
            <p class="text-justify">
                <b>Tahapan Penggunaan Aplikasi :</b> <br>
                1. Mengisi <a href="/kriteria"><u>data kriteria</u></a> yang dibutuhkan. <br>
                2. Mengisi <a href="/penilaian"><u>data penilaian</u></a> balita berdasarkan kriteria yang ada. <br>
                3. Melihat <a href="/hasil/proses"><u>proses dan hasil perhitungan</u></a>.
            </p>
            @endcan

            @can('ortu')
            <p class="text-justify">
                <b>Tahapan Penggunaan Aplikasi :</b> <br>
                1. Mengisi data anak (<a href="/anak"><u>data anak</u></a>). <br>
                2. Mengisi <a href="/data"><u>data penilaian</u></a> balita berdasarkan kriteria yang ada. <br>
                3. Melihat <a href="/hasil-ortu"><u>hasil perhitungan</u> apakah anak menerima bantuan PMT Pemulihan atau tidak</a>.
            </p>
            @endcan
        </div>

    </div>
</div>

@endsection


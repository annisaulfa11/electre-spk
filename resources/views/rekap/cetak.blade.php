<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Perhitungan</title>
    <!-- Include Tailwind CSS styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="flex flex-col mx-5 my-5">
    <h1 class="mb-3 font-semibold">Rekap Perhitungan</h1>
    <table class="border-1 border-black w-fit">
        <thead class="border border-black break-all">
            <tr class="">
                <th class="border border-black py-3.5 px-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                <th class="border border-black py-3.5 px-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Nama</th>
                <th class="border border-black py-3.5 px-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Posyandu</th>
                <th class="border border-black py-3.5 px-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Orang tua</th>
                <th class="border border-black py-3.5 px-4 pr-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Ranking</th>
            </tr>
        </thead>
        <tbody class="border border-slate-500">
            @php
                $no = 1;
                $ranking = 1;
            @endphp
            @foreach ($data as $d)
                @php
                    $keterangan = json_decode($d->keterangan, true);
                @endphp
            <tr>
                <td class="border border-black py-3.5 px-4 text-left text-sm  text-slate-900 sm:pl-6">{{$no++}}</td>
                <td class="border border-black py-3.5 px-4 text-left text-sm  text-slate-900 sm:pl-6">{{$keterangan['alternatif']['nama']}}</td>
                <td class="border border-black py-3.5 px-4 text-left text-sm  text-slate-900 sm:pl-6">{{$keterangan['alternatif']['posyandu']['nama_posyandu']}}</td>
                <td class="border border-black py-3.5 px-4 text-left text-sm  text-slate-900 sm:pl-6">{{$keterangan['jumlah_e']}}</td>
                <td class="border border-black py-3.5 px-4 text-left text-sm  text-slate-900 sm:pl-6">{{ $ranking++ }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>



@extends('layouts.navbar')
@section('container')
<div class="sm:ml-56 flex flex-col">
    <div class="h-12 flex bg-white border rounded-md mx-3 my-3 border-slate-200 px-4 py-3 drop-shadow-sm">
        <nav class="flex justify-between items-center">
            <ul>
                <li class="flex items-center">
                    <a href="/hasil"><span class="text-gray-500 hover:text-main hover:font-semibold">Hasil Perhitungan</span></a>
                    <i class='bx bx-chevron-right text-2xl text-gray-500'></i>
                    <a><span class="text-main font-semibold">Proses Perhitungan</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Hasil Normalisasi</h1>
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Alternatif</th>
                    @foreach (range(1, count($normalisasi[0])) as $i)
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Kriteria {{ $i }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($normalisasi as $i => $row)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">Alternatif {{ $i + 1 }}</td>
                    @foreach ($row as $j => $value)
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ number_format($value, 4) }}</td>
                    @endforeach
                </tr>
                @endforeach

            </tbody>

        </table>
    </div>

    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Matriks Normalisasi Terbobot</h1>
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Alternatif</th>
                    @foreach (range(1, count($matriksTerbobot[0])) as $i)
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Kriteria {{ $i }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($matriksTerbobot as $i => $row)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">Alternatif {{ $i + 1 }}</td>
                    @foreach ($row as $j => $value)
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ number_format($value, 4) }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Himpunan Concordance</h1>
        <table class="w-full">
            <tbody>
                @foreach($indexConcordance as $i => $concordanceSet)
                    @foreach($concordanceSet as $j => $values)
                        <tr>
                            <td class="py-3.5 pl-4 pr-3 text-left text-sm text-slate-900 sm:pl-6">C<sub>{{ $i + 1 }},{{ $j + 1 }}</sub></td>
                            <td class="py-3.5 pl-4 pr-3 text-left text-sm text-slate-900 sm:pl-6">
                                {
                                @foreach($values as $value)
                                    {{ $value + 1 }}
                                @endforeach
                                }
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Himpunan Discordance</h1>
        <table class="w-full">
            <tbody>
                @foreach($indexDiscordance as $i => $discordanceSet)
                    @foreach($discordanceSet as $j => $values)
                        <tr>
                            <td class="py-3.5 pl-4 pr-3 text-left text-sm text-slate-900 sm:pl-6">D<sub>{{ $i + 1 }},{{ $j + 1 }}</sub></td>
                            <td class="py-3.5 pl-4 pr-3 text-left text-sm text-slate-900 sm:pl-6">
                                {
                                @foreach($values as $value)
                                    {{ $value + 1 }}
                                @endforeach
                                }
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Matriks Concordance</h1>
        <table class="w-full">
            <tbody>
                @foreach($matriksConcordance as $mc)
                <tr>
                    @for($i = 0; $i <= count($mc); $i++)
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ isset($mc[$i]) ? $mc[$i] : "-" }}</td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Matriks Discordance</h1>
        <table class="w-full">
            <tbody>
                @foreach($matriksDiscordance as $md)
                <tr>
                    @for($i = 0; $i <= count($md); $i++)
                        @if(isset($md[$i])) @if($md[$i]==1 || $md[$i]==0)
                        <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ $md[$i] }}</td>
                        @else
                        <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ number_format($md[$i], 4) }}</td>
                        @endif
                        @else
                        <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">-</td>
                        @endif
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Matriks Concordance Dominan</h1>
        <table class="w-full">
            <tbody>
                @foreach($concordanceDominant as $cd)
                <tr>
                    @for($i = 0; $i <= count($concordanceDominant[0]); $i++)
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ isset($cd[$i]) ? $cd[$i] : '-' }}</td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Matriks Discordance Dominan</h1>
        <table class="w-full">
            <tbody>
                @foreach($discordanceDominant as $dd)
                <tr>
                    @for($i = 0; $i <= count($discordanceDominant[0]); $i++)
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ isset($dd[$i]) ? $dd[$i] : '-' }}</td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Matriks Agregasi Dominan</h1>
        <table class="w-full">
            <tbody>
                @foreach($agregationDominant as $ad)
                <tr>
                    @for($i = 0; $i <= count($agregationDominant[0]); $i++)
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ isset($ad[$i]) ? $ad[$i] : '-' }}</td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Hasil Penjumlahan Elemen Matriks Agregasi Dominan</h1>
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Nama</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Jumlah e = 1</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($hasil as $h)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$h['nama']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$h['jumlah_e']}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="flex flex-col mb-3 h-fit border rounded-md mx-3 bg-white border-slate-200 px-4 py-3 drop-shadow-sm">
        <h1 class="mb-3 font-semibold">Hasil Perankingan</h1>
        <table class="w-full">
            <thead class="border break-all bg-slate-50">
                <tr>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">No</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Nama</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Jumlah e = 1</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Ranking</th>
                    <th class="py-3.5 pl-4 text-left text-sm font-semibold text-slate-900 sm:pl-6">Penjumlahan matriks terbobot</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $ranking = 1;
                @endphp
                @foreach ($rank as $r)
                <tr>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$no++}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$r['nama']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$r['jumlah_e']}}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{ $ranking++ }}</td>
                    <td class="py-3.5 pl-4 pr-3 text-left text-sm  text-slate-900 sm:pl-6">{{$r['matriks_terbobot']}}</td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection


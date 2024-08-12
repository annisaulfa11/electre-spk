<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Rekap;
use App\Models\Hasil;
use App\Models\Pembina;
use App\Models\Anak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function getHasil()
    {

        if(auth()->user()->role == "ortu"){
            $ortu = Auth::user();
            $ortuId = $ortu->id;
            $anaks = Anak::where('id_ortu', $ortuId)->pluck('id');
            $rank = Hasil::whereIn('id_anak', $anaks)->get();

            return view("hasil/index", compact("rank"));

        } elseif(auth()->user()->role == "pb") {
            $pembina = Auth::user();
            $pembinaId = $pembina->id;
            $posyandus = Pembina::where('id_user', $pembinaId)->pluck('id_posyandu');
            //dd($posyandus);
            $alternatifs = Anak::whereIn('id_posyandu', $posyandus)->pluck('id');
            $rank = Hasil::with('anak', 'posyandu')
                             ->whereHas('anak', function ($query) use ($alternatifs) {
                                 $query->whereIn('id_anak', $alternatifs);
                             })
                             ->get();
            //dd($rank);
            return view("hasil/index", compact("rank"));
        } else

        return $this->hasilAkhir();
    }
    public function hitung()
    {
        $normalisasi = $this->normalisasi();
        if (is_string($normalisasi)) {
            $message = $normalisasi;
            return view('alert', compact('message'));
        }
        $bobot = $this->bobot();
        $normalisasi = $this->normalisasi();
        $matriksTerbobot = $this->matriksTerbobot($normalisasi, $bobot);
        $indexConcordance = $this->indexConcordance($matriksTerbobot);
        $indexDiscordance = $this->indexDiscordance($matriksTerbobot);
        $matriksConcordance = $this->matriksConcordance($indexConcordance, $bobot);
        $matriksDiscordance = $this->matriksDiscordance($indexDiscordance, $matriksTerbobot);
        $concordanceThreshold = $this->concordanceThreshold($matriksConcordance);
        $discordanceThreshold = $this->discordanceThreshold($matriksDiscordance);
        $concordanceDominant = $this->concordanceDominant($concordanceThreshold, $matriksConcordance);
        $discordanceDominant = $this->discordanceDominant($discordanceThreshold, $matriksDiscordance);
        $agregationDominant = $this->agregationDominant($concordanceDominant, $discordanceDominant);
        $penjumlahanAgregationDominant = $this->penjumlahanAgregationDominant($agregationDominant);
        $hasil = $this->hasil($penjumlahanAgregationDominant, $matriksTerbobot);

        $rank = $this->rank($hasil);

        return view("hasil/proses", compact(
            "normalisasi",
            "matriksTerbobot",
            "indexConcordance",
            "indexDiscordance",
            "matriksConcordance",
            "matriksDiscordance",
            "concordanceDominant",
            "discordanceDominant",
            "agregationDominant",
            "hasil",
            "rank"
        ));
    }
    public function hasilAkhir()
    {
        $normalisasi = $this->normalisasi();
        if (is_string($normalisasi)) {
            $message = $normalisasi;
            return view('alert', compact('message'));
        }
        $bobot = $this->bobot();
        $normalisasi = $this->normalisasi();
        $matriksTerbobot = $this->matriksTerbobot($normalisasi, $bobot);
        $indexConcordance = $this->indexConcordance($matriksTerbobot);
        $indexDiscordance = $this->indexDiscordance($matriksTerbobot);
        $matriksConcordance = $this->matriksConcordance($indexConcordance, $bobot);
        $matriksDiscordance = $this->matriksDiscordance($indexDiscordance, $matriksTerbobot);
        $concordanceThreshold = $this->concordanceThreshold($matriksConcordance);
        $discordanceThreshold = $this->discordanceThreshold($matriksDiscordance);
        $concordanceDominant = $this->concordanceDominant($concordanceThreshold, $matriksConcordance);
        $discordanceDominant = $this->discordanceDominant($discordanceThreshold, $matriksDiscordance);
        $agregationDominant = $this->agregationDominant($concordanceDominant, $discordanceDominant);
        $penjumlahanAgregationDominant = $this->penjumlahanAgregationDominant($agregationDominant);
        $hasil = $this->hasil($penjumlahanAgregationDominant, $matriksTerbobot);
        //dd($hasil);
        $rank = $this->rank($hasil);
        //dd($rank);
        $cek = $this->cek($rank);
        $ket = $cek;
        $rank = Hasil::all();
        //dd($rank);
        return view("hasil/index", compact("rank", "ket"));
    }

    public function cek($rank)
    {
        $ket = $rank;
        $cek = Hasil::count();
        if ($cek <= 0) {
            foreach ($rank as $item) {
                $hasil = new Hasil();
                $hasil->id_anak = $item['id'];
                $hasil->jumlah_e = $item['jumlah_e'];
                $hasil->status = 0;
                $hasil->save();
            }
            $rank = Hasil::all();
        }

        return $ket;
    }

    public function store(Request $request)
    {
        //dd($request);
        $array = json_decode($request->input('array'));
        $status = Hasil::get('status')->pluck('status')->toArray();
        //dd($array);

        foreach ($array as $key => $item) {
            $item->status = $status[$key];
        }

        //dd($array);

        foreach ($array as $item) {
            Rekap::create([
                'keterangan' => json_encode($item)
            ]);
        }

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $array = json_decode($request->input('hasil')); // Assuming 'array' is the name of the input field containing the array data
        $status = $request->input('status');

        $hasil = Hasil::find($array->id);

        $hasil->status = $status;
        $hasil->save();

        return redirect()->back();
    }

    public function bobot()
    {
        $bobot = Kriteria::select('bobot')->get()->toArray();
        $combinedArray = [];
        foreach ($bobot as $subArray) {
            $combinedArray[] = $subArray["bobot"];
        }
        $bobot = $combinedArray;
        return $bobot;
    }

    public function normalisasi()
    {
        $penilaian = Penilaian::with('subkriteria')->select('id_anak', 'id_subkriteria')->get();
        $kriteriaCount = Kriteria::count();
        $data = $penilaian->groupBy('id_anak')->map(function ($items) use ($kriteriaCount) {
            if ($items->count() == $kriteriaCount) {
                return [
                    'subkriteria' => $items->pluck('subkriteria.bobot')->toArray()
                ];
            }
            return null;
        })->filter()->toArray();

        if (empty($data)) {
            return 'Data penilaian belum lengkap';
        }
        if (count($data) < 2) {
            return 'Lengkapi data penilaian! Data penilaian hanya 1! Jumlah data belum cukup untuk dihitung';
        }

        $value = [];
        foreach ($data as $key => $innerArray) {
            if (is_array($innerArray) && array_keys($innerArray) !== range(0, count($innerArray) - 1)) {
                $innerArray = array_values($innerArray);
            }
            if (!empty($innerArray)) {
                foreach ($innerArray as $element) {
                    $value[] = $element;
                }
            }
        }
        //dd($value);
        $normalisasi = $value;
        $sum = array_fill(0, count($value[0]), 0);
        for ($i = 0; $i < count($value); $i++) {
            for ($j = 0; $j < count($value[0]); $j++) {
                $sum[$j] += (pow($value[$i][$j], 2));
            }
        }
        for ($i = 0; $i < count($value); $i++) {
            for ($j = 0; $j < count($value[0]); $j++) {
                $normalisasi[$i][$j] = number_format($value[$i][$j] / sqrt($sum[$j]), 4);
            }
        }
        //dd($normalisasi);
        return $normalisasi;
    }

    public function matriksTerbobot($normalisasi, $bobot)
    {
        $matriksTerbobot = $normalisasi;
        for ($i = 0; $i < count($normalisasi); $i++) {
            for ($j = 0; $j < count($normalisasi[0]); $j++) {
                $matriksTerbobot[$i][$j] *= $bobot[$j];
            }
        }
        return $matriksTerbobot;
    }

    public function indexConcordance($matriksTerbobot)
    {
        $indexConcordance = array();
        $index = '';
        for ($i = 0; $i < count($matriksTerbobot); $i++) {
            if ($index != $i) {
                $index = $i;
                $indexConcordance[$i] = array();
            }

            for ($j = 0; $j < count($matriksTerbobot); $j++) {
                if ($i != $j) {
                    for ($k = 0; $k < count($matriksTerbobot[0]); $k++) {
                        if (!isset($indexConcordance[$i][$j])) {
                            $indexConcordance[$i][$j] = array();
                        }
                        if ($matriksTerbobot[$i][$k] >= $matriksTerbobot[$j][$k]) {
                            array_push($indexConcordance[$i][$j], $k);
                        }
                    }
                }
            }
        }

        return $indexConcordance;
    }

    public function indexDiscordance($matriksTerbobot)
    {

        $indexDiscordance = array();
        $index = '';
        for ($i = 0; $i < count($matriksTerbobot); $i++) {
            if ($index != $i) {
                $index = $i;
                $indexDiscordance[$i] = array();
            }

            for ($j = 0; $j < count($matriksTerbobot); $j++) {
                if ($i != $j) {
                    for ($k = 0; $k < count($matriksTerbobot[0]); $k++) {
                        if (!isset($indexDiscordance[$i][$j])) {
                            $indexDiscordance[$i][$j] = array();
                        }
                        if ($matriksTerbobot[$i][$k] < $matriksTerbobot[$j][$k]) {
                            array_push($indexDiscordance[$i][$j], $k);
                        }
                    }
                }
            }
        }

        return $indexDiscordance;
    }

    public function matriksConcordance($indexConcordance, $bobot)
    {
        $matriksConcordance = array();
        $index = '';

        for ($i = 0; $i < count($indexConcordance); $i++) {
            if ($index != $i) {
                $index = $i;
                $matriksConcordance[$i] = array();
            }

            for ($j = 0; $j < count($indexConcordance); $j++) {
                if ($i != $j && count($indexConcordance[$i][$j])) {
                    foreach ($indexConcordance[$i][$j] as $con) {
                        $matriksConcordance[$i][$j] = (isset($matriksConcordance[$i][$j]) ? $matriksConcordance[$i][$j] : 0) + (int) $bobot[$con];
                    }
                }
            }
        }
        return $matriksConcordance;
    }

    public function matriksDiscordance($indexDiscordance, $matriksTerbobot)
    {
        $matriksDiscordance = array();
        $index = '';

        for ($i = 0; $i < count($indexDiscordance); $i++) {
            if ($index != $i) {
                $index = $i;
                $matriksDiscordance[$i] = array();
            }

            for ($j = 0; $j < count($indexDiscordance); $j++) {
                if ($i != $j) {
                    $max_d = 0;
                    $max_j = 0;
                    foreach ($indexDiscordance[$i][$j] as $disc) {
                        if ($max_d < abs($matriksTerbobot[$i][$disc] - $matriksTerbobot[$j][$disc])) {
                            $max_d = abs($matriksTerbobot[$i][$disc] - $matriksTerbobot[$j][$disc]);
                        }
                    }
                    for ($k = 0; $k < count($matriksTerbobot[0]); $k++) {
                        if ($max_j < abs($matriksTerbobot[$i][$k] - $matriksTerbobot[$j][$k])) {
                            $max_j = abs($matriksTerbobot[$i][$k] - $matriksTerbobot[$j][$k]);
                        }
                    }
                    $matriksDiscordance[$i][$j] = $max_d / $max_j;
                }
            }
        }
        return $matriksDiscordance;
    }

    public function concordanceThreshold($matriksConcordance)
    {
        $sigma_c = 0;
        foreach ($matriksConcordance as $k => $cl) {
            foreach ($cl as $l => $value) {
                $sigma_c += $value;
            }
        }
        $concordanceThreshold = $sigma_c / (count($matriksConcordance) * (count($matriksConcordance) - 1));

        return $concordanceThreshold;
    }

    public function discordanceThreshold($matriksDiscordance)
    {
        $sigma_d = 0;
        foreach ($matriksDiscordance as $k => $dl) {
            foreach ($dl as $l => $value) {
                $sigma_d += $value;
            }
        }
        $discordanceThreshold = $sigma_d / (count($matriksDiscordance) * (count($matriksDiscordance) - 1));

        return $discordanceThreshold;
    }

    public function concordanceDominant($concordanceThreshold, $matriksConcordance)
    {
        $cd = array();
        foreach ($matriksConcordance as $k => $cl) {
            $cd[$k] = array();
            foreach ($cl as $l => $value) {
                $cd[$k][$l] = ($value >= $concordanceThreshold ? 1 : 0);
            }
        }
        return $cd;
    }
    public function discordanceDominant($discordanceThreshold, $matriksDiscordance)
    {
        $dd = array();
        foreach ($matriksDiscordance as $k => $cl) {
            $dd[$k] = array();
            foreach ($cl as $l => $value) {
                $dd[$k][$l] = ($value >= $discordanceThreshold ? 0 : 1);
            }
        }
        return $dd;
    }

    public function agregationDominant($concordanceDominant, $discordanceDominant)
    {
        $agregationDominant = array();
        foreach ($concordanceDominant as $k => $sl) {
            $agregationDominant[$k] = array();
            foreach ($sl as $l => $value) {
                $agregationDominant[$k][$l] = $concordanceDominant[$k][$l] * $discordanceDominant[$k][$l];
            }
        }
        return $agregationDominant;
    }

    public function penjumlahanAgregationDominant($agregationDominant)
    {
        $matrixCollection = collect($agregationDominant);
        // Sum each row of the matrix
        $rowSums = $matrixCollection->map(function ($row) {
        return collect($row)->sum();
        });
        return $rowSums;
    }

    public function hasil($rowSums, $matriksTerbobot)
    {
        $penilaian = Penilaian::with('subkriteria')->select('id_anak', 'id_subkriteria')->get();
        $kriteriaCount = Kriteria::count(); // Count the total number of kriteria
        $data = $penilaian->groupBy('id_anak')->map(function ($items) use ($kriteriaCount) {
            // Only include children with a complete set of penilaian
            if ($items->count() == $kriteriaCount) {
                return [
                    'subkriteria' => $items->pluck('subkriteria.bobot')->toArray()
                ];
            }
            return null; // Exclude incomplete data
        })->filter()->toArray();

        // Get alternatif (id_anak) from the filtered data
        $alternatif = array_keys($data);

        // Fetch detailed information about the alternatif
        $alternatif = Anak::whereIn('id', $alternatif)
            ->with('posyandu:id,nama_posyandu', 'user:id,name,alamat,no_hp')
            ->get();
        //$alternatif = Penilaian::orderBy('id')->with('anak:id,nama,id_posyandu,id_ortu', 'anak.posyandu:id,nama_posyandu', 'anak.user:id,name,alamat,no_hp')->groupBy('id_anak')->get('id_anak')->toArray();
        //dd($alternatif);
        $matrixCollection = collect($matriksTerbobot);

        // Ensure both arrays have the same length
        $length = min(count($rowSums), count($matriksTerbobot));

        // Sum each row of the matrix
        $sumMT = $matrixCollection->map(function ($row) {
            return collect($row)->sum();
        });

        // Add 'jumlah_e' and 'matriksTerbobot' component to each array in the existing array
        $combinedArray = collect($alternatif)->take($length)->map(function ($item, $index) use ($rowSums, $sumMT) {
            $item['jumlah_e'] = $rowSums[$index] ?? null;
            $item['matriks_terbobot'] = $sumMT[$index] ?? null;
            return $item;
        })->toArray();
        //dd($combinedArray);
        return $combinedArray;
    }


    public function rank($dataHasil)
    {
        $sortedArray = collect($dataHasil)->sortByDesc(function ($item) {
            return [$item['jumlah_e'], $item['matriks_terbobot']];
        })->values()->toArray();

        //dd($sortedArray);
        return $sortedArray;
    }


}

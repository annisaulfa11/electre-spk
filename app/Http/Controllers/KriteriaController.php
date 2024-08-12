<?php

namespace App\Http\Controllers;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\Hasil;

use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function get()
    {
        $kriterias = Kriteria::all();
        return view('kriteria/index', compact('kriterias'));
    }

    public function index()
    {
        return view('kriteria/insert');
    }
    public function insert(Request $request)
    {
        $kriteria = $request->input('kriteria');
        $bobot_kriteria = $request->input('bobot_kriteria');
        $data = Kriteria::create([
            'kriteria' => $kriteria,
            'bobot' => $bobot_kriteria
        ]);

        $keterangan = $request->input('keterangan');
        $bobot = $request->input('bobot');

        foreach ($keterangan as $index => $ket) {
            if ($ket != NULL) {
                Subkriteria::create([
                    'id_kriteria' => $data->id,
                    'keterangan' => $ket,
                    'bobot' => $bobot[$index]
                ]);
            }
        }
        Hasil::truncate();
        return redirect('/kriteria');
    }

    public function delete(Kriteria $id)
    {
        Kriteria::where('id', $id->id)->delete();
        Hasil::truncate();

        return redirect('/kriteria');

    }

    public function getData(Kriteria $id)
    {
        $subkriteria = SubKriteria::where('id_kriteria', $id->id)->get();
        return view('kriteria/update', compact('id', 'subkriteria'));
    }


    public function update(Request $request, Kriteria $id)
    {

        $id->update([
            'kriteria' => $request->input('kriteria'),
            'bobot' => $request->input('bobot_kriteria'),
        ]);

        $existingSubkriteria = SubKriteria::where('id_kriteria', $id->id)->get();

        $keterangan = $request->input('keterangan');
        $bobot = $request->input('bobot');
        $idsub = $request->input('idsub');

        foreach ($keterangan as $index => $ket) {
            $subkriteria = $existingSubkriteria->where('id', $idsub[$index])->first();
            //dd($subkriteria);
            if ($subkriteria) {
                $subkriteria->update([
                    'keterangan' => $ket,
                    'bobot' => $bobot[$index],
                ]);

            } else if($ket != null) {
                Subkriteria::create([
                    'id_kriteria' => $id->id,
                    'keterangan' => $ket,
                    'bobot' => $bobot[$index],
                ]);
            }
        }
        Hasil::truncate();

        return redirect('/kriteria');
    }

    public function getSubkriteria(Kriteria $id)
    {
        $id_kriteria = $id->id;
        $subkriterias = SubKriteria::where('id_kriteria', $id_kriteria)->orderByDesc('bobot')->get();
        //dd($subkriteria);
        return view('kriteria/subkriteria', compact('subkriterias'));
    }
}

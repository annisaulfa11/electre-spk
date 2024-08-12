<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Anak;
use App\Models\Kriteria;
use App\Models\Pembina;
use App\Models\Penilaian;
use App\Models\Hasil;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function get()
    {
        if(auth()->user()->role == "ortu"){
            return $this->getAnak();
        } elseif(auth()->user()->role == "pb") {
            return $this->getAlternatif();
        } else
        $data = Penilaian::with('anak', 'subkriteria')->select('id_anak', 'id_subkriteria')->get();

        $kriterias = Kriteria::all();
        $total = count($kriterias);

        $penilaians = $data->groupBy('id_anak')->map(function ($items, $id_anak) use ($total) {
            return [
                'id_anak' => $id_anak,
                'nama' => $items->first()->anak->nama,
                'subkriteria' => $items->pluck('subkriteria.keterangan')->toArray(),
                'is_complete' => count($items) === $total,
            ];
        });
        //dd($penilaians);

        return view('penilaian/index', compact('penilaians','kriterias', 'total'));
    }

    public function getData()
    {
        if(auth()->user()->role == "pb"){
            $pembina = Auth::user();
            $pembinaId = $pembina->id;
            $posyandus = Pembina::where('id_user', $pembinaId)->pluck('id_posyandu');
            $evaluatedAnakIds = Penilaian::pluck('id_anak')->toArray();
            $alternatifs = Anak::whereIn('id_posyandu', $posyandus)
                                ->whereNotIn('id', $evaluatedAnakIds)
                                ->get();
        } else {
            $evaluatedAnakIds = Penilaian::pluck('id_anak')->toArray();
            $alternatifs = Anak::whereNotIn('id', $evaluatedAnakIds)->get();
        }

        $kriterias = Kriteria::all();
        $total = count($kriterias);
        return view('penilaian.insert', compact('alternatifs', 'kriterias', 'total'));
    }


    public function insert(Request $request)
    {
        $id_anak = $request->input('id_anak');
        $id_subkriteria = $request->input('id_subkriteria');

        $penilaian = Penilaian::where('id_anak', $id_anak)->count();
        $kriterias = Kriteria::all();
        $total = count($kriterias);
        //dd($penilaian);
        if ($penilaian < $total) {
            foreach ($id_subkriteria as $id_sub) {
                if ($id_sub != 0) {
                    Penilaian::create([
                        'id_anak' => $id_anak,
                        'id_subkriteria' => $id_sub
                    ]);
                }
            }
            Hasil::truncate();
            return redirect('/penilaian');
        } else
        return back()->with('failed', 'Data telah ditambahkan!');

    }

    public function getPenilaian(Anak $id)
    {
        $kriterias = Kriteria::all();
        $anaks = Anak::all();
        $data = Penilaian::where('id_anak', $id->id)->get();

        return view('penilaian/update', compact('id', 'data', 'kriterias', 'anaks'));
    }

    public function getPenilaian2(Anak $id)
    {
        $kriterias = Kriteria::all();
        $anaks = Anak::all();
        $data = Penilaian::where('id_anak', $id->id)->get();

        //dd($data);
        return view('penilaian/insert', compact('id', 'data', 'kriterias', 'anaks'));
    }

    public function update(Request $request, Anak $id)
    {
        $penilaian = Penilaian::where('id_anak', $id->id)->get();
        $id_subkriteria = $request->input('id_subkriteria');
        $idpen = $request->input('idpen');

        foreach ($id_subkriteria as $index => $subkriteria_id) {
            // Find or create the Penilaian record based on $idpen[$index]
            $penilaian = Penilaian::updateOrCreate(
                ['id' => $idpen[$index], 'id_anak' => $id->id],
                ['id_subkriteria' => $subkriteria_id]
            );
        }
        Hasil::truncate();
        return redirect('/penilaian');
    }

    public function delete(Anak $id)
    {
        Penilaian::where('id_anak', $id->id)->delete();
        Hasil::truncate();
        return redirect('/penilaian');

    }

    public function getAnak()
    {
        $ortu = Auth::user();
        $ortuId = $ortu->id;
        $alternatifs = Anak::where('id_ortu', $ortuId)->get();
        //dd($alternatifs);
        $data = Penilaian::with('anak', 'subkriteria')
                             ->whereHas('anak', function ($query) use ($ortuId) {
                                 $query->where('id_ortu', $ortuId);
                             })
                             ->get();

        $kriterias = Kriteria::all();
        $total = count($kriterias);
        $penilaians = $data->groupBy('id_anak')->map(function ($items, $id_anak) use ($total) {
            return [
                'id_anak' => $id_anak,
                'nama' => $items->first()->anak->nama,
                'subkriteria' => $items->pluck('subkriteria.keterangan')->toArray(),
                'is_complete' => count($items) === $total,
            ];
        });

        if($penilaians->isEmpty() && $alternatifs->isNotEmpty()) {
            return view('alert', ['message' => 'Jika anak tidak masuk ke dalam daftar calon penerima bantuan PMT Pemulihan maka status gizi anak baik!']);

        } else if($penilaians->isEmpty() && $alternatifs->isEmpty()) {
            return view('alert', ['message' => 'Data anak tidak ada! Tambahkan data anak!']);

        } else {
            return view('penilaian/index', compact('penilaians', 'kriterias'));
        }

    }
    public function getAlternatif()
    {
        $pembina = Auth::user();
        $pembinaId = $pembina->id;
        $posyandus = Pembina::where('id_user', $pembinaId)->pluck('id_posyandu');
        //dd($posyandus);
        $alternatifs = Anak::whereIn('id_posyandu', $posyandus)->pluck('id');

        $data = Penilaian::with('anak', 'subkriteria')
                             ->whereHas('anak', function ($query) use ($posyandus) {
                                 $query->whereIn('id_posyandu', $posyandus);
                             })
                             ->get();

        $kriterias = Kriteria::all();
        $total = count($kriterias);
        $penilaians = $data->groupBy('id_anak')->map(function ($items, $id_anak) use ($total) {
            return [
                'id_anak' => $id_anak,
                'nama' => $items->first()->anak->nama,
                'subkriteria' => $items->pluck('subkriteria.keterangan')->toArray(),
                'is_complete' => count($items) === $total,
            ];
        });

        return view('penilaian/index', compact('penilaians', 'kriterias'));
    }


    public function insertData(Request $request)
    {
        $id_anak = $request->input('id_anak');
        $id_subkriteria = $request->input('id_subkriteria');
        //dd($request);
        foreach ($id_subkriteria as $id_sub) {
            if ($id_sub != 0) {
                Penilaian::create([
                    'id_anak' => $id_anak,
                    'id_subkriteria' => $id_sub
                ]);
            }
        }
        Hasil::truncate();
        return redirect('/penilaian');
    }
}

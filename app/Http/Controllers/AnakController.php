<?php

namespace App\Http\Controllers;
use App\Models\Anak;
use App\Models\Posyandu;
use App\Models\Pembina;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AnakController extends Controller
{
    public function get()
    {
        if(auth()->user()->role == "ortu"){
            return $this->getAnak();
        } elseif(auth()->user()->role == "pb") {
            return $this->getAlternatif();
        } else
        $alternatifs = Anak::all();
        return view('alternatif/index', compact('alternatifs'));
    }

    public function getPosyandu()
    {
        if(auth()->user()->role == "pb"){
            $pembina = Auth::user();
            $pembinaId = $pembina->id;
            $posyanduId = Pembina::where('id_user', $pembinaId)->pluck('id_posyandu');
            $posyandus = Posyandu::whereIn('id', $posyanduId)->get();
            $orangtua = User::where('role', 'ortu')->get();

        } elseif(auth()->user()->role == "ortu") {
            $orangtua = Auth::user();
            $posyandus = Posyandu::all();
        } else {
            $posyandus = Posyandu::all();
            $orangtua = User::where('role', 'ortu')->get();
        }
        //dd($orangtua);
        return view('alternatif/insert', compact('posyandus', 'orangtua'));

    }
    public function insert(Request $request)
    {
        //validasi inputan
        $validated = $request->validate([
            'nama' => 'required',
            'umur' => 'required',
            'id_ortu' => 'required',
            'id_posyandu' => 'required',
        ]);

        Anak::create($validated);
        return redirect('/alternatif');
    }

    public function getData(Anak $id)
    {
        if(auth()->user()->role == "pb"){
            $pembina = Auth::user();
            $pembinaId = $pembina->id;
            $posyanduId = Pembina::where('id_user', $pembinaId)->pluck('id_posyandu');
            $posyandus = Posyandu::whereIn('id', $posyanduId)->get();
        } else {
        $posyandus = Posyandu::all();
        }

        $id_posyandu = $id->id_posyandu;
        $orangtua = User::where('role', 'ortu')->get();

        return view('alternatif/update', compact('id', 'posyandus', 'orangtua'));
    }

    public function update(Request $request, Anak $id)
    {
        // validasi inputan
        $validated = $request->validate([
            'nama' => 'required',
            'umur' => 'required',
            'id_ortu' => 'required',
            'id_posyandu' => 'required',
        ]);

        $id->update($validated);

        return redirect('/alternatif');
    }

    public function delete(Anak $id)
    {
        $id->delete();

        return redirect('/alternatif');

    }

    public function getAnak()
    {
        $ortu = Auth::user();
        $ortuId = $ortu->id;
        $alternatifs = Anak::where('id_ortu', $ortuId)->get();
        if ($alternatifs->isEmpty()) {
            return view('alternatif/index', compact('alternatifs'));

        } else {
            return view('alternatif/index', compact('alternatifs'));
        }
    }

    public function getAlternatif()
{
    $pembina = Auth::user();
    $pembinaId = $pembina->id;
    $posyandus = Pembina::where('id_user', $pembinaId)->pluck('id_posyandu');
    //dd($posyandus);
    $alternatifs = Anak::whereIn('id_posyandu', $posyandus)->get();
    return view('alternatif/index', compact('alternatifs'));
}


}

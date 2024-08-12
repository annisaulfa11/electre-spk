<?php

namespace App\Http\Controllers;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    public function get()
    {
        $posyandus = Posyandu::all();
        return view('posyandu/index', compact('posyandus'));
    }
    public function insert(Request $request)
    {
        //validasi inputan
        $validated = $request->validate([
            'nama_posyandu' => 'required',
            'alamat' => 'required',
            'kelurahan' => 'required',
        ]);

        Posyandu::create($validated);
        return redirect('/posyandu');
    }

    public function getData(Posyandu $id)
    {
        $data = Posyandu::find($id->id);
        //dd($data);
        return view('posyandu/update', compact('data'));
    }

    public function update(Request $request, Posyandu $id)
    {
        // validasi inputan
        $validated = $request->validate([
            'nama_posyandu' => 'required',
            'alamat' => 'required',
            'kelurahan' => 'required',
        ]);

        $id->update($validated);

        return redirect('/posyandu');
    }

    public function delete(Posyandu $id)
    {
        $id->delete();
        return redirect('/posyandu');

    }
}

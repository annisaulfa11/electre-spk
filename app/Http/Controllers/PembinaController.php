<?php

namespace App\Http\Controllers;
use App\Models\Pembina;
use App\Models\Posyandu;
use App\Models\User;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    //
    public function getPembina(User $id)
    {
        $users = User::where('role', 'pb')->get();
        $id_user = $id->id;
        $datas = Pembina::where('id_user', $id_user)->get();
        $idPosyandu = $datas->pluck('id_posyandu')->toArray();
        $posyandus = Posyandu::whereNotIn('id', $idPosyandu)->get();
        //$posyandus = Posyandu::all();
        return view('pembina/posyandu', compact('datas', 'id_user', 'posyandus'));
    }

    public function delete(User $id, Pembina $idPos)
    {
        $idPos->delete();
        return redirect()->back();

    }

    public function insert(Request $request)
    {
        //validasi inputan
        $validated = $request->validate([
            'id_user' => 'required',
            'id_posyandu' => 'required',
        ]);

        Pembina::create($validated);
        return redirect()->back();
    }
}

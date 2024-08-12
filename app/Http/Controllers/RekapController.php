<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use Illuminate\Http\Request;


class RekapController extends Controller
{
    public function get()
    {
        $data = Rekap::groupBy('created_at')->get();

        return view("rekap/index", compact("data"));
    }

    public function getRekap(Rekap $id)
    {
        $rekap = $id->id;
        $data = Rekap::where('created_at', $id->created_at)->get();
        return view("rekap/rekap", compact("data", "rekap"));
    }

    public function cetak(Rekap $id)
    {
        $data = Rekap::where('created_at', $id->created_at)->get();

        return view("rekap/cetak", compact("data"));
    }

    public function delete(Rekap $id)
    {
        $data = Rekap::where('created_at', $id->created_at)->get();
        foreach ($data as $record) {
            $record->delete();
        }
        return redirect('/rekap');
    }
}

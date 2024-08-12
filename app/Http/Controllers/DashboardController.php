<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\Anak;
use App\Models\Penilaian;
use App\Models\Kriteria;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posyandu = Posyandu::count();
        $anak = Anak::count();
        $kriteria = Kriteria::count();
        $penilaian = Penilaian::distinct('id_anak')->count();
        return view('dashboard', compact('posyandu','anak','penilaian', 'kriteria'));
    }

    public function tes()
    {
        $matriks = [[1,2],[3,4]];
        return view('tes', compact('matriks'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $table = 'hasil';
    public $timestamps = false;
    //  protected $fillable = [
    //     'id_alternatif',
    //     'id_subkriteria'
    // ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'id_anak', 'id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }

    public function rekap()
    {
        return $this->belongsTo(Rekap::class, 'id_rekap', 'id');
    }
}

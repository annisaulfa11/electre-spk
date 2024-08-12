<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Subkriteria extends Model
{
    use HasFactory;

    protected $table = 'subkriteria';
    public $timestamps = false;
     protected $fillable = [
        'id_kriteria',
        'keterangan',
        'bobot',
    ];
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id');
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class, 'id_subkriteria', 'id');
    }
}

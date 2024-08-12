<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Anak extends Model
{
    use HasFactory;

    protected $table = 'anak';
    public $timestamps = false;
     protected $fillable = [
        'id_ortu',
        'nama',
        'umur',
        'id_posyandu'
    ];

    public function penilaian(): HasMany
    {
        return $this->hasMany(Anak::class);
    }

    public function hasil(): HasMany
    {
        return $this->hasMany(Hasil::class);
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_ortu', 'id');
    }
}

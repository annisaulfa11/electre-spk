<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandu';
    public $timestamps = false;
     protected $fillable = [
        'nama_posyandu',
        'alamat',
        'kelurahan',
    ];

    public function anak(): HasMany
    {
        return $this->hasMany(Anak::class);
    }
    public function hasil(): HasMany
    {
        return $this->hasMany(Hasil::class);
    }

    public function pembina(): HasMany
    {
        return $this->hasMany(Pembina::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rekap extends Model
{
    use HasFactory;
    protected $table = 'rekap';
    public $timestamps = false;

    protected $fillable = ['keterangan'];

    public function hasil(): HasMany
    {
        return $this->hasMany(Hasil::class);
    }
}

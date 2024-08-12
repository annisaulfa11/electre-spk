<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    public $timestamps = false;
     protected $fillable = [
        'kriteria',
        'bobot',
    ];

    public function subkriteria(): HasMany
    {
        return $this->hasMany(Subkriteria::class, 'id_kriteria', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Pembina extends Model
{
    use HasFactory;

    protected $table = 'pembina_wilayah';
    public $timestamps = false;
     protected $fillable = [
        'id_user',
        'id_posyandu'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'id_posyandu', 'id');
    }
}

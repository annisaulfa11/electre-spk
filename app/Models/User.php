<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    public $timestamps = false;
     protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'alamat',
        'no_hp',
        'foto'
    ];

    public function anak(): HasMany
    {
        return $this->hasMany(Anak::class);
    }

    public function pembina(): HasMany
    {
        return $this->hasMany(Pembina::class, 'id_user', 'id');
    }
}

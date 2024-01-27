<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function absensi(){
        return $this->hasMany(Absensi::class, 'id_user');
    }
    public function stasi(){
        return $this->hasOne(Stasi::class, 'id', 'stasi_id');
    }

    public function scopeFilterByStasi($query, $stasi){
        $query->when($stasi ?? false, function ($query, $stasi) {
            $query->whereHas('stasi', function ($q) use ($stasi) {
                $q->where('slug', $stasi);
            });
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mitra(){
        return $this->hasMany(Mitra::class);
    }

    public function departemen(){
        return $this->hasMany(Departemen::class);
    }

    public function dospem(){
        return $this->hasMany(Dosen::class);
    }

    public function spv(){
        return $this->hasMany(Supervisor::class);
    }

    public function mhs(){
        return $this->hasMany(Mahasiswa::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}

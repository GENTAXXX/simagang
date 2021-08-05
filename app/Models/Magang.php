<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $table = 'magang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tgl_mulai','tgl_selesai','mhs_id','dosen_id','spv_id','lowongan_id', 'approval', 'keterangan', 'nilai'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'mhs_id');
    }

    public function dosen(){
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function spv(){
        return $this->belongsTo(Supervisor::class, 'spv_id');
    }

    public function lowongan(){
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }

    public function bimbingan(){
        return $this->hasMany(Bimbingan::class);
    }
}

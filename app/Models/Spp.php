<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $table = 'spp';
    protected $primaryKey = 'id_spp';
    
    protected $fillable = [
        'tahun',
        'nominal',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_spp', 'id_spp');
    }

    // Relasi ke Pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_spp', 'id_spp');
    }
}
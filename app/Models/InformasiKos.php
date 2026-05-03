<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiKos extends Model
{
    protected $table = 'informasi_kos';

    protected $fillable = [
        'user_id',
        'nama_kos',
        'deskripsi',
        'alamat',
        'kota',
        'no_telepon',
        'harga_mulai',
        'foto_utama',
        'foto_galeri',
        'fasilitas',
        'tipe_kos',
        'status',
    ];

    protected $casts = [
        'foto_galeri' => 'array',
        'fasilitas'   => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'user_id', 'user_id');
    }
}
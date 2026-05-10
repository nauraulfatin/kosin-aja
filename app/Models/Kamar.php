<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
    'user_id', 'nomor_kamar', 'tipe_kamar', 'kapasitas', 'lantai',
    'ukuran', 'harga', 'status', 'foto_kamar', 'fasilitas', 'informasi_kos_id',
    'keterangan', 'deskripsi', 'metode_pembayaran',
];

    protected $casts = [
    'fasilitas'         => 'array',
    'foto_kamar'        => 'array',
    'metode_pembayaran' => 'array',
];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penghuni()
    {
        return $this->hasOne(Penghuni::class);
    }
    
    public function informasiKos()
{
    return $this->belongsTo(InformasiKos::class);
}
}
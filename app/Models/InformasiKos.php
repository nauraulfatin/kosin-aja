<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class InformasiKos extends Model
{
    protected $table = 'informasi_kos';

   protected $fillable = [
    'user_id', 'nama_kos', 'deskripsi', 'alamat', 'kota',
    'latitude', 'longitude',
    'no_telepon', 'harga_mulai', 'foto_utama', 'foto_galeri',
    'fasilitas', 'tipe_kos', 'status',
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
    return $this->hasMany(Kamar::class);
}

public function create()
{
    $informasiKos = InformasiKos::all();

    return view('admin.kamar.create', compact('informasiKos'));
}

}
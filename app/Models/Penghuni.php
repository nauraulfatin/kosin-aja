<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $fillable = [

        'user_id',
        'kamar_id',

        'nama',
        'email',
        'password',

        'nik',
        'alamat',
        'no_hp',

        'tanggal_masuk',
        'status',
    ];

    // Relasi ke user akun penghuni
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    // Relasi pembayaran
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}

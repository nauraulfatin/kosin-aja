<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [

        'penghuni_id',

        'bulan',

        'tahun',

        'nominal',

        'status',

    ];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }

    public function detailPembayarans()
    {
        return $this->hasMany(DetailPembayaran::class);
    }
}
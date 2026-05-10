<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    protected $fillable = [

        'pembayaran_id',

        'tagihan_id',

    ];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
}
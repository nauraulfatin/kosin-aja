<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [

        'penghuni_id',

        'bulan',

        'tahun',

        'jumlah_tagihan',

        'status',

        'tanggal_bayar',

        'bukti_pembayaran',

        'metode_pembayaran',

        'catatan',

    ];

    // =========================
    // RELATION
    // =========================

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }

    // =========================
    // STATUS BADGE
    // =========================

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {

            'belum_bayar' => 'Belum Bayar',

            'menunggu_verifikasi' => 'Menunggu Verifikasi',

            'lunas' => 'Lunas',

            'ditolak' => 'Ditolak',

            default => 'Unknown',
        };
    }
}
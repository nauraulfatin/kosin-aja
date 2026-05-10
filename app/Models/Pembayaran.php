<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [

    'penghuni_id',

    'total_bayar',

    'tanggal_bayar',

    'bukti_pembayaran',

    'metode_pembayaran',

    'catatan',

    'status',

];

    // =========================
    // RELATION
    // =========================

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }

    public function details()
{
    return $this->hasMany(DetailPembayaran::class);
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
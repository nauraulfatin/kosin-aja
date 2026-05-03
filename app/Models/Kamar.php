<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = ['user_id', 'nomor_kamar', 'harga', 'status', 'fasilitas', 'keterangan'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penghuni()
    {
        return $this->hasOne(Penghuni::class);
    }
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $fillable = ['user_id', 'kamar_id', 'nama', 'email', 'no_hp', 'password', 'tanggal_masuk', 'status'];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
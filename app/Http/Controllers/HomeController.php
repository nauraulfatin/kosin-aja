<?php

namespace App\Http\Controllers;

use App\Models\InformasiKos;

class HomeController extends Controller
{
    public function index()
    {
        $katalogKos = InformasiKos::where('status', 'aktif')
                                   ->latest()
                                   ->take(4)
                                   ->get();
        return view('katalog.home', compact('katalogKos'));
    }

    public function detail($id)
{
    $kos = \App\Models\InformasiKos::with('admin')->findOrFail($id);
    $kamars = \App\Models\Kamar::where('user_id', $kos->user_id)
                               ->orderBy('nomor_kamar')
                               ->get();
    return view('katalog.detail', compact('kos', 'kamars'));
}

}
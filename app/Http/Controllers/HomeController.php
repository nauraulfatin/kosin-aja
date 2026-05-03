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
}
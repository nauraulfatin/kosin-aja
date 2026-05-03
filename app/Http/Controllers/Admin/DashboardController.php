<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penghuni;

class DashboardController extends Controller
{
    private function checkRole()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index()
    {
        $this->checkRole();

        $adminId = auth()->id();

        $totalKamar   = Kamar::where('user_id', $adminId)->count();
        $kamarKosong  = Kamar::where('user_id', $adminId)->where('status', 'kosong')->count();
        $kamarTerisi  = Kamar::where('user_id', $adminId)->where('status', 'terisi')->count();
        $totalPenghuni = Penghuni::where('user_id', $adminId)->where('status', 'aktif')->count();

        $riwayatTerakhir = Penghuni::where('user_id', $adminId)
                                   ->latest()
                                   ->take(3)
                                   ->get();

        return view('admin.dashboard', compact(
            'totalKamar',
            'kamarKosong',
            'kamarTerisi',
            'totalPenghuni',
            'riwayatTerakhir'
        ));
    }
}
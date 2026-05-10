<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\Penghuni;
use App\Models\Pembayaran;
use App\Models\Tagihan;

class DashboardPenghuniController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // =========================
        // DATA PENGHUNI
        // =========================

        $penghuni = Penghuni::with([
                'kamar.informasiKos'
            ])
            ->where('user_id', $user->id)
            ->first();

        // =========================
        // TAGIHAN AKTIF
        // =========================

        $tagihanAktif = Tagihan::where(
                'penghuni_id',
                $penghuni->id
            )
            ->whereIn('status', [
                'belum_bayar',
                'menunggu_verifikasi'
            ])
            ->latest()
            ->get();

        // =========================
        // JUMLAH TAGIHAN
        // =========================

        $jumlahTagihan = $tagihanAktif->count();

        // =========================
        // TOTAL TUNGGAKAN
        // =========================

        $totalTunggakan = $tagihanAktif->sum('nominal');

        // =========================
        // RIWAYAT PEMBAYARAN
        // =========================

        $pembayaranTerbaru = Pembayaran::with([
                'details.tagihan'
            ])
            ->where('penghuni_id', $penghuni->id)
            ->latest()
            ->take(5)
            ->get();

        return view(
            'penghuni.dashboard',
            compact(
                'penghuni',
                'tagihanAktif',
                'jumlahTagihan',
                'totalTunggakan',
                'pembayaranTerbaru'
            )
        );
    }
}
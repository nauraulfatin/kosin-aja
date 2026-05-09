<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // =========================
    // INDEX
    // =========================

    public function index()
    {
        $pembayarans = Pembayaran::with([
                'penghuni.kamar'
            ])
            ->latest()
            ->get();

        // =========================
        // STATISTIK
        // =========================

        $sudahLunas = Pembayaran::where(
            'status',
            'lunas'
        )->count();

        $belumBayar = Pembayaran::where(
            'status',
            'belum_bayar'
        )->count();

        $menungguVerifikasi = Pembayaran::where(
            'status',
            'menunggu_verifikasi'
        )->count();

        return view('admin.pembayaran.index', compact(
            'pembayarans',
            'sudahLunas',
            'belumBayar',
            'menungguVerifikasi'
        ));
    }

    // =========================
    // DETAIL
    // =========================

    public function show($id)
    {
        $pembayaran = Pembayaran::with([
                'penghuni.kamar'
            ])
            ->findOrFail($id);

        return view(
            'admin.pembayaran.show',
            compact('pembayaran')
        );
    }

    // =========================
    // VERIFIKASI
    // =========================

    public function verifikasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([

            'status' => 'lunas',

            'tanggal_bayar' => now(),

        ]);

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi'
        );
    }

    // =========================
    // TOLAK
    // =========================

    public function tolak($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([

            'status' => 'ditolak',

        ]);

        return back()->with(
            'success',
            'Pembayaran ditolak'
        );
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Penghuni;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // =========================
    // INDEX
    // =========================

   public function index()
{
    $penghunis = Penghuni::with([
            'kamar',
            'tagihans'
        ])
        ->get();

    // statistik
    $sudahLunas = Tagihan::where(
        'status',
        'lunas'
    )->count();

    $belumBayar = Tagihan::where(
        'status',
        'belum_bayar'
    )->count();

    $menungguVerifikasi = Tagihan::where(
        'status',
        'menunggu_verifikasi'
    )->count();

    return view(
        'admin.pembayaran.index',
        compact(
            'penghunis',
            'sudahLunas',
            'belumBayar',
            'menungguVerifikasi'
        )
    );
}

    // =========================
    // DETAIL
    // =========================
public function show($id)
{
    $penghuni = Penghuni::with([
    'kamar',
    'pembayarans.details.tagihan'
])->findOrFail($id);

    return view(
        'admin.pembayaran.show',
        compact('penghuni')
    );
}

    // =========================
    // VERIFIKASI
    // =========================

    public function verifikasi($id)
{
    $pembayaran = Pembayaran::with(
        'details.tagihan'
    )->findOrFail($id);

    // update pembayaran
    $pembayaran->update([

        'status' => 'lunas',

        'tanggal_bayar' => now(),

    ]);

    // update semua tagihan terkait
    foreach ($pembayaran->details as $detail) {

        if ($detail->tagihan) {

            $detail->tagihan->update([

                'status' => 'lunas'

            ]);
        }
    }

    return redirect()
            ->back()
            ->with(
                'success',
                'Pembayaran berhasil diverifikasi'
            );
}

    // =========================
    // TOLAK
    // =========================

    public function tolak($id)
{
    $pembayaran = Pembayaran::with(
        'details.tagihan'
    )->findOrFail($id);

    // update pembayaran
    $pembayaran->update([

        'status' => 'ditolak',

    ]);

    // kembalikan status tagihan
    foreach ($pembayaran->details as $detail) {

        if ($detail->tagihan) {

            $detail->tagihan->update([

                'status' => 'belum_bayar'

            ]);
        }
    }

    return redirect()
            ->back()
            ->with(
                'success',
                'Pembayaran berhasil ditolak'
            );
}
}
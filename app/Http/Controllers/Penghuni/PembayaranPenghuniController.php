<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Penghuni;
use App\Models\Pembayaran;
use App\Models\DetailPembayaran;
use App\Models\Tagihan;

class PembayaranPenghuniController extends Controller
{
    // =========================
    // HALAMAN PEMBAYARAN
    // =========================

    public function index()
    {
        $penghuni = Penghuni::with('kamar')
                        ->where('user_id', Auth::id())
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
        // RIWAYAT PEMBAYARAN
        // =========================

        $pembayarans = Pembayaran::with([
                                'details.tagihan'
                            ])
                            ->where(
                                'penghuni_id',
                                $penghuni->id
                            )
                            ->latest()
                            ->get();

        return view(
            'penghuni.pembayaran.index',
            compact(
                'penghuni',
                'tagihanAktif',
                'pembayarans'
            )
        );
    }

    // =========================
    // FORM PEMBAYARAN
    // =========================

    public function create()
    {
        $penghuni = Penghuni::with('kamar')
                        ->where('user_id', Auth::id())
                        ->first();

        // =========================
        // TAGIHAN BELUM LUNAS
        // =========================

        $tagihans = Tagihan::where(
                        'penghuni_id',
                        $penghuni->id
                    )
                    ->where('status', 'belum_bayar')
                    ->latest()
                    ->get();

        return view(
            'penghuni.pembayaran.create',
            compact(
                'penghuni',
                'tagihans'
            )
        );
    }

    // =========================
    // SIMPAN PEMBAYARAN
    // =========================

    public function store(Request $request)
    {
        $request->validate([

            'tagihan_id' => 'required|array',

            'tanggal_bayar' => 'required',

            'metode_pembayaran' => 'required',

            'bukti_pembayaran' => 'required|image|max:2048',

        ]);

        $penghuni = Penghuni::with('kamar')
                        ->where('user_id', Auth::id())
                        ->first();

        // =========================
        // AMBIL TAGIHAN
        // =========================

        $tagihans = Tagihan::whereIn(
                            'id',
                            $request->tagihan_id
                        )
                        ->get();

        // =========================
        // HITUNG TOTAL
        // =========================

        $totalBayar = $tagihans->sum('nominal');

        // =========================
        // UPLOAD BUKTI
        // =========================

        $path = $request->file('bukti_pembayaran')
                        ->store(
                            'bukti-pembayaran',
                            'public'
                        );

        // =========================
        // SIMPAN PEMBAYARAN
        // =========================

        $pembayaran = Pembayaran::create([

            'penghuni_id' => $penghuni->id,

            'total_bayar' => $totalBayar,

            'tanggal_bayar' => $request->tanggal_bayar,

            'metode_pembayaran' => $request->metode_pembayaran,

            'bukti_pembayaran' => $path,

            'status' => 'menunggu_verifikasi',

        ]);

        // =========================
        // DETAIL PEMBAYARAN
        // =========================

        foreach ($tagihans as $tagihan) {

            DetailPembayaran::create([

                'pembayaran_id' => $pembayaran->id,

                'tagihan_id' => $tagihan->id,

            ]);

            // ubah status tagihan
            $tagihan->update([

                'status' => 'menunggu_verifikasi'

            ]);
        }

        return redirect()
                ->route('penghuni.pembayaran.index')
                ->with(
                    'success',
                    'Pembayaran berhasil dikirim'
                );
    }
}
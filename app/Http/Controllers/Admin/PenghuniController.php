<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Pembayaran;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenghuniController extends Controller
{
    // =========================
    // INDEX
    // =========================

    public function index()
    {
        $penghunis = Penghuni::with('user', 'kamar')
                        ->latest()
                        ->get();

        return view('admin.penghuni.index', compact('penghunis'));
    }

    // =========================
    // CREATE
    // =========================

    public function create()
    {
        $kamars = Kamar::where('status', 'kosong')->get();

        return view('admin.penghuni.create', compact('kamars'));
    }

    // =========================
    // STORE
    // =========================

    public function store(Request $request)
    {
        $request->validate([

            'nama'             => 'required',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:8',

            'nik'              => 'required',
            'alamat'           => 'required',
            'no_hp'            => 'required',

            'kamar_id'         => 'required',

            'tanggal_masuk'    => 'nullable|date',

            'status'           => 'required',

        ]);

        // =========================
        // BUAT USER LOGIN
        // =========================

        $user = User::create([

            'name'      => $request->nama,

            'email'     => $request->email,

            'password'  => Hash::make($request->password),

            'role'      => 'penghuni',

            'status'    => 'approved',

        ]);

        // =========================
        // SIMPAN PENGHUNI
        // =========================

        $penghuni = Penghuni::create([

            'user_id'          => $user->id,

            'kamar_id'         => $request->kamar_id,

            'nama'             => $request->nama,

            'email'            => $request->email,

            'password'         => Hash::make($request->password),

            'nik'              => $request->nik,

            'alamat'           => $request->alamat,

            'no_hp'            => $request->no_hp,

            'tanggal_masuk'    => $request->tanggal_masuk,

            'status'           => $request->status,

        ]);

        // =========================
        // UPDATE STATUS KAMAR
        // =========================

        $kamar = Kamar::find($request->kamar_id);

        $kamar->update([
            'status' => 'terisi'
        ]);

        // =========================
        // GENERATE TAGIHAN AWAL
        // =========================

        Pembayaran::create([

            'penghuni_id'      => $penghuni->id,

            'bulan'            => now()->translatedFormat('F'),

            'tahun'            => now()->year,

            'jumlah_tagihan'   => $kamar->harga,

            'status'           => 'belum_bayar',

        ]);

        return redirect()
                ->route('admin.penghuni.index')
                ->with('success', 'Penghuni berhasil ditambahkan');
    }

    // =========================
    // DETAIL
    // =========================

    public function show($id)
    {
        $penghuni = Penghuni::with([
            'user',
            'kamar',
            'pembayarans'
        ])->findOrFail($id);

        return view('admin.penghuni.show', compact('penghuni'));
    }

    // =========================
    // EDIT
    // =========================

    public function edit($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        $kamars = Kamar::where('status', 'kosong')
                        ->orWhere('id', $penghuni->kamar_id)
                        ->get();

        return view('admin.penghuni.edit', compact(
            'penghuni',
            'kamars'
        ));
    }

    // =========================
    // UPDATE
    // =========================

    public function update(Request $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);

        $request->validate([

            'nama' => 'required',

            'nik' => 'required',

            'alamat' => 'required',

            'no_hp' => 'required',

            'kamar_id' => 'required',

            'tanggal_masuk' => 'nullable|date',

            'status' => 'required',

        ]);

        // kamar lama
        $kamarLama = Kamar::find($penghuni->kamar_id);

        // kalau kamar berubah
        if ($penghuni->kamar_id != $request->kamar_id) {

            // kosongkan kamar lama
            $kamarLama->update([
                'status' => 'kosong'
            ]);

            // isi kamar baru
            $kamarBaru = Kamar::find($request->kamar_id);

            $kamarBaru->update([
                'status' => 'terisi'
            ]);
        }

        $penghuni->update([

            'nama' => $request->nama,

            'nik' => $request->nik,

            'alamat' => $request->alamat,

            'no_hp' => $request->no_hp,

            'kamar_id' => $request->kamar_id,

            'tanggal_masuk' => $request->tanggal_masuk,

            'status' => $request->status,

        ]);

        return redirect()
                ->route('admin.penghuni.index')
                ->with('success', 'Data penghuni berhasil diperbarui');
    }

    // =========================
    // DELETE
    // =========================

    public function destroy($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        // kosongkan kamar
        $kamar = Kamar::find($penghuni->kamar_id);

        $kamar->update([
            'status' => 'kosong'
        ]);

        // hapus user login
        User::find($penghuni->user_id)?->delete();

        // hapus penghuni
        $penghuni->delete();

        return redirect()
                ->route('admin.penghuni.index')
                ->with('success', 'Penghuni berhasil dihapus');
    }

    // =========================
    // KONFIRMASI PEMBAYARAN
    // =========================

    public function konfirmasiPembayaran($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([

            'status' => 'lunas',

            'tanggal_bayar' => now(),

        ]);

        return back()
                ->with('success', 'Pembayaran berhasil dikonfirmasi');
    }
}
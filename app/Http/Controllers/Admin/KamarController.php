<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class KamarController extends Controller
{
    private function checkRole()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }
    }

    public function index()
    {
        $this->checkRole();

        $kamars = Kamar::where('user_id', auth()->id())
            ->with('penghuni')
            ->orderBy('nomor_kamar')
            ->get();

        return view('admin.kamar.index', compact('kamars'));
    }

    public function create()
    {
        $this->checkRole();

        return view('admin.kamar.form', ['kamar' => null]);
    }

    public function store(Request $request)
    {
        $this->checkRole();

        $request->validate([
            'nomor_kamar'  => 'required|string|max:20',
            'harga'        => 'required|integer',
            'foto_kamar.*' => 'nullable|image|max:2048',
            'fasilitas'    => 'nullable|array',
            'keterangan'   => 'nullable|string',
        ]);

        // Upload multiple foto
        $fotoKamar = [];

        if ($request->hasFile('foto_kamar')) {
            foreach ($request->file('foto_kamar') as $foto) {
                $fotoKamar[] = $foto->store('kamar', 'public');
            }
        }

       $informasiKos = \App\Models\InformasiKos::where('user_id', auth()->id())->first();

Kamar::create([
    'user_id'           => auth()->id(),
    'informasi_kos_id'  => $informasiKos->id,

    'nomor_kamar'       => $request->nomor_kamar,
    'tipe_kamar'        => $request->tipe_kamar,
    'kapasitas'         => $request->kapasitas ?? 1,
    'lantai'            => $request->lantai,
    'ukuran'            => $request->ukuran,
    'harga'             => $request->harga,

    'status'            => 'kosong',

    'foto_kamar'        => $fotoKamar,
    'fasilitas'         => $request->fasilitas ?? [],
    'keterangan'        => $request->keterangan,
    'deskripsi'         => $request->deskripsi,
    'metode_pembayaran' => $request->metode_pembayaran ?? [],
]);

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function edit(Kamar $kamar)
    {
        $this->checkRole();

        if ($kamar->user_id !== auth()->id()) {
            abort(403);
        }

        return view('admin.kamar.form', compact('kamar'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $this->checkRole();

        if ($kamar->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'nomor_kamar'  => 'required|string|max:20',
            'harga'        => 'required|integer',
            'foto_kamar.*' => 'nullable|image|max:2048',
            'fasilitas'    => 'nullable|array',
            'keterangan'   => 'nullable|string',
        ]);

        // Ambil foto lama
        $fotoKamar = $request->existing_foto ?? [];

        // Tambahkan foto baru
        if ($request->hasFile('foto_kamar')) {
            foreach ($request->file('foto_kamar') as $foto) {
                $fotoKamar[] = $foto->store('kamar', 'public');
            }
        }

        $informasiKos = \App\Models\InformasiKos::where('user_id', auth()->id())->first();
        $kamar->update([
            'nomor_kamar' => $request->nomor_kamar,
             'tipe_kamar'        => $request->tipe_kamar,
    'kapasitas'         => $request->kapasitas ?? 1,
    'lantai'            => $request->lantai,
    'ukuran'            => $request->ukuran,
    'harga'             => $request->harga,
    'informasi_kos_id' => $informasiKos->id,
    'status'            => 'kosong',
    'foto_kamar'        => $fotoKamar,
    'fasilitas'         => $request->fasilitas ?? [],
    'keterangan'        => $request->keterangan,
    'deskripsi'         => $request->deskripsi,
    'metode_pembayaran' => $request->metode_pembayaran ?? [],
]);

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diupdate!');
    }

    public function destroy(Kamar $kamar)
    {
        $this->checkRole();

        if ($kamar->user_id !== auth()->id()) {
            abort(403);
        }

        // Hapus semua foto jika ada
        if ($kamar->foto_kamar) {
            foreach ($kamar->foto_kamar as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $kamar->delete();

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil dihapus!');
    }
}
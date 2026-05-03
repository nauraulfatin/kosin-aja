<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        'nomor_kamar'   => 'required|string|max:20',
        'harga'         => 'required|integer',
        'status'        => 'required|in:kosong,terisi',
        'foto_kamar.*'  => 'nullable|image|max:2048',
        'fasilitas'     => 'nullable|array',
        'keterangan'    => 'nullable|string',
    ]);

    // Upload multiple foto
    $fotoKamar = [];
    if ($request->hasFile('foto_kamar')) {
        foreach ($request->file('foto_kamar') as $foto) {
            $fotoKamar[] = $foto->store('kamar', 'public');
        }
    }

    Kamar::create([
        'user_id'     => auth()->id(),
        'nomor_kamar' => $request->nomor_kamar,
        'harga'       => $request->harga,
        'status'      => $request->status,
        'foto_kamar'  => $fotoKamar,
        'fasilitas'   => $request->fasilitas ?? [],
        'keterangan'  => $request->keterangan,
    ]);

    return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan!');
}

    public function edit(Kamar $kamar)
    {
        $this->checkRole();
        if ($kamar->user_id !== auth()->id()) abort(403);
        return view('admin.kamar.form', compact('kamar'));
    }

    public function update(Request $request, Kamar $kamar)
{
    $this->checkRole();
    if ($kamar->user_id !== auth()->id()) abort(403);

    $request->validate([
        'nomor_kamar'   => 'required|string|max:20',
        'harga'         => 'required|integer',
        'status'        => 'required|in:kosong,terisi',
        'foto_kamar.*'  => 'nullable|image|max:2048',
        'fasilitas'     => 'nullable|array',
        'keterangan'    => 'nullable|string',
    ]);

    // Ambil foto lama, tambahkan foto baru
    $fotoKamar = json_decode($kamar->foto_kamar, true) ?? [];
    if ($request->hasFile('foto_kamar')) {
        foreach ($request->file('foto_kamar') as $foto) {
            $fotoKamar[] = $foto->store('kamar', 'public');
        }
    }

    $kamar->update([
        'nomor_kamar' => $request->nomor_kamar,
        'harga'       => $request->harga,
        'status'      => $request->status,
        'foto_kamar'  => $fotoKamar,
        'fasilitas'   => $request->fasilitas ?? [],
        'keterangan'  => $request->keterangan,
    ]);

    return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diupdate!');
}

    public function destroy(Kamar $kamar)
    {
        $this->checkRole();
        if ($kamar->user_id !== auth()->id()) abort(403);
        if ($kamar->foto_kamar) Storage::disk('public')->delete($kamar->foto_kamar);
        $kamar->delete();
        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus!');
    }
}
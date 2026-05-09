<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiKos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiKosController extends Controller
{
    // =========================
    // CHECK ROLE
    // =========================

    private function checkRole()
    {
        if (
            !auth()->check()
            || auth()->user()->role !== 'admin'
        ) {
            abort(403, 'Akses ditolak.');
        }
    }

    // =========================
    // INDEX
    // =========================

    public function index()
    {
        $this->checkRole();

        $kos = InformasiKos::where(
            'user_id',
            auth()->id()
        )->first();

        return view(
            'admin.informasi.index',
            compact('kos')
        );
    }

    // =========================
    // CREATE
    // =========================

    public function create()
    {
        $this->checkRole();

        return view(
            'admin.informasi.form',
            [
                'kos' => null
            ]
        );
    }

    // =========================
    // STORE
    // =========================

    public function store(Request $request)
    {
        $this->checkRole();

        $request->validate([

            'nama_kos'     => 'required|string|max:255',

            'alamat'       => 'required|string',

            'deskripsi'    => 'nullable|string',

            'kota'         => 'nullable|string',

            'latitude'     => 'nullable|string',

            'longitude'    => 'nullable|string',

            'no_telepon'   => 'nullable|string',

            'harga_mulai'  => 'nullable|integer',

            'tipe_kos'     => 'required|in:Putra,Putri,Campur',

            'foto_utama'   => 'nullable|image|max:2048',

            'foto_galeri.*' => 'nullable|image|max:2048',

            'fasilitas'    => 'nullable|array',

        ]);

        // =========================
        // FOTO UTAMA
        // =========================

        $fotoUtama = null;

        if ($request->hasFile('foto_utama'))
        {
            $fotoUtama = $request->file('foto_utama')
                                 ->store(
                                     'foto-utama',
                                     'public'
                                 );
        }

        // =========================
        // FOTO GALERI
        // =========================

        $fotoGaleri = [];

        if ($request->hasFile('foto_galeri'))
        {
            foreach ($request->file('foto_galeri') as $foto)
            {
                $fotoGaleri[] = $foto->store(
                    'foto-galeri',
                    'public'
                );
            }
        }

        // =========================
        // SIMPAN
        // =========================

        InformasiKos::create([

            'user_id'      => auth()->id(),

            'nama_kos'     => $request->nama_kos,

            'deskripsi'    => $request->deskripsi,

            'alamat'       => $request->alamat,

            'kota'         => $request->kota,

            'latitude'     => $request->latitude,

            'longitude'    => $request->longitude,

            'no_telepon'   => $request->no_telepon,

            'harga_mulai'  => $request->harga_mulai,

            'tipe_kos'     => $request->tipe_kos,

            'foto_utama'   => $fotoUtama,

            'foto_galeri'  => $fotoGaleri,

            'fasilitas'    => $request->fasilitas ?? [],

            'status'       => 'aktif',

        ]);

        // =========================
        // REDIRECT
        // =========================

        return redirect()
                ->route('admin.informasi.index')
                ->with(
                    'success',
                    'Informasi kos berhasil disimpan'
                );
    }

    // =========================
    // EDIT
    // =========================

    public function edit()
    {
        $this->checkRole();

        $kos = InformasiKos::where(
            'user_id',
            auth()->id()
        )->firstOrFail();

        return view(
            'admin.informasi.form',
            compact('kos')
        );
    }

    // =========================
    // UPDATE
    // =========================

    public function update(Request $request)
    {
        $this->checkRole();

        $kos = InformasiKos::where(
            'user_id',
            auth()->id()
        )->firstOrFail();

        $request->validate([

            'nama_kos'     => 'required|string|max:255',

            'alamat'       => 'required|string',

            'deskripsi'    => 'nullable|string',

            'kota'         => 'nullable|string',

            'latitude'     => 'nullable|string',

            'longitude'    => 'nullable|string',

            'no_telepon'   => 'nullable|string',

            'harga_mulai'  => 'nullable|integer',

            'tipe_kos'     => 'required|in:Putra,Putri,Campur',

            'foto_utama'   => 'nullable|image|max:2048',

            'foto_galeri.*' => 'nullable|image|max:2048',

            'fasilitas'    => 'nullable|array',

        ]);

        // =========================
        // UPDATE FOTO UTAMA
        // =========================

        $fotoUtama = $kos->foto_utama;

        if ($request->hasFile('foto_utama'))
        {
            if ($fotoUtama)
            {
                Storage::disk('public')
                    ->delete($fotoUtama);
            }

            $fotoUtama = $request->file('foto_utama')
                                 ->store(
                                     'foto-utama',
                                     'public'
                                 );
        }

        // =========================
        // UPDATE FOTO GALERI
        // =========================

        $fotoGaleri = $kos->foto_galeri ?? [];

        if ($request->hasFile('foto_galeri'))
        {
            foreach ($request->file('foto_galeri') as $foto)
            {
                $fotoGaleri[] = $foto->store(
                    'foto-galeri',
                    'public'
                );
            }
        }

        // =========================
        // UPDATE DATA
        // =========================

        $kos->update([

            'nama_kos'     => $request->nama_kos,

            'deskripsi'    => $request->deskripsi,

            'alamat'       => $request->alamat,

            'kota'         => $request->kota,

            'latitude'     => $request->latitude,

            'longitude'    => $request->longitude,

            'no_telepon'   => $request->no_telepon,

            'harga_mulai'  => $request->harga_mulai,

            'tipe_kos'     => $request->tipe_kos,

            'foto_utama'   => $fotoUtama,

            'foto_galeri'  => $fotoGaleri,

            'fasilitas'    => $request->fasilitas ?? [],

        ]);

        // =========================
        // REDIRECT
        // =========================

        return redirect()
                ->route('admin.informasi.index')
                ->with(
                    'success',
                    'Informasi kos berhasil diperbarui'
                );
    }

    // =========================
    // HAPUS FOTO GALERI
    // =========================

    public function hapusFoto(Request $request)
    {
        $this->checkRole();

        $kos = InformasiKos::where(
            'user_id',
            auth()->id()
        )->firstOrFail();

        $foto = $request->foto;

        $galeri = collect($kos->foto_galeri)
                    ->filter(fn($f) => $f !== $foto)
                    ->values()
                    ->toArray();

        Storage::disk('public')->delete($foto);

        $kos->update([
            'foto_galeri' => $galeri
        ]);

        return back()->with(
            'success',
            'Foto berhasil dihapus'
        );
    }
}
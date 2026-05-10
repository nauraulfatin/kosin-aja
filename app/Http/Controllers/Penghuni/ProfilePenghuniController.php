<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Penghuni;
use App\Models\User;

class ProfilePenghuniController extends Controller
{
    // =========================
    // HALAMAN PROFIL
    // =========================

    public function index()
    {
        $penghuni = Penghuni::with([
                'kamar'
            ])
            ->where('user_id', Auth::id())
            ->first();

        return view(
            'penghuni.profil.index',
            compact('penghuni')
        );
    }

    // =========================
    // UPDATE PROFIL
    // =========================

    public function update(Request $request)
    {
        $penghuni = Penghuni::where(
                'user_id',
                Auth::id()
            )
            ->first();

        $request->validate([

            'nama' => 'required',

            'no_hp' => 'required',

            'alamat' => 'required',

            'password' => 'nullable|min:8|confirmed',

        ]);

        // update penghuni
        $penghuni->update([

            'nama' => $request->nama,

            'no_hp' => $request->no_hp,

            'alamat' => $request->alamat,

        ]);

        // update user login
        $user = User::find($penghuni->user_id);

        $user->update([

            'name' => $request->nama,

        ]);

        // update password jika diisi
        if ($request->password) {

            $user->update([

                'password' => Hash::make($request->password)

            ]);
        }

        return back()->with(
            'success',
            'Profil berhasil diperbarui'
        );
    }

    public function edit()
{
    $penghuni = Penghuni::with([
            'kamar'
        ])
        ->where('user_id', Auth::id())
        ->first();

    return view(
        'penghuni.profil.edit',
        compact('penghuni')
    );
}
}
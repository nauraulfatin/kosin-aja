<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Tampilkan daftar admin kos yang perlu disetujui.
     */
    public function index()
    {
        // Ambil semua user dengan role 'admin' yang statusnya belum disetujui
        $admins = User::where('role', 'admin')->get();

        // Tampilkan view superadmin dengan daftar admin kos
        return view('superadmin', compact('admins'));
    }

    /**
     * Setujui admin kos.
     */
    public function approve($id)
{
    // Cek apakah admin kos ditemukan
    $admin = User::find($id);

    if ($admin) {
        // Coba update status admin kos menjadi 'approved'
        $admin->status = 'approved';

        // Simpan perubahan
        if ($admin->save()) {
            return back()->with('success', 'Admin berhasil disetujui!');
        } else {
            return back()->with('error', 'Gagal menyetujui admin.');
        }
    } else {
        // Jika admin tidak ditemukan
        return redirect()->back()->with('error', 'Admin tidak ditemukan.');
    }
}

    /**
     * Tolak admin kos.
     */
    public function reject($id)
    {
        // Cek apakah admin kos ditemukan
        $admin = User::find($id);

        if ($admin) {
            // Ubah status admin kos menjadi 'rejected'
            $admin->update([
                'status' => 'rejected',
            ]);
        } else {
            // Jika admin tidak ditemukan, bisa kembalikan error atau redirect
            return redirect()->back()->with('error', 'Admin tidak ditemukan.');
        }

        // Redirect kembali ke halaman daftar admin kos
        return back()->with('success', 'Admin berhasil ditolak!');
    }
}
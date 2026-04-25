<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $pengajuanBaru = User::where('role', 'admin')->where('status', 'pending')->count();
        $totalMitra    = User::where('role', 'admin')->where('status', 'approved')->count();
        $ditolak       = User::where('role', 'admin')->where('status', 'rejected')->count();

        $pengajuanTerbaru = User::where('role', 'admin')
                                ->where('status', 'pending')
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();

        return view('superadmin.dashboard', compact(
            'pengajuanBaru',
            'totalMitra',
            'ditolak',
            'pengajuanTerbaru'
        ));
    }

    public function pengajuan()
    {
        $pengajuan = User::where('role', 'admin')
                         ->where('status', 'pending')
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('superadmin.pengajuan', compact('pengajuan'));
    }

    public function detail($id)
    {
        $admin = User::findOrFail($id);
        return view('superadmin.detail', compact('admin'));
    }

    public function approve($id)
{
    $admin = User::find($id);

    if ($admin) {
        $admin->status = 'approved';
        $admin->save();
        return redirect()->route('superadmin.pengajuan.detail', $id)->with('setujui', true);
    }

    return redirect()->route('superadmin.pengajuan')->with('error', 'Admin tidak ditemukan.');
}

public function reject($id)
{
    $admin = User::find($id);

    if ($admin) {
        $admin->status = 'rejected';
        $admin->save();
        return redirect()->route('superadmin.pengajuan.detail', $id)->with('tolak', true);
    }

    return redirect()->route('superadmin.pengajuan')->with('error', 'Admin tidak ditemukan.');
}

   public function riwayat()
{
    $query = User::where('role', 'admin')
                 ->whereIn('status', ['approved', 'rejected']);

    if (request('bulan')) {
        $query->whereMonth('created_at', request('bulan'));
    }

    $riwayat = $query->orderBy('created_at', 'desc')->get();

    return view('superadmin.riwayat', compact('riwayat'));
}

    public function adminList()
    {
        $admins = User::where('role', 'admin')
                      ->where('status', 'approved')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('superadmin.admin', compact('admins'));
    }

    public function hapusRiwayat($id)
{
    User::findOrFail($id)->delete();
    return redirect()->route('superadmin.riwayat')->with('success', 'Data berhasil dihapus.');
}
}
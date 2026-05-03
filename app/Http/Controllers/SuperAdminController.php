<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    private function checkRole()
    {
        if (!auth()->check() || auth()->user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index()
    {
        $this->checkRole();

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
        $this->checkRole();

        $pengajuan = User::where('role', 'admin')
                         ->where('status', 'pending')
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('superadmin.pengajuan', compact('pengajuan'));
    }

    public function detail($id)
    {
        $this->checkRole();

        $admin = User::findOrFail($id);
        return view('superadmin.detail', compact('admin'));
    }

    public function approve($id)
    {
        $this->checkRole();

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
        $this->checkRole();

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
        $this->checkRole();

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
        $this->checkRole();

        $admins = User::where('role', 'admin')
                      ->where('status', 'approved')
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('superadmin.admin', compact('admins'));
    }

    public function hapusRiwayat($id)
    {
        $this->checkRole();

        User::findOrFail($id)->delete();
        return redirect()->route('superadmin.riwayat')->with('success', 'Data berhasil dihapus.');
    }

    public function hapusAdmin($id)
    {
        $this->checkRole();

        User::findOrFail($id)->delete();
        return redirect()->route('superadmin.admin')->with('success', 'Admin berhasil dihapus.');
    }
}
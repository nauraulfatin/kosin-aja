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

    public function pengajuan() //(1 & 2) bukaMenuPendaftaran() + tampilkanDaftarPendaftaran()
    {
        $pengajuan = User::where('role', 'admin') //ambil data
                         ->where('status', 'pending')
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('superadmin.pengajuan', compact('pengajuan')); 
    }

    public function detail($id) //3. pilih pendaftaran untuk lihat detail
    {
        $admin = User::findOrFail($id); // 4. request detail 

        // untuk 5 dan 6 data diambil dari database
        return view('superadmin.detail', compact('admin')); //(7) tampilkanDetailPendaftaran()
    }

    public function approve($id) // 
{
    $admin = User::find($id);

    if ($admin) {
        $admin->status = 'approved';
        $admin->save();
        return redirect()->route('superadmin.pengajuan.detail', $id)->with('setujui', true);
    }

    return redirect()->route('superadmin.pengajuan')->with('error', 'Admin tidak ditemukan.');
}

public function reject($id) // 8. setujui atau tolak pendaftaran
{
    $admin = User::find($id); // 9. updateStatus()

    if ($admin) {
        $admin->status = 'rejected'; // 10. ubah status
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
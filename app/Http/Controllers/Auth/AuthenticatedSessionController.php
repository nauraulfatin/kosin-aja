<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
{
    // Autentikasi pengguna
    $request->authenticate();

    // Regenerasi session untuk keamanan
    $request->session()->regenerate();

    $user = auth()->user();

    // Cek status admin kos
    if ($user->role == 'admin' && $user->status != 'approved') {
        // Logout jika statusnya tidak approved
        auth()->logout();
        
        // Tampilkan pesan jika statusnya pending atau rejected
        return back()->withErrors([
            'email' => 'Akun Anda masih menunggu persetujuan dari Super Admin.'
        ]);
    }

    // Jika statusnya approved, lanjutkan ke halaman dashboard
    return redirect()->intended(route('dashboard'));
}
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout user
        Auth::guard('web')->logout();

        // Hapus session untuk menghindari session hijacking
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
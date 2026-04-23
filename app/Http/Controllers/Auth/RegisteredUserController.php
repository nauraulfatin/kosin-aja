<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
   public function store(LoginRequest $request)
{
    // Validasi input pengguna
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|confirmed|min:8',
        'invitation_code' => 'required|exists:invitation_codes,code|in:unused', // Kode undangan
    ]);

    // Validasi Kode Undangan
    $invitationCode = InvitationCode::where('code', $request->invitation_code)->first();
    $invitationCode->status = 'used'; // Ubah status kode jadi 'used'
    $invitationCode->save();

    // Proses pendaftaran user dan set status ke 'pending'
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'admin',
        'status' => 'pending', // Set status admin kos ke 'pending'
    ]);

    // Redirect ke halaman login dengan pesan pendaftaran berhasil
    return redirect()->route('login')->with('status', 'Pendaftaran berhasil! Menunggu persetujuan Super Admin.');
}
}

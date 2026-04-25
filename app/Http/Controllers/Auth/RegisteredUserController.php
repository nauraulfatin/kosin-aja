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
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
    'name'      => ['required', 'string', 'max:255'],
    'phone'     => ['nullable', 'string', 'max:20'],
    'nama_kos'  => ['required', 'string', 'max:255'],
    'alamat_kos'=> ['required', 'string'],
    'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
    'password'  => ['required', 'confirmed', Rules\Password::defaults()],
]);

$user = User::create([
    'name'       => $request->name,
    'phone'      => $request->phone,
    'nama_kos'   => $request->nama_kos,
    'alamat_kos' => $request->alamat_kos,
    'email'      => $request->email,
    'password'   => Hash::make($request->password),
    'role'       => 'admin',
    'status'     => 'pending',
]);

        event(new Registered($user));

        // Logout langsung, redirect ke register dengan popup berhasil
        Auth::logout();

        return redirect()->route('register')->with('registered', true);
    }
}
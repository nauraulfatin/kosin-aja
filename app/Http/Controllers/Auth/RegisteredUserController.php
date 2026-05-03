<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; // tambahan
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
            'name'                 => ['required', 'string', 'max:255'],
            'phone'                => ['nullable', 'string', 'max:20'],
            'nama_kos'             => ['required', 'string', 'max:255'],
            'alamat_kos'           => ['required', 'string'],
            'email'                => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'             => ['required', 'confirmed', Rules\Password::defaults()],
            'g-recaptcha-response' => ['required'],
        ], [
            'g-recaptcha-response.required' => 'Harap centang reCAPTCHA terlebih dahulu.',
        ]);

        // Verifikasi ke Google
        $recaptcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$recaptcha->json('success')) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal, coba lagi.'])
                ->withInput();
        }

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
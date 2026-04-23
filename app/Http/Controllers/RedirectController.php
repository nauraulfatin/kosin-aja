<?php

namespace App\Http\Controllers;

class RedirectController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'super_admin') {
            return redirect('/superadmin');
        }

        if ($user->role == 'admin') {
            return view('adminkos');
        }

        return redirect('/');
    }
}
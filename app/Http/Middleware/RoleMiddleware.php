<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        $role
    ): Response
    {
        // belum login
        if (!auth()->check()) {

            return redirect('/login');
        }

        // role tidak sesuai
        if (auth()->user()->role != $role) {

            abort(403);
        }

        return $next($request);
    }
}
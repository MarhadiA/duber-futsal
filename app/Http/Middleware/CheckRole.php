<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        // Jika role user sesuai dengan yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika pelatih mencoba masuk ke area terlarang, lempar ke dashboard pelatih
        if ($user->role === 'coach') {
            return redirect()->route('coach.dashboard')->with('error', 'Akses ditolak.');
        }

        return abort(403, 'Unauthorized action.');
    }
}

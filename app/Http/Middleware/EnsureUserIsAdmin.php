<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                             ->with('error', 'Connectez-vous pour accéder à cette page.');
        }

        if (!auth()->user()->is_verified) {
            return redirect()->route('verify.email.form');
        }

        if (!auth()->user()->isAdmin()) {
            abort(403, 'Accès refusé. Vous n\'êtes pas administrateur.');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // ✅ LIBRARIAN → LIBRARIAN DASHBOARD
                if ($user->role_id == 3) {
                    return redirect()->route('librarian.dashboard');
                }

                if ($user->role_id == 2) {
                    return redirect()->route('faculty.dashboard');
                }

                if ($user->role_id == 1) {
                    return redirect()->route('student.dashboard');
                }

                if ($user->role_id == 4) {
                    return redirect()->route('admin.dashboard');
                }

                return redirect('/');
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check the user's role and redirect accordingly
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard'); // Change to your admin route
            } elseif ($user->hasRole('editor')) {
                return redirect()->route('editor.dashboard'); // Change to your editor route
            } elseif ($user->hasRole('user')) {
                return redirect()->route('user.dashboard'); // Change to your user route
            }
        }

        return $next($request);
    }
}
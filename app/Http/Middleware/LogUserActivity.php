<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        // if (auth()) {
        //     // Get the current URL
        //     $currentUrl = $request->fullUrl();

        //     // Log the URL in the session
        //     $visitedPages = session()->get('visited_pages', []);
        //     $visitedPages[] = $currentUrl; // Add the current URL to the array
        //     session(['visited_pages' => $visitedPages]); // Store the updated array
        // }

          if (Auth::check()) {
            // Update or initialize the payload in the session
            $payload = session('payload', []);
            $payload['last_page_visited'] = $request->fullUrl(); // Store the last visited page
            session(['payload' => $payload]);
        }

        return $next($request);
    }
}

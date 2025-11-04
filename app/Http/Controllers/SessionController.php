<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;use App\Models\Session;use Illuminate\Support\Carbon;
class SessionController extends Controller
{
        protected function createAgent($session)
    {
        // Implement your logic to create user agent info
        return $session->user_agent; // Example return
    }
  public function index()
    {
  $visitedPages1 = Session::orderBy('last_activity', 'desc')
            ->paginate(10)
            ->map(function ($session) {
                $encodedPayload = $session->payload;
                $token = null;
                $previousUrl = null;
                $unserialized = null;

                if ($encodedPayload) {
                    // Step 1: Base64 decode
                    $decoded = base64_decode($encodedPayload);

                    // Step 2: Unserialize the data
                    $unserialized = unserialize($decoded);

                    // Access the token or previous URL
                    $token = $unserialized['token'] ?? null;
                    $previousUrl = $unserialized['_previous']['url'] ?? null;
                }
$userName = User::find($session->user_id)->name ?? null;
                return (object) [
                    'agent' => $this->createAgent($session),
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $session->id === request()->session()->getId(),
                    'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    'token' => $token,
                    'user' => $userName,
                    'previous_url' => $previousUrl,
                    'unserialized' => $unserialized,
                ];
            });
        return response()->json(
            [
               'visitedPages' => $visitedPages1,
            ]
        );
          
    } 
}

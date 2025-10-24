<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\WorkDay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getMacAddress()
    {
        // Determine the operating system
        $os = PHP_OS_FAMILY;

        // Initialize the command variable
        $command = '';

        // Define the command based on the OS
        switch ($os) {
            case 'Linux':
            case 'Darwin': // macOS
                $command = 'ifconfig'; // or 'ip a' if preferred
                break;

            case 'Windows':
                $command = 'ipconfig /all'; // or 'ipconfig /all'
                break;

            default:
                return response()->json(['error' => 'Unsupported OS'], 400);
        }

        // Execute the command
        $output = shell_exec($command);

        // Parse the output to find MAC addresses
        return $this->extractMacAddresses($output, $os);
    }

    private function extractMacAddresses($output, $os)
    {
        $macAddresses = [];

        if ($os === 'Linux' || $os === 'Darwin') {
            // Regular expression for Linux/macOS
            preg_match_all('/([0-9a-f]{2}[:-]){5}([0-9a-f]{2})/i', $output, $matches);
            $macAddresses = array_unique($matches[0]);
        } elseif ($os === 'Windows') {
            // For Windows, parse the output from getmac or ipconfig
     $lines = explode("\n", $output);
    $activeNetworks = [];
    $currentAdapter = '';
    $macAddress = '';
    $ipv4Address = '';

    foreach ($lines as $line) {
        // Trim the line for easier processing
        $line = trim($line);

        // Check for adapter names (those ending with a colon)
        if (preg_match('/^(.*?adapter.*?):$/i', $line, $matches)) {
            $currentAdapter = trim($matches[1]);
            $macAddress = ''; // Reset MAC address for new adapter
            $ipv4Address = ''; // Reset IPv4 address for new adapter
        }

        // Check for MAC address lines
        if (preg_match('/Physical Address[.\s]+:\s*([0-9A-F-]+)/i', $line, $matches)) {
            $macAddress = trim($matches[1]);
        }

        // Check for IPv4 Address line
        if (preg_match('/IPv4 Address[.\s]+:\s*([0-9.]+)/i', $line, $matches)) {
            $ipv4Address = trim($matches[1]);
        }

        // If both MAC and IPv4 addresses are found, add to results
        if (!empty($macAddress) && !empty($ipv4Address)) {
            $activeNetworks[] = [
                'name' => $currentAdapter,
                'mac_address' => $macAddress,
                'ipv4_address' => $ipv4Address,
            ];
            // Reset for the next adapter
            $currentAdapter = '';
            $macAddress = '';
            $ipv4Address = '';
        }
    }

}
        return $activeNetworks;
    }

    public function index(Request $request)
    {
        // Get the MAC address
        $macAddresses = $this->getMacAddress();

        // Get the user's IP address
        $ipAddress = $request->ip();

        // Retrieve the existing payload from the session
        $encodedPayload = session('payload');

        // Initialize the payload if it doesn't exist
        $payload = $encodedPayload ? unserialize(base64_decode($encodedPayload)) : [];

        // Add the current IP address to the payload
        $payload['current_ip'] = $ipAddress;

        // Encode and serialize the updated payload
        $encoded = base64_encode(serialize($payload));

        // Store the updated payload back in the session
        session(['payload' => $encoded]);

        // Get the current user's sessions
        $visitedPages = DB::connection(config('session.connection'))
            ->table(config('session.table', 'sessions'))
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->orderBy('last_activity', 'desc')
            ->get()
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

                return (object) [
                    'agent' => $this->createAgent($session),
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $session->id === request()->session()->getId(),
                    'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    'token' => $token,
                    'previous_url' => $previousUrl,
                    'unserialized' => $unserialized,
                ];
            });

        // Fetch all work schedules
        $workSchedules = WorkDay::all()->map(function ($workSchedule) {
            return [
                'id' => $workSchedule->id,
                'data' => json_decode($workSchedule->data),
                // Add other attributes as needed
            ];
        });

        return Inertia::render('Settings', [
            'visitedPages' => $visitedPages,
            'workSchedules' => $workSchedules,
            'current_ip' => $ipAddress,
            'mac_address' => $macAddresses, // Use the MAC addresses here
            'PHP_OS_FAMILY;' => PHP_OS_FAMILY,
        ]);
    }

    // Method to create agent information from session data
    protected function createAgent($session)
    {
        // Implement your logic to create user agent info
        return $session->user_agent; // Example return
    }
}
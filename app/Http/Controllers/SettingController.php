<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\WorkDay;
use Request;
use Inertia\Inertia; 

class SettingController extends Controller
{
    public function index()
    {
        
 $workSchedules = WorkDay::all(); // Fetch all work schedules
$data = $workSchedules->map(function($workSchedule) {
    return [
        'id' => $workSchedule->id,
        'data' =>  json_decode($workSchedule->data), 
        // Add other attributes as needed
    ];
});

// Accessing the data property
$data = $workSchedules->toArray();

        return Inertia::render('Settings' );
        
    }
}

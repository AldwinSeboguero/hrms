<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Position;
use App\Models\WorkDay;

class WorkDayController extends Controller
{public function index()
{
    $search = Request::input("search");

    $workSchedules = WorkDay::orderByDesc('updated_at')
        ->when($search, function($query) use ($search) { 
            $query->where('data', 'LIKE', '%' . $search . '%');
        })
        ->paginate(10); // Fetch paginated work schedules

    $data = $workSchedules->map(function($workSchedule) {
        return [
            'id' => $workSchedule->id,
            'data' => json_decode($workSchedule->data),
            // Add other attributes as needed
        ];
    });

    return response()->json([
        'work_days' => $data,
        'pagination' => $workSchedules,
    ]);
}
    public function store()
    {
        
  Position::updateOrCreate(
        ['id' => Request::input('data.id') ], // Attributes to match
        Request::input('data') // Attributes to update or create
        );
        return response()->json(
            [
                
                'work_days'=>WorkDay::orderByDesc('updated_at')
                ->paginate(10),
            ]
        );
          
    } 
}

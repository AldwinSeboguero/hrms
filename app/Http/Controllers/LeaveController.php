<?php

namespace App\Http\Controllers;

use Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Holiday;
use App\Models\Division;
use Carbon\Carbon;
use DB;
use App\Models\EmployeeLeave;

class LeaveController extends Controller
{
    public function index()
    {
        $offices = Division::get();

        // Create a blank object
        $blankOffice = new \stdClass();
        $blankOffice->id = null; // or any other default values
        $blankOffice->name = 'All Offices'; // Ensure any required fields are present
    
        // Prepend the blank object to the collection
        $offices->prepend($blankOffice);

        return Inertia::render('Leave/Index', [
            'filters' =>  Request::only(['search','employee_id','selectedOffice']),
            'offices' => $offices,

            'table_data' => EmployeeLeave::query() 
            ->paginate(10)
            ->withQueryString()
            ->through(fn($leave) => [
                'id' => $leave->id,
                'employee' => $leave->employee->last_name.", ".$leave->employee->first_name.' '.$leave->employee->middle_name, 
                'type' => $leave->leavetype->name,
                'status' => $leave->leavestatus->name,
                'description' => $leave->description,
                'date_commenced' => $leave->date_commenced,
                'date_completed' => $leave->date_completed,
                'duration' => $leave->duration,
                'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y') ,
                'when' => Carbon::parse($leave->created_at)->diffForHumans(),





            ]),
          
            ]);
        
    }
    public function request()
    {
        $offices = Division::get();

        // Create a blank object
        $blankOffice = new \stdClass();
        $blankOffice->id = null; // or any other default values
        $blankOffice->name = 'All Offices'; // Ensure any required fields are present
    
        // Prepend the blank object to the collection
        $offices->prepend($blankOffice);

        return Inertia::render('Leave/Request', [
            'filters' =>  Request::only(['search','employee_id','selectedOffice']),
            'offices' => $offices,

            'table_data' => EmployeeLeave::query() 
            ->paginate(10)
            ->withQueryString()
            ->through(fn($leave) => [
                'id' => $leave->id,
                'employee' => $leave->employee->last_name.", ".$leave->employee->first_name.' '.$leave->employee->middle_name, 
                'type' => $leave->leavetype->name,
                'status' => $leave->leavestatus->name,
                'description' => $leave->description,
                'date_commenced' => $leave->date_commenced,
                'date_completed' => $leave->date_completed,
                'duration' => $leave->duration,
                'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y') ,
                'when' => Carbon::parse($leave->created_at)->diffForHumans(),





            ]),
          
            ]);
        
    }
}

<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

use Request;
use Inertia\Inertia;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function index()
    {
        $employee = Employee::where('email_address', Auth::user()->email)->first();
       $employmentDuration = null;

    if ($employee && $employee->start_date) {
        // Calculate the employment duration
        $currentDate = now();
        $diff = $currentDate->diff($employee->start_date);

        // Ensure the start date is not in the future
        if ($currentDate >= $employee->start_date) {
            $years = $diff->y;
            $months = $diff->m;
            $days = $diff->d;

            $employmentDuration = "{$years} year" . ($years != 1 ? 's' : '') .
                                  ($months > 0 ? " {$months} month" . ($months != 1 ? 's' : '') : '') .
                                  ($days > 0 ? " {$days} day" . ($days != 1 ? 's' : '') : '');
        } else {
            $employmentDuration = "Start date is in the future"; // Optional message
        }
    } else {
        $employmentDuration = "Start date not available"; // Message if no start date
    }

           return Inertia::render('Employee/Profile', [
            'filters' =>  Request::only(['search','selectedOffice','selectedPosition','selectedStatus']),
            'employee' => $employee ? [
                        'id' => $employee->id,
                        'employee_code' => $employee->employee_code,
                        'first_name' => $employee->first_name,
                        'last_name' => $employee->last_name,
                        'middle_name' => $employee->middle_name,
                        'full_name' => trim("{$employee->first_name} {$employee->middle_name} {$employee->last_name} {$employee->suffix}"),
                        'suffix_name' => $employee->suffix,
                        'preferred_name' => $employee->preferred_name,
                        'salutation' => $employee->salutation, 

                        'start_date' => $employee->start_date->format('m/d/Y') ,
'employment_duration' => $employmentDuration, // Add the employment duration here

                        'employment_status_id' => $employee->employment_status_id,
                        'employment_status' => $employee->employeeStatus?$employee->employeeStatus->name:null,

                        'employee_type_id' => $employee->employee_type_id,
                        'employee_type' => $employee->employeeType?$employee->employeeType->name:null,

                        'position_id' => $employee->position_id,
                        'position' => $employee->position?$employee->position->name:null,
                        'division' => $employee->division?$employee->division->name:null,
                        'location' =>  $employee->campus?$employee->campus->name : null,


                        'location_id' => $employee->location_id,
                        'department_id' => $employee->department_id,
                        'division_id' => $employee->division_id,
                        'work_day_id' => $employee->work_day_id     , 
                        'age' => $employee->age,
        
                        'gender' => $employee->gender,
                        'email_address' => $employee->email_address,
                        
                        'date_of_birth' => $employee->date_of_birth ? $employee->date_of_birth->format('M d, Y') : '',
                    ] : null, // Return null if no employee is found
           ]);
    }
}

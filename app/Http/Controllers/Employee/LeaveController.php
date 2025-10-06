<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Request;
 
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Holiday;
use App\Models\Division;
use Carbon\Carbon;
use DB;
use App\Models\EmployeeLeave;
use App\Models\LeaveStatus;
use App\Models\LeaveType;
use App\Models\PerType;
class LeaveController extends Controller
{
      public function index()
    {
        $offices = Division::get();

        // Create a blank object
        $blankOffice = new \stdClass();
        $blankOffice->id = null; // or any other default values
        $blankOffice->name = 'All Offices'; // Ensure any required fields are present
    $employee = Employee::where('email_address', auth()->user()->email)->first();
        // Prepend the blank object to the collection
        $offices->prepend($blankOffice);
           return Inertia::render('Employee/Leaves', [
            'filters' =>  Request::only(['search','employee_id','selectedOffice']),
            'offices' => $offices,
                'leave_types' => LeaveType::get(),
                'per_types' => PerType::get(), 
            'leave_statuses' => LeaveStatus::get(),
            'leave_data' => EmployeeLeave::query()
    ->where('employee_id', $employee->id) 
    ->orderBy('leave_status_id')
    ->orderBy('updated_at', 'desc')  // Order by updated_at in descending order
    ->paginate(10)
    ->withQueryString()
    ->through(fn($leave) => [
        'id' => $leave->id,
        'employee' => $leave->employee->last_name . ", " . $leave->employee->first_name . ' ' . $leave->employee->middle_name, 
        'employee_id' => $leave->employee_id,
        'type' => $leave->leavetype->name,
        'type_id' => $leave->leavetype->id,
        'status_id' => $leave->leavestatus->id,
        'days_with_pay' => $leave->days_with_pay,
        'days_without_pay' => $leave->days_without_pay,
        'position' => $leave->position,
        'salary' => $leave->salary,
        'status' => $leave->leavestatus->name,
        'description' => $leave->description,
        'date_commenced' => $leave->date_commenced,
        'date_completed' => $leave->date_completed,
        'duration' => $leave->duration,
        'credit_to' => $leave->credit_to,
        'vearned' => $leave->vearned,
        'searned' => $leave->searned,
        'sless' => $leave->sless,
        'vless' => $leave->vless,
        'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y'),
        'when' => Carbon::parse($leave->created_at)->diffForHumans(),
    ]),
       'employee' => $employee,
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
                'days_with_pay' => $leave->days_with_pay,
                'days_without_pay' => $leave->days_without_pay,
                'position' => $leave->position,
                'salary' => $leave->salary,
                'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y') ,
                'when' => Carbon::parse($leave->created_at)->diffForHumans(),
'type_id' => $leave->leavetype->id,
                            'status_id' => $leave->leavestatus->id,

    'credit_to' => $leave->credit_to,
                'vearned' => $leave->vearned,
                'searned' => $leave->searned,
                'sless' => $leave->sless,
                'vless' => $leave->vless,


            ]),
          
           ]);
    }
}

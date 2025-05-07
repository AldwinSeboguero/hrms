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
                'days_with_pay' => $leave->days_with_pay,
                'days_without_pay' => $leave->days_without_pay,
                'position' => $leave->position,
                'salary' => $leave->salary,
                'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y') ,
                'when' => Carbon::parse($leave->created_at)->diffForHumans(),





            ]),
          
            ]);
        
    }
    public function saveLeave(){
        EmployeeLeave::updateOrCreate(
            ['id' => Request::input('employeePositionData.id'),'employee_id' => Request::input('employeePositionData.employee_id')], // Attributes to match
            Request::input('employeePositionData') // Attributes to update or create
            );

            return response()->json([
                'employee_position_salaries' => EmployeeLeave::query()
                ->where('employee_id', Request::input('employeePositionData.employee_id')) 
                ->paginate(10)
                ->withQueryString()
                ->through(fn($leave) => [
                    'id' => $leave->id,
                    'employee' => $leave->employee->last_name.", ".$leave->employee->first_name.' '.$leave->employee->middle_name, 
                    'type' => $leave->leavetype->name,
                    'type_id' => $leave->leavetype->id,
                    'status_id' => $leave->leavestatus->id,
                    'employee_id'=>$leave->employee_id,

                    'status' => $leave->leavestatus->name,
                    'description' => $leave->description,
                    'date_commenced' => $leave->date_commenced,
                    'date_completed' => $leave->date_completed, 
                    'duration' => $leave->duration,
                    
                'days_with_pay' => $leave->days_with_pay,
                'days_without_pay' => $leave->days_without_pay,
                'position' => $leave->position,
                'salary' => $leave->salary,
                'credit_to' => $leave->credit_to,
                'vearned' => $leave->vearned,
                'searned' => $leave->searned,
                'sless' => $leave->sless,
                'vless' => $leave->vless,


                    'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y') ,
                    'when' => Carbon::parse($leave->created_at)->diffForHumans(),





                ]),
            ]);
    }
    public function statLeave(){
        $employee = Employee::find(Request::input('employee_id')); 
;            return response()->json([
                
                'total_leave_request'=> $employee->totalLeaves,
                'total_vless'=>EmployeeLeave::where('credit_to', 'Vacation Leave')->where('employee_id', $employee->id)
                ->sum('vless'),
                'total_sless'=>EmployeeLeave::where('credit_to', 'Sick Leave')->where('employee_id', $employee->id)
                ->sum('sless'),
            ]);
    }

    public function deleteLeave(Request $request){
        // Validate the incoming request
    
    
        // Find the leave using the provided ID and delete it
        $leave = EmployeeLeave::find(Request::input('employeePositionData.id'));
    
        if ($leave) {
            $leave->delete();
    
            return response()->json([
                'message' => 'Leave record deleted successfully.',
                'employee_position_salaries' => EmployeeLeave::query()
                    ->where('employee_id', $leave->employee_id)
                    ->paginate(10)
                    ->withQueryString()
                    ->through(fn($leave) => [
                        'id' => $leave->id,
                        'employee' => $leave->employee->last_name.", ".$leave->employee->first_name.' '.$leave->employee->middle_name, 
                        'type' => $leave->leavetype->name,
                        'type_id' => $leave->leavetype->id,
                        'status_id' => $leave->leavestatus->id,
                        'employee_id' => $leave->employee_id,
                        'status' => $leave->leavestatus->name,
                        'description' => $leave->description,
                        'date_commenced' => $leave->date_commenced,
                        'date_completed' => $leave->date_completed, 
                        'duration' => $leave->duration,
                        'days_with_pay' => $leave->days_with_pay,
                        'days_without_pay' => $leave->days_without_pay,
                        'position' => $leave->position,
                        'salary' => $leave->salary,

                        'credit_to' => $leave->credit_to,
                        'vearned' => $leave->vearned,
                        'searned' => $leave->searned,
                        'sless' => $leave->sless,
                        'vless' => $leave->vless,
                        'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y'),
                        'when' => Carbon::parse($leave->created_at)->diffForHumans(),
                    ]),
            ]);
        }
    
        // If the leave is not found
        return response()->json(['message' => 'Leave record not found.'], 404);
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
                'days_with_pay' => $leave->days_with_pay,
                'days_without_pay' => $leave->days_without_pay,
                'position' => $leave->position,
                'salary' => $leave->salary,
                
                'credit_to' => $leave->credit_to,
                'vearned' => $leave->vearned,
                'searned' => $leave->searned,
                'sless' => $leave->sless,
                'vless' => $leave->vless,
                'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y') ,
                'when' => Carbon::parse($leave->created_at)->diffForHumans(),





            ]),
          
            ]);
        
    }
}

<?php

namespace App\Http\Controllers;

use Request;
use Inertia\Inertia;
use App\Models\Employee;
use Carbon\Carbon;
use App\Models\EmployeeType;
use App\Models\EmploymentStatus;

use App\Models\Position;
use App\Models\Division;
use App\Models\Department;
use App\Models\Location;

use App\Models\WorkDay;
use App\Models\EmployeePositionSalary;
use App\Models\PerType;
use App\Models\EmployeeLeave;
use App\Models\LeaveType;
use App\Models\LeaveStatus;
use App\Models\EmployeeAsset;






use Illuminate\Http\Request as Request1;

use DB;


class EmployeeController extends Controller
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

        $positions = Position::get();

        // Create a blank object
        $blankPosition = new \stdClass();
        $blankPosition->id = null; // or any other default values
        $blankPosition->name = 'All'; // Ensure any required fields are present
    
        // Prepend the blank object to the collection
        $positions->prepend($blankPosition);

        $statuses = EmployeeType::get();

        // Create a blank object
        $blankStatus = new \stdClass();
        $blankStatus->id = null; // or any other default values
        $blankStatus->name = 'All'; // Ensure any required fields are present
    
        // Prepend the blank object to the collection
        $statuses->prepend($blankStatus);

        return Inertia::render('Employees', [
            'filters' =>  Request::only(['search','selectedOffice','selectedPosition','selectedStatus']),
            'offices' => $offices,
            'positions' => $positions,
            'statuses' => $statuses, 
            'table_data' => Employee::query()
            ->when(Request::input('selectedOffice'), function($inner, $search) {
                $inner->where('division_id',$search);
            })
            ->when(Request::input('selectedPosition'), function($inner, $search) {
                $inner->where('position_id',$search);
            })
            ->when(Request::input('selectedStatus'), function($inner, $search) {
                $inner->where('employee_type_id',$search);
            })
            ->when(Request::input('search'), function($inner, $search) {
                $inner->where(DB::raw("TRIM(CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')))"), 'LIKE', "%" . $search . "%");
            })->orderBy('last_name')
            ->paginate(10)
            ->withQueryString()
            ->through(fn($employee) => [
                'id' => $employee->id,
                'employee_code' => $employee->employee_code,
                'first_name' => $employee->first_name, 
                'last_name' => $employee->last_name, 
                'middle_name' => $employee->middle_name, 
                'position' => $employee->position->name, 
                'sg' => $employee->position->sg, 
                // 'salary' => $employee->position->sg, 


                'division' => $employee->division->name, 
                'status' => $employee->employeeType->name, 
                'age' => $employee->age,
                'gender' => $employee->gender, 


                'birthday' => $employee->date_of_birth ?  $employee->date_of_birth->format('M d, Y ') : '', 



            ]),
            ]);
          //  'create_url' => route('users.create'),
        
    }

    public function savePosition(){
        EmployeePositionSalary::updateOrCreate(
            ['id' => Request::input('employeePositionData.id'),'employee_id' => Request::input('employeePositionData.employee_id')], // Attributes to match
            Request::input('employeePositionData') // Attributes to update or create
            );

            return response()->json([
                'employee_position_salaries' => EmployeePositionSalary::orderByDesc('date_commenced')->where('employee_id',Request::input('employeePositionData.employee_id'))->get()->map(function ($position) {
                    return [
                        'id' => $position->id,
                        'employee_id' => $position->employee_id ? $position->employee_id : '', 
                        'position_id' => $position->position->id ? $position->position->id : '', 
                        'position' => $position->position->name ? $position->position->name : '', 
                        'date_commenced' => $position->date_commenced ? $position->date_commenced :'', 
                        'is_current' => $position->iscurrent ? $position->iscurrent :'', 
                        'per_type_id' => $position->per_type_id ? $position->per_type_id :'', 
    
    
                        'date_completed' => $position->date_completed  ? $position->date_completed : '', 
                        'salary_grade' => $position->position->sg ? $position->position->sg : '', 
                        'renumeration' => $position->remuneration ? $position->remuneration : '', 
                        'remarks' => $position->remarks ? $position->remarks : '', 
    
                         
                    ];
                }),
            ]);
    }
    public function saveProfile(){
        $employee = Employee::find(Request::input('Edata.id')); // Get the first employee or null
        Employee::updateOrCreate(
            ['id' => Request::input('Edata.id')], // Attributes to match
            Request::input('Edata') // Attributes to update or create
            );

            return response()->json([
                'employee' => $employee ? [
                    'id' => $employee->id,
                    'employee_code' => $employee->employee_code,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'middle_name' => $employee->middle_name,
                    'suffix_name' => $employee->suffix,
                    'preferred_name' => $employee->preferred_name,
                    'salutation' => $employee->salutation,
                    'start_date' => Carbon::parse($employee->start_date)->format('m/d/Y')  ,
    
    
                    'employment_status_id' => $employee->employment_status_id,
                    'employee_type_id' => $employee->employee_type_id,
                    'position_id' => $employee->position_id,
                    'location_id' => $employee->location_id,
                    'department_id' => $employee->department_id,
                    'division_id' => $employee->division_id,
                    'work_day_id' => $employee->work_day_id     ,
    
      
                    'gender' => $employee->gender,
                    'email' => $employee->email_address,
                    
                    'date_of_birth' => $employee->date_of_birth ? Carbon::parse($employee->date_of_birth)->format('m/d/Y') : '',
                ] : null, // Return null if no employee is found
            ]);
    }
    public function edit()
    {
        $employee = Employee::query()
            ->when(Request::input('employee'), function ($query, $search) {
                $query->where('id', $search);
            })
            ->first(); // Get the first employee or null
    
        return Inertia::render('Employee/Edit', [
            'statuses' => EmploymentStatus::get(),
            'employmentTypes' => EmployeeType::get(),
            'positions' => Position::get(),
            'locations' => Location::get(),
            'departments' => Department::get(),
            'divisions' => Division::get(),
            'work_days' => WorkDay::get(),
            'per_types' => PerType::get(),
            'leave_types' => LeaveType::get(),
            'leave_statuses' => LeaveStatus::get(),
             



            'employee_positions' => EmployeePositionSalary::orderByDesc('date_commenced')->where('employee_id',Request::input('employee'))->get()->map(function ($position) {
                return [
                    'id' => $position->id,
                    'employee_id' => $position->employee_id ? $position->employee_id : '', 
                    'position_id' => $position->position->id ? $position->position->id : '', 
                    'position' => $position->position->name ? $position->position->name : '', 
                    'date_commenced' => $position->date_commenced ? $position->date_commenced :'', 
                    'is_current' => $position->iscurrent ? $position->iscurrent :'', 
                    'per_type_id' => $position->per_type_id ? $position->per_type_id :'', 


                    'date_completed' => $position->date_completed  ? $position->date_completed : '', 
                    'salary_grade' => $position->position->sg ? $position->position->sg : '', 
                    'renumeration' => $position->remuneration ? $position->remuneration : '', 
                    'remarks' => $position->remarks ? $position->remarks : '', 

                     
                ];
            }),

                 'employee_assets' => EmployeeAsset::where('employee_id',Request::input('employee'))->get()->map(function ($asset) {
                return [
                    'id' => $asset->id,
                    'employee_id' => $asset->employee_id ? $asset->employee_id : '',  
                    'asset_type' => $asset->assetType ? $asset->assetType->name : '',  
                    'asset_status' => $asset->assetStatus ? $asset->assetStatus->name : '',  

                    'description' => $asset->description ? $asset->description : '', 
                    'asset_identifier' => $asset->asset_identifier ? $asset->asset_identifier : '', 
                    'serial_number' => $asset->serial_number ? $asset->serial_number : '', 
                    'date_released' => $asset->date_released ? $asset->date_released : '', 
                    'date_returned' => $asset->date_returned ? $asset->date_returned : '', 



                    'remarks' => $asset->remarks ? $asset->remarks : '', 

                     
                ];
            }),
            'leave_data' => EmployeeLeave::query()
                        ->where('employee_id', Request::input('employee')) 
                            ->orderBy('leave_status_id')
    ->orderBy('updated_at', 'desc')  // Order by updated_at in descending order
                        ->paginate(10)
                        ->withQueryString()
                        ->through(fn($leave) => [
                            'id' => $leave->id,
                            'employee' => $leave->employee->last_name.", ".$leave->employee->first_name.' '.$leave->employee->middle_name, 
                            'employee_id'=>$leave->employee_id,
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
                            'created_at' => Carbon::parse($leave->created_at)->format('d/m/Y') ,
                            'when' => Carbon::parse($leave->created_at)->diffForHumans(),





                        ]),

            'employee' => $employee ? [
                'id' => $employee->id,
                'employee_code' => $employee->employee_code,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'middle_name' => $employee->middle_name,
                'suffix_name' => $employee->suffix,
                'preferred_name' => $employee->preferred_name,
                'salutation' => $employee->salutation,
                'start_date' => $employee->start_date->format('m/d/Y') ,


                'employment_status_id' => $employee->employment_status_id,
                'employee_type_id' => $employee->employee_type_id,
                'position_id' => $employee->position_id,
                'position' => $employee->position->name,

                'location_id' => $employee->location_id,
                'department_id' => $employee->department_id,
                'division_id' => $employee->division_id,
                'work_day_id' => $employee->work_day_id     , 

  
                'gender' => $employee->gender,
                'email_address' => $employee->email_address,
                
                'date_of_birth' => $employee->date_of_birth ? $employee->date_of_birth->format('m/d/Y') : '',
            ] : null, // Return null if no employee is found
        ]);
    }
}

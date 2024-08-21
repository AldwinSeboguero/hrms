<?php

namespace App\Http\Controllers;

use Request;
use Inertia\Inertia;
use App\Models\Employee;


class EmployeeController extends Controller
{
    public function index()
    {
         

        return Inertia::render('Employees', [
            'filters' =>  Request::only(['search']),
            'table_data' => Employee::query()
            ->when(Request::input('search'), function($inner, $search){
                $inner->where('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('employee_code', 'LIKE', '%' . $search . '%');
               
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($employee) => [
                'id' => $employee->id,
                'employee_code' => $employee->employee_code,
                'first_name' => $employee->first_name, 
                'last_name' => $employee->last_name, 
                'middle_name' => $employee->middle_name, 
                'position' => $employee->position->name, 
                'division' => $employee->division->name, 
                'status' => $employee->employeeType->name, 

                'gender' => $employee->gender, 


                'birthday' => $employee->date_of_birth ?  $employee->date_of_birth->format('M d, Y ') : '', 



            ]),
            ]);
          //  'create_url' => route('users.create'),
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Request;
use DB;
class GetEmployeesController extends Controller
{
     public function index()
    {
        $search = Request::input("search");
        $paginations = Employee::orderByDesc('updated_at')  ->when(Request::input('search'), function($inner, $search) {
                $inner->where(DB::raw("TRIM(CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')))"), 'LIKE', "%" . $search . "%");
            })
                ->paginate(10);

                    $data = $paginations->map(function ($pagination) {
                          $nameParts = preg_split('/\s+/', $pagination->middle_name); // Split by spaces
        $initials = '';
        foreach ($nameParts as $part) {
            if (!empty($part)) {
                $initials .= strtoupper($part[0]); // Append the uppercase initial
            }
        }

                    return (object) [
                        'id' => $pagination->id,
                        'name' => strtoupper( $pagination->first_name .' '. $initials. ($initials ? '. ' : ''). $pagination->last_name ),
                        'code' => strtoupper($pagination->employee_code),
                        'position' => strtoupper($pagination->position->name),
                        'office' => strtoupper($pagination->division->name),




 
                    ];
                });
        return response()->json(
            [
                'data'=>$data,
                'pagination' => $paginations,
            ]
        );
          
    } 
}

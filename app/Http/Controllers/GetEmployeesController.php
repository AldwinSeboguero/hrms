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
                    return (object) [
                        'id' => $pagination->id,
                        'name' => strtoupper($pagination->last_name . ", " . $pagination->first_name . ' ' . $pagination->middle_name),
                        'code' => strtoupper($pagination->employee_code),


 
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

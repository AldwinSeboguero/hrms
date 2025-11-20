<?php

namespace App\Http\Controllers;

use App\Models\SummaryIpcr;
use Request;
use DB;
class SummaryRatingIPCRController extends Controller
{
     public function index()
    {
        $search = Request::input("search");
        $year = Request::input("year");

        
        $paginations = SummaryIpcr::orderByDesc('updated_at')->when($search, function($q,$search){ 
                        $q->whereHas('employee', function ($query) use ($search) {
                            $query->where(DB::raw("TRIM(CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')))"), 'LIKE', "%" . $search . "%");
                        });
                   
                })
                ->when($year, function($q,$year){ 
                        $q->where('year',  $year);
                   
                })
                ->where('type', 'ipcr')
                ->paginate(10);

                    $data = $paginations->map(function ($pagination) {
                    return (object) [
                        'id' => $pagination->id,
                        'name' => $pagination->employee->last_name.", ".$pagination->employee->first_name.' '.$pagination->employee->middle_name, 
                        'employee_id' => $pagination->employee_id,
                        'office' => $pagination->employee->division->name,

                        'year' => $pagination->year, 
                        'numerical_rating' => $pagination->numerical_rating, 
                        'adjectival_rating' => $pagination->adjectival_rating, 

                        'comment_and_recommendation' => $pagination->comment_and_recommendation, 

                        'type' => $pagination->type, 

 
                    ];
                });
        return response()->json(
            [
                'data'=>$data,
                'pagination' => $paginations,
            ]
        );
          
    } 
       public function store()
    {
        
$data = Request::input('data');

// Extract employee_id and year from the input
$employeeId = $data['employee_id'];
$currentYear = $data['year'];
$id = $data['id'];
// Find the existing record by employee_id
$existingRecord = SummaryIpcr::where('id',$id)->where('type','ipcr')->first();

if ($existingRecord) {
    // Check if the year matches
    
        // Update the existing record
        $existingRecord->update($data);
   
} else {
    // Create a new record if no existing record is found
    SummaryIpcr::create($data);
}

        $search = Request::input("search");
        $paginations = SummaryIpcr::orderByDesc('updated_at')->where('type', 'ipcr')
                ->paginate(10);

                    $data = $paginations->map(function ($pagination) {
                    return (object) [
                        'id' => $pagination->id,
                        'name' => $pagination->employee->last_name.", ".$pagination->employee->first_name.' '.$pagination->employee->middle_name, 
                        'office' => $pagination->employee->division->name,
                        'employee_id' => $pagination->employee_id,

                        'year' => $pagination->year, 
                        'numerical_rating' => $pagination->numerical_rating, 
                        'adjectival_rating' => $pagination->adjectival_rating, 

                        'comment_and_recommendation' => $pagination->comment_and_recommendation, 

                        'type' => $pagination->type, 

 
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

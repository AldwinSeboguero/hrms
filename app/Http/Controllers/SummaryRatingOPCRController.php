<?php

namespace App\Http\Controllers;

use App\Models\SummaryIpcr;
use Request;
use DB;
class SummaryRatingOPCRController extends Controller
{
     public function index()
    {
        $search = Request::input("search");
        
        $paginations = SummaryIpcr::orderByDesc('updated_at')->when($search, function($q,$search){ 
                        $q->whereHas('employee', function ($query) use ($search) {
                            $query->where(DB::raw("TRIM(CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')))"), 'LIKE', "%" . $search . "%");
                        });
                   
                })
                ->where('type', 'opcr')
                ->paginate(10);

                    $data = $paginations->map(function ($pagination) {
                    return (object) [
                        'id' => $pagination->id,
                        'name' => $pagination->employee->last_name.", ".$pagination->employee->first_name.' '.$pagination->employee->middle_name, 
                        'office' => $pagination->employee->division->name,

                        'year' => $pagination->year, 
                        'numerical_rating' => $pagination->numerical_rating, 
                        'adjectival_rating' => $pagination->adjectival_rating, 
                        'employee_id' => $pagination->employee_id,

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
$id = $data['id'];
// Find the existing record by employee_id
$existingRecord = SummaryIpcr::find($id);

if ($existingRecord) {
    // Check if the year matches
    
        // Update the existing record
        $existingRecord->update($data);
   
} else {
    // Create a new record if no existing record is found
    SummaryIpcr::create($data);
}


        $search = Request::input("search");
        $paginations = SummaryIpcr::orderByDesc('updated_at')  ->where('type', 'opcr')
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

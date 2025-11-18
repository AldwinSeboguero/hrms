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
        
SummaryIpcr::updateOrCreate(
    [
     
        'employee_id' => Request::input('data.employee_id'), // Additional condition
        'year' => Request::input('data.year') // Additional condition
    ],
    Request::input('data') // Attributes to update or create
);

        $search = Request::input("search");
        $paginations = SummaryIpcr::orderByDesc('updated_at')  ->where('type', 'opcr')
                ->paginate(10);

                    $data = $paginations->map(function ($pagination) {
                    return (object) [
                        'id' => $pagination->id,
                        'name' => $pagination->employee->last_name.", ".$pagination->employee->first_name.' '.$pagination->employee->middle_name, 
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
}

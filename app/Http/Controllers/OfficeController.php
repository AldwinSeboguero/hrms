<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Request;
use App\Models\Division;

class OfficeController extends Controller
{
    public function index()
    {
        $search = Request::input("search");
        $offices = Division::orderByDesc('updated_at')->when($search, function($q,$search){ 
                        $q->where('name',  'LIKE', '%' . $search . '%');
                   
                })
                ->paginate(10);

                    $data = $offices->map(function ($office) {
                    return (object) [
                        'id' => $office->id,
                        'name' => $office->name, 
                        'count' => Employee::where('division_id',$office->id)->paginate(10)->Total(),
 
                    ];
                });
        return response()->json(
            [
                'offices'=>$data,
                'paginations' => $offices,
            ]
        );
          
    } 
    public function store()
    {
        
  Division::updateOrCreate(
        ['id' => Request::input('data.id') ], // Attributes to match
        Request::input('data') // Attributes to update or create
        );
        $search = Request::input("search");
        $offices = Division::orderByDesc('updated_at')->when($search, function($q,$search){ 
                        $q->where('name',  'LIKE', '%' . $search . '%');
                   
                })
                ->paginate(10);

                    $data = $offices->map(function ($office) {
                    return (object) [
                        'id' => $office->id,
                        'name' => $office->name, 
                        'count' => Employee::where('division_id',$office->id)->paginate(10)->Total(),
 
                    ];
                });
        return response()->json(
            [
                'offices'=>$data,
                'paginations' => $offices,
            ]
        );
    } 
}

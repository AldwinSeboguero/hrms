<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Request;
use App\Models\Position;
class PositionController extends Controller
{
   public function index()
    {
        $search = Request::input("search");
        $positions = Position::orderByDesc('updated_at')->when($search, function($q,$search){ 
                        $q->where('name',  'LIKE', '%' . $search . '%');
                   
                })
                ->paginate(10);

                    $data = $positions->map(function ($position) {
                    return (object) [
                        'id' => $position->id,
                        'name' => $position->name,
                        'sg' => $position->sg,
                        'count' => Employee::where('position_id',$position->id)->paginate(10)->Total(),
 
                    ];
                });
        return response()->json(
            [
                'positions'=>$data,
                'paginations' => $positions,
            ]
        );
          
    } 
    public function store()
    {
        
  Position::updateOrCreate(
        ['id' => Request::input('data.id') ], // Attributes to match
        Request::input('data') // Attributes to update or create
        );
        return response()->json(
            [
                
                'positions'=>Position::orderByDesc('updated_at')
                ->paginate(10),
            ]
        );
          
    } 
}

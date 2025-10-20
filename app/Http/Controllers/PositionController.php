<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Position;
class PositionController extends Controller
{
   public function index()
    {
        $search = Request::input("search");
  
        return response()->json(
            [
                'positions'=>Position::orderByDesc('updated_at')->when($search, function($q,$search){ 
                        $q->where('name',  'LIKE', '%' . $search . '%');
                   
                })
                ->paginate(10),
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

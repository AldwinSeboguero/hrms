<?php

namespace App\Http\Controllers;

use App\Models\User;
use Request;

class UserController extends Controller
{
  public function index()
    {
        $search = Request::input("search");
    $users = User::orderBy('updated_at', 'desc')
                ->when($search, function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->paginate(10);

    $data = $users->map(function ($user) {
                    return (object) [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,

                        'roles' => $user->getRoleNames(),
                        'updated_at' => $user->updated_at,
                    ];
                });
        return response()->json(
            [
                 'pagination' => $users,
               'users' => $data,
                
            ]
        );
          
    } 
    public function store()
    {
        
  User::updateOrCreate(
        ['id' => Request::input('data.id') ], // Attributes to match
        Request::input('data') // Attributes to update or create
        );
        return response()->json(
            [
                
              'users' => User::orderBy('updated_at', 'desc') 
                ->paginate(10)
                ->map(function ($user) {
                    return (object) [
                        'id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                        'role' => $user->role ? $user->role->name : null, // Assuming role has a 'name' attribute
                        'updated_at' => $user->updated_at,
                    ];
                })
            ]
        );
          
    } 
}

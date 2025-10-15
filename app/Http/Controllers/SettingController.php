<?php

namespace App\Http\Controllers;

use Request;
use Inertia\Inertia;
class SettingController extends Controller
{
    public function index()
    {
        
 

        return Inertia::render('Settings', [
           
          
            ]);
        
    }
}

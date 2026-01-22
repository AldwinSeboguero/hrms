<?php

namespace App\Http\Controllers;
use Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Holiday;
use App\Models\Division;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use DB;

class ScannerController extends Controller
{
 public function index()
    {
        return Inertia::render('Event/Scanner/index',[
      
      
        

    ]);
          
    } 
}

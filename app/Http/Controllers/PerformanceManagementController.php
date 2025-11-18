<?php

namespace App\Http\Controllers;
use Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Holiday;
use App\Models\Division;
use Carbon\Carbon;
use DB;
use App\Models\EmployeeLeave;
use App\Models\LeaveType;
use App\Models\LeaveStatus;
use App\Models\SummaryIpcr;

class PerformanceManagementController extends Controller
{
   public function index()
    {
        $offices = Division::get();

        // Create a blank object
        $blankOffice = new \stdClass();
        $blankOffice->id = null; // or any other default values
        $blankOffice->name = 'All Offices'; // Ensure any required fields are present
    
        // Prepend the blank object to the collection
        $offices->prepend($blankOffice);
        

        return Inertia::render('PM/Index', [
            
                
            
             
            ]);
        
    }
    public function getStat(){
        return response()->json(
            [
                'totalIPCR' => SummaryIpcr::where('type', 'ipcr')->paginate(5)->total(),
                'totalOPCR' => SummaryIpcr::where('type', 'opcr')->paginate(5)->total(),
                'totalOutstanding' => SummaryIpcr::where('adjectival_rating', 'Outstanding')->paginate(5)->total(),
                'totalVerySatisfactory' => SummaryIpcr::where('adjectival_rating', 'Very Satisfactory')->paginate(5)->total(),
                'totalSatisfactory' => SummaryIpcr::where('adjectival_rating', 'Satisfactory')->paginate(5)->total(),
                'totalUnsatisfactory' => SummaryIpcr::where('adjectival_rating', 'Unsatisfactory')->paginate(5)->total(),
                'totalPoor' => SummaryIpcr::where('adjectival_rating', 'Poor')->paginate(5)->total(),


            ]
        );
    }
}

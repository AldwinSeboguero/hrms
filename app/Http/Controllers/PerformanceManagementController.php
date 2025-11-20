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
                'totalIPCROutstanding' => SummaryIpcr::where('adjectival_rating', 'Outstanding')->where('type','ipcr')->paginate(5)->total(),
                'totalIPCRVerySatisfactory' => SummaryIpcr::where('adjectival_rating', 'Very Satisfactory')->where('type','ipcr')->paginate(5)->total(),
                'totalIPCRSatisfactory' => SummaryIpcr::where('adjectival_rating', 'Satisfactory')->where('type','ipcr')->paginate(5)->total(),
                'totalIPCRUnsatisfactory' => SummaryIpcr::where('adjectival_rating', 'Unsatisfactory')->where('type','ipcr')->paginate(5)->total(),
                'totalIPCRPoor' => SummaryIpcr::where('adjectival_rating', 'Poor')->where('type','ipcr')->paginate(5)->total(),

                'totalOPCROutstanding' => SummaryIpcr::where('adjectival_rating', 'Outstanding')->where('type','opcr')->paginate(5)->total(),
                'totalOPCRVerySatisfactory' => SummaryIpcr::where('adjectival_rating', 'Very Satisfactory')->where('type','opcr')->paginate(5)->total(),
                'totalOPCRSatisfactory' => SummaryIpcr::where('adjectival_rating', 'Satisfactory')->where('type','opcr')->paginate(5)->total(),
                'totalOPCRUnsatisfactory' => SummaryIpcr::where('adjectival_rating', 'Unsatisfactory')->where('type','opcr')->paginate(5)->total(),
                'totalOPCRPoor' => SummaryIpcr::where('adjectival_rating', 'Poor')->where('type','opcr')->paginate(5)->total(),


            ]
        );
    }
}

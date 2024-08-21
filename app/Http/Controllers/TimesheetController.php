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
class TimesheetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Welcome!',
            'date' => date('m/d/Y')
        ];
        // $dtrDate = Request::input('dtrDate');
        $dtrDate = Request::input('dtrDate');
        $selectedMonth = Request::input('selectedMonth') ? Request::input('selectedMonth') : Carbon::now()->month; ;
        $selectedYear = Request::input('selectedYear') ? Request::input('selectedYear') : Carbon::now()->year;;

        $employee_id = Request::input('employee_id');
        

        $today = Carbon::now()->format('n/j/Y');
        $data =  Request::input('data');
        $employee = Employee::query()
        ->where('id', $employee_id)
        ->first(); // Fetch the first matching employee
    
        if ($employee) {
            $employeeData = [
                'id' => $employee->id,
                'employee_code' => $employee->employee_code,
                'gender' => $employee->gender,

                'name' => $employee->last_name . ", " . $employee->first_name . ' ' . $employee->middle_name,
                'position' => $employee->position->name,
                'division' => $employee->division->name,
                'status' => $employee->employeeType->name,
                'gender' => $employee->gender,
                'birthday' => $employee->date_of_birth ? $employee->date_of_birth->format('M d, Y') : '',
            ];
        } else {
            $employeeData = null; // Handle employee not found case
        }

        $currentMonth = $selectedMonth ? $selectedMonth: Carbon::now()->month;
        $currentYear =  $selectedYear ? $selectedYear:  Carbon::now()->year;
        // $currentMonth = '07';
        // $currentYear =  '2024';

        $startDate = Carbon::create($currentYear, $currentMonth, 1)->format('Y-m-d');
        $endDate = Carbon::create($currentYear, $currentMonth, 1)->endOfMonth()->format('Y-m-d');
        $endDate2 = Carbon::create($currentYear, $currentMonth, 1)->endOfMonth()->format('j');

        $regular_days = Carbon::create($currentYear, $currentMonth, 1)->diffInDaysFiltered(function (Carbon $date) {
            return $date->isWeekday();
        },  Carbon::create($currentYear, $currentMonth, 1)->endOfMonth());
        if($employee_id){
            
            $attendance =Timesheet::orderByDesc('transaction_date')->whereBetween('transaction_date',[$startDate,$endDate])->where('employee_id',$employee_id)
                                ->get()->map(
                                    function($inner){
                                        return [
                                            'id' => $inner->id,
                                            'loginam' => $inner->loginam,
                                            'logoutam' => $inner->logoutam,
                                            'loginpm' => $inner->loginpm,
                                            'logoutpm' => $inner->logoutpm,
                                            'transaction_date' => $inner->transaction_date,
                                            // 'bypass' => $inner->bypass,
                                            // 'bypass1' => $inner->bypass1,
                                            // 'bypass2' => $inner->bypass2,
                                            // 'bypass3' => $inner->bypass3,
                                            // 'remarks' => $inner->remarks,



                    
                                        ];                
                                    }
                                );
        }
        else{

            
            $attendance = null;
        }
        
        $days = [];
        for ($day = 1; $day <= $endDate2; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day);

            $amin = '';
            $amout = '';
            $pmin = '';
            $pmout = '';
            $bypass = '';
            $bypass1 = '';
            $bypass2 = '';
            $bypass3 = '';
            $remarks = '';

            if($attendance){
                $log = $attendance->firstWhere('transaction_date', $date->format('Y-m-d'));
                // dd($log);

                if ($log) {
                    $amin = $log['loginam'];
                    $amout = $log['logoutam'];
                    $pmin = $log['loginpm'];
                    $pmout = $log['logoutpm'];
                 
    
    
    
                    // dd($amin);
    
                }
             
                // dd($date->format('l'),);
                $days[] = [
                        'date' => $day,
                        'day' => $date->format('l'),
                        'amin' => $amin ? Carbon::createFromFormat('H:i:s', $amin)->format('h:i') : ($date->format('l') == 'Saturday' ? 'SAT' : ($date->format('l') == 'Sunday' ? 'SUN' : (Holiday::where('holidate',$date)->get()->first() ? 
                        (Holiday::where('holidate',$date)->get()->first()->holidayam ? 'HOL':'') :''))) ,
                        'amout' => $amout ? Carbon::createFromFormat('H:i:s', $amout)->format('h:i')  : ($date->format('l') == 'Saturday' ? 'SAT' : ($date->format('l') == 'Sunday' ? 'SUN' :(Holiday::where('holidate',$date)->get()->first() ? 
                        (Holiday::where('holidate',$date)->get()->first()->holidayam ? 'HOL':'') :''))) ,
                        'pmin' => $pmin ?Carbon::createFromFormat('H:i:s', $pmin)->format('h:i')  : ($date->format('l') == 'Saturday' ? 'SAT' : ($date->format('l') == 'Sunday' ? 'SUN' :(Holiday::where('holidate',$date)->get()->first() ? 
                        (Holiday::where('holidate',$date)->get()->first()->holidaypm ? 'HOL':'') :''))) ,
                        'pmout' => $pmout ? Carbon::createFromFormat('H:i:s', $pmout)->format('h:i')  : ($date->format('l') == 'Saturday' ? 'SAT' : ($date->format('l') == 'Sunday' ? 'SUN' :(Holiday::where('holidate',$date)->get()->first() ? 
                        (Holiday::where('holidate',$date)->get()->first()->holidaypm ? 'HOL':'') :''))) ,
                        // 'isHolidayAM' => Holiday::where('holidate',$date)->get()->first() ? Holiday::where('holidate',$date)->get()->first()->holidayam : '',
                        // 'isHolidayPM' => Holiday::where('holidate',$date)->get()->first() ? Holiday::where('holidate',$date)->get()->first()->holidaypm : '',
        
        
                    ];
                
            }
            
           
        }
        // dd($days);

        $month = $dtrDate ? Carbon::create($dtrDate)->format('F, Y'): Carbon::now()->format('F, Y');
        $offices = Division::get();

        // Create a blank object
        $blankOffice = new \stdClass();
        $blankOffice->id = null; // or any other default values
        $blankOffice->name = 'All Offices'; // Ensure any required fields are present
    
        // Prepend the blank object to the collection
        $offices->prepend($blankOffice);


        return Inertia::render('Timesheets', [
            'filters' =>  Request::only(['search','employee_id','selectedOffice']),
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'offices' => $offices,
            'years' => Timesheet::whereNotNull('created_at')->get()->pluck('created_at') // Get the collection of created_at dates
            ->map(function ($date) {
                return $date->format('Y'); // Format to 'Y' (year)
            })
            ->unique() // Get unique years
            ->sort() // Sort the years if needed
            ->values() // Reindex the array
            ->toArray(),
            'employee' => $employeeData,
            'at' => $attendance,
            'attendances' => Timesheet::orderByDesc('transaction_date')->whereBetween('transaction_date',['2024-07-01','2024-07-31'])->where('employee_id',128)->get(),
            'time_records' => $days,
            'table_data' => Employee::query()
            ->when(Request::input('selectedOffice'), function($inner, $search) {
                $inner->where('division_id',$search);
            })
            ->when(Request::input('search'), function($inner, $search) {
                $inner->where(DB::raw("TRIM(CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')))"), 'LIKE', "%" . $search . "%");
            })->orderBy('last_name')
            ->paginate(10)
            ->withQueryString()
            ->through(fn($employee) => [
                'id' => $employee->id,
                'employee_code' => $employee->employee_code,
                'name' => $employee->last_name.", ".$employee->first_name.' '.$employee->middle_name, 
                'position' => $employee->position->name, 
                'division' => $employee->division->name, 
                'status' => $employee->employeeType->name, 

                'gender' => $employee->gender, 


                'birthday' => $employee->date_of_birth ?  $employee->date_of_birth->format('M d, Y ') : '', 



            ]),
          
            ]);
          //  'create_url' => route('users.create'),
        
    }
}

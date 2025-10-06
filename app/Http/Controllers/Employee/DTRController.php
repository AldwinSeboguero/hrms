<?php

namespace App\Http\Controllers\Employee;

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
use App\Http\Controllers\Controller;
class DTRController extends Controller
{

      function convertToAM($timeString) {
        try {
            // Parse the time string into a Carbon instance
            $time = Carbon::createFromFormat('h:i A', $timeString);
            
            // Check if the hour is 12 PM and adjust to 12 AM
            if ($time->format('A') === 'PM' && $time->hour !== 12) {
                // Convert PM to AM by subtracting 12 hours
                $time->subHours(12);
            } elseif ($time->format('A') === 'AM' && $time->hour === 12) {
                // If it's 12 AM, set it to 0 hours
                $time->setHours(0);
            }
    
            // Return the time formatted as 12-hour AM format
            return $time->format('h:i A'); // Returns time in "hh:mm AM"
            
        } catch (\Exception $e) {
            // Handle any parsing errors
            return "Invalid time format"; // Or handle as needed
        }
    }
    
    function convertToPM($timeString) {
        try {
            // Parse the time string into a Carbon instance
            $time = Carbon::createFromFormat('h:i A', $timeString);
            
            // Check if the hour is in AM and adjust to PM
            if ($time->format('A') === 'AM') {
                // If it's not 12 AM, add 12 hours to convert to PM
                if ($time->hour !== 12) {
                    $time->addHours(12);
                }
            } elseif ($time->format('A') === 'PM' && $time->hour === 12) {
                // If it's 12 PM, keep it as is
                // No need to change anything
            }

            // Return the time formatted as 12-hour PM format
            return $time->format('h:i A'); // Returns time in "hh:mm PM"
            
        } catch (\Exception $e) {
            // Handle any parsing errors
            return "Invalid time format"; // Or handle as needed
        }
    }
      public function formatTardiness($totalHours) {
        $hours = floor($totalHours); // Get the whole number of hours
        $minutes = round(($totalHours - $hours) * 60); // Convert the fractional part to minutes
        
        // Create the formatted string
        return "{$hours}h {$minutes}m";
    }
   public function index()
    {
        $data = [
            'title' => 'Welcome!',
            'date' => date('m/d/Y')
        ];
        // $dtrDate = Request::input('dtrDate');
        $dtrDate = Carbon::now();
        $selectedMonth = Request::input('selectedMonth') ? Request::input('selectedMonth') : Carbon::now()->month; ;
        $selectedYear = Request::input('selectedYear') ? Request::input('selectedYear') : Carbon::now()->year;;

        $employee_id = Request::input('employee_id');
        

        $today = Carbon::now()->format('n/j/Y');
        $data =  Request::input('data');
        $timeSchedules = [
            'AM' => [
                'login' => '8:00 AM',
                'logout' => '12:00 PM',
            ],
            'PM' => [
                'login' => '01:00 PM',
                'logout' => '05:00 PM',
            ],
        ];
        $employee =  Employee::where('email_address', Auth::user()->email)->first();
        $workDays = $employee ? ($employee->workDays ? json_decode($employee->workDays->data,true)['Days'] : '') : '';

        $jsonData = $workDays;
        
        // Decode the JSON
        $data = $workDays;
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
        $employee_id = Employee::where('email_address', Auth::user()->email)->first();
        if($employee_id){
            
            $attendance = Timesheet::orderByDesc('transaction_date')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->whereHas('employee', function ($query) {
                    $query->where('email_address', Auth::user()->email);
                })
            ->get()
            ->map(function($inner) use($timeSchedules,$data) {

                $comparisonDate = $inner->transaction_date; // Example date
                $dayOfWeek = strtoupper(date('D', strtotime($comparisonDate))); // Get the day abbreviation (e.g., 'WED')
                // Check if the day exists in the decoded JSON data
                if (array_key_exists($dayOfWeek, $data)) {
                    $info = $data[$dayOfWeek];
                    //   dd($dayOfWeek $data[$dayOfWeek]);
                    
                    // Output the relevant information
                    // echo "Day: $dayOfWeek\n";
                    // echo "Hours: " . $info['hours'] . "\n";
                    // echo "Enabled: " . ($info['enabled'] ? 'Yes' : 'No') . "\n";
                    // echo "Time In (AM): " . $info['timeInAM'] . "\n";
                    // echo "Time Out (PM): " . $info['timeOutPM'] . "\n";
                //   dd(Carbon::createFromFormat('h:i', $info['timeInAM']));
          
            $timeSchedules = [
                'AM' => [
                    'login' => !empty($info['timeInAM']) ? Carbon::createFromFormat('h:i', $info['timeInAM']) : null,
                    'logout' => !empty($info['timeOutAM']) ? Carbon::createFromFormat('h:i', $info['timeOutAM']) : null,
                ],
                'PM' => [
                    'login' => !empty($info['timeInPM']) ? Carbon::createFromFormat('H:i', $info['timeInPM']) : null,
                    'logout' => !empty($info['timeOutPM']) ? Carbon::createFromFormat('H:i', $info['timeOutPM']) : null,
                ],
            ];
                    
                    
                } else {
                    echo "No data available for " . $dayOfWeek . ".\n";
                }



                $loginam = Carbon::parse($inner->loginam);
                $logoutam = Carbon::parse($inner->logoutam);
                $loginpm = Carbon::parse($inner->loginpm);
                $logoutpm = Carbon::parse($inner->logoutpm);
                $absent1 = 0.0;
                $undertime1 = 0.0;
                $tardiness1 = 0.0;

                // Define the expected login and logout times
              
                 
                $totalTardiness = 0; // Initialize total tardiness
                $actualLoginAm = Carbon::createFromFormat('h:i A', $this->convertToAM($loginam->format('h:i A')));
                $expectedLoginAm = $timeSchedules['AM']['login'] ?  $timeSchedules['AM']['login'] : Carbon::createFromFormat('h:i A','8:00 AM');

                $actualLoginPm = Carbon::createFromFormat('h:i A', $loginpm->format('h:i A'));
                $expectedLoginPm = $timeSchedules['PM']['login'] ?  $timeSchedules['PM']['login'] : Carbon::createFromFormat('h:i A','1:00 PM');

                $actualLogoutAm = Carbon::createFromFormat('h:i A', $logoutam->format('h:i A'));
                $expectedLogoutAm = $timeSchedules['AM']['logout'] ?  $timeSchedules['AM']['logout'] : Carbon::createFromFormat('h:i A','12:00 PM');

                $actualLogoutPm = Carbon::createFromFormat('h:i A', $this->convertToPM($logoutpm->format('h:i A')));
                $expectedLogoutPm = $timeSchedules['PM']['logout'] ?  $timeSchedules['PM']['logout'] : Carbon::createFromFormat('h:i A','5:00 PM');

                

                
    
                // Calculate the difference in minutes
    
        // Calculate AM tardiness

        if($inner->loginam || $inner->logoutam){
            if ($expectedLoginAm->diffInHours($actualLoginAm) > 0 && $inner->loginam ) {
               $totalTardiness += $expectedLoginAm->diffInHours($actualLoginAm);

    
            }
          
            if ($actualLogoutAm->diffInHours($expectedLogoutAm) > 0 && $inner->logoutam) {
                // Late for AM logout
                $totalTardiness += $actualLogoutAm->diffInHours($expectedLogoutAm);
    
            }
            if(!$inner->loginam && $inner->logoutam){
                // $totalTardiness += $expectedLoginAm->diffInHours($expectedLogoutAm);
            }
            if($inner->loginam && !$inner->logoutam){
                //  $totalTardiness += $expectedLoginAm->diffInHours($expectedLogoutAm);
            }
           
        }
        
       


   
        if($inner->loginpm || $inner->logoutpm){
               if ($expectedLoginPm->diffInHours($actualLoginPm) > 0 && $inner->loginpm) {
            // Late for AM logout
            $totalTardiness += $expectedLoginPm->diffInHours($actualLoginPm);

        }
    
                        if ($actualLogoutPm->diffInHours($expectedLogoutPm) > 0 && $inner->logoutpm) {
                // Late for AM logout
                $totalTardiness += $actualLogoutPm->diffInHours($expectedLogoutPm);

            }

            if(!$inner->loginpm && $inner->logoutpm){
            // $totalTardiness += $expectedLoginPm->diffInHours($expectedLogoutPm);
        }
        if($inner->loginpm && !$inner->logoutpm){
        // $totalUndertime += $expectedLoginPm->diffInHours($expectedLogoutPm);
    }
      
   
        }
      
     
     
    
  

        // // Calculate PM tardiness
        // if ($loginpm > Carbon::parse($timeSchedules['PM']['login'])) {
        //     // Late for PM login
        //     $totalTardiness += $loginpm->diffInMinutes(Carbon::parse($timeSchedules['PM']['login']));
        // }

        // if ($logoutpm > Carbon::parse($timeSchedules['PM']['logout'])) {
        //     // Late for PM logout
        //     $totalTardiness += $logoutpm->diffInMinutes(Carbon::parse($timeSchedules['PM']['logout']));
        // }
                // Return the attendance record with total tardiness
                return [
                    'id' => $inner->id,
                    'employee_id' => $inner->employee_id,
                    'loginam' => $inner->loginam,
                    'logoutam' => $inner->logoutam,
                    'loginpm' => $inner->loginpm,
                    'logoutpm' => $inner->logoutpm,
                    'transaction_date' => $inner->transaction_date,
                    'total_tardiness' =>  $this->formatTardiness($totalTardiness), // Add the total tardiness to the return data
                ];
            });
        }
        else{

            
            $attendance = null;
        }
        
        $days = [];
        for ($day = 1; $day <= $endDate2; $day++) {
            $date = Carbon::create($currentYear, $currentMonth, $day);

            $id = '';
            $employee_id = '';
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
                    $id = $log['id'];
                    $employee_id = $log['employee_id'];
                    $amin = $log['loginam'];
                    $amout = $log['logoutam'];
                    $pmin = $log['loginpm'];
                    $pmout = $log['logoutpm'];
                    $remarks = $log['total_tardiness'];
                 
    
    
    
                    // dd($amin);
    
                }
             
                // dd($date->format('l'),);
                $days[] = [
                        'id' => $id,
                        'employee_id' => $employee_id,
                        'transactionDate' => $date->format('M d, Y'),
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
                        'otin' => '',
                        'otout' => '',
                        'remarks' => $remarks ? $remarks : ($date->format('l') == 'Saturday' ? '' : ($date->format('l') == 'Sunday' ? '' : (Holiday::where('holidate',$date)->get()->first() ? 
                        (Holiday::where('holidate',$date)->get()->first()->holidayam ? '':'') : ($date->diffInMinutes(Carbon::now()) > 0 ? '' : '')))) ,
        
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


        return Inertia::render('Employee/Timesheets', [
            'filters' =>  Request::only(['search','employee_id','selectedOffice']),
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'offices' => $offices,
            // 'years' => Timesheet::whereNotNull('created_at')->get()->pluck('created_at') // Get the collection of created_at dates
            // ->map(function ($date) {
            //     return $date->format('Y'); // Format to 'Y' (year)
            // })
            // ->unique() // Get unique years
            // ->sort() // Sort the years if needed
            // ->values() // Reindex the array
            // ->toArray(),
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

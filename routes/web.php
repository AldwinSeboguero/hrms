<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SubmittedClearance;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\EmployeeDTRCOntroller;

use App\Http\Controllers\Employee\CalendarController;
use App\Http\Controllers\Employee\DirectoryController;
use App\Http\Controllers\Employee\DTRController;
use App\Http\Controllers\Employee\ExpenseController;
use App\Http\Controllers\Employee\FormController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\Employee\LibraryController;
use App\Http\Controllers\Employee\NewsController;
use App\Http\Controllers\Employee\OrgChartController;
use App\Http\Controllers\Employee\PerformanceController;
use App\Http\Controllers\Employee\ProfileController;
use App\Http\Controllers\Employee\HomeController;
use App\Http\Controllers\SettingController; 



use App\Http\Resources\SubmittedClearance as SubmittedClearanceResource;
use App\Http\Resources\SubmittedClearanceCollection;
use App\Models\SubmitClearance; 
use App\Models\Semester; 
use App\Http\Controllers\GoogleController;

use Illuminate\Http\Request; 
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\WorkDayController;

use App\Models\Employee;
use App\Models\Position;
use App\Models\Division;
use App\Models\Location;
use App\Models\WorkDay;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;


Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate-pdf');


Route::get('auth/google',[GoogleController::class, 'googlepage'])->name('google');
Route::get('auth/google/callback',[GoogleController::class, 'googlecallback']);
Route::get('/notregister', function () {
    return Inertia::render('NotRegister');
})->name('notregister');
Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::group(['middleware' => ['auth','role:admin']], function () { 
Route::get('/admin/dashboard', function () {

        $totalEmployees = Employee::count();
        $maleCount = Employee::where('gender', 'Male')->count();
        $femaleCount = Employee::where('gender', 'Female')->count();
    
        return Inertia::render('Dashboard', [
            'EmployeeCount' => $totalEmployees,
            'MaleCount' => $maleCount,
            'FemaleCount' => $femaleCount,
            'EmployementStat' => [
            Employee::where('employee_type_id', 5)->count(),
            Employee::where('employee_type_id', 6)->count(),
            Employee::where('employee_type_id', 1)->count(),
            Employee::where('employee_type_id', 3)->count(),
            Employee::where('employee_type_id', 2)->count(),
            Employee::where('employee_type_id', 4)->count(),
            ],
            'PositionStat' => Position::orderBy('name')->get()->map(
                                function($inner){
                                    return [
                                        'position' => $inner->name,
                                        'location' => Location::get()->map(
                                            function($inner1) use($inner){
                                                return [
                                                    'id' => $inner1->id,
                                                    'name' => $inner1->name,
                                                    'count' => Employee::where('position_id',$inner->id)->whereHas('division', function($query)use($inner1) {
                                                                            $query->where('location_id', $inner1->id);
                                                                        })
                                                        ->paginate()->total(),
                                                ];                
                                            }
                                        ),
                                        'count' => Employee::where('position_id',$inner->id)
                                                        ->paginate()->total(),
                
                                    ];                
                                }
                            ),
                            'Location' => Location::get(), 
        ]);
    })->name('admin.dashboard');

    
    Route::resource('employees', EmployeeController::class);
    Route::resource('timesheets', TimesheetController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('workdays', WorkDayController::class);




    Route::post('update-timesheet', [TimesheetController::class,'update'])->name('update.timesheet');

//Leaves Route
Route::get('leave/request', [LeaveController::class,'index'])->name('leave.request');
Route::get('leave/add/request', [LeaveController::class,'request'])->name('leave.add.request');
Route::post('save-position', [EmployeeController::class,'savePosition'])->name('employee.save.position');
Route::post('save-leave', [LeaveController::class,'saveLeave'])->name('employee.save.leave');
Route::post('stat-leave', [LeaveController::class,'statLeave'])->name('employee.stat.leave');

Route::post('delete-leave', [LeaveController::class,'deleteLeave'])->name('employee.delete.leave');
Route::post('save-profile', [EmployeeController::class,'saveProfile'])->name('employee.save.ptofile');


// Route::get('/admin/dashboard', [EmployeeDTRCOntroller::class, 'index'])->name('admin.dashboard');
Route::get('/editor/dashboard', [EmployeeDTRCOntroller::class, 'index'])->name('editor.dashboard');
  Route::get('employee/edit', [EmployeeController::class,'edit'])->name('employee.edit');



 
 });     
 Route::group(['middleware' => ['auth','role:user']], function () { 
     

Route::get('/user/dashboard', [DTRController::class, 'index'])->name('user.dtr');
Route::get('/user/dashboard', [HomeController::class, 'index'])->name('user.dashboard');

Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
Route::get('/user/directory', [DirectoryController::class, 'index'])->name('user.directory');
Route::get('/user/orgchart', [OrgChartController::class, 'index'])->name('user.orgchart');
Route::get('/user/calendar', [CalendarController::class, 'index'])->name('user.calendar');
Route::get('/user/dtr', [DTRController::class, 'index'])->name('user.dtr');
Route::get('/user/leave', [EmployeeLeaveController::class, 'index'])->name('user.leave');
Route::get('/user/performances', [PerformanceController::class, 'index'])->name('user.performances');
Route::get('/user/expenses', [ExpenseController::class, 'index'])->name('user.expenses');
Route::get('/user/forms', [FormController::class, 'index'])->name('user.forms');
Route::get('/user/library', [LibraryController::class, 'index'])->name('user.library');
Route::get('/user/news', [NewsController::class, 'index'])->name('user.news'); 

 
 });    

// ,'role:admin'
Route::group(['middleware' => ['auth','redirect.role']], function () { 
    
    Route::get('/dashboard', function () {})->name('dashboard');
 });

    // Route::get('/dashboard', function () {

    //     $totalEmployees = Employee::count();
    //     $maleCount = Employee::where('gender', 'Male')->count();
    //     $femaleCount = Employee::where('gender', 'Female')->count();
    
    //     return Inertia::render('Dashboard', [
    //         'EmployeeCount' => $totalEmployees,
    //         'MaleCount' => $maleCount,
    //         'FemaleCount' => $femaleCount,
    //         'EmployementStat' => [
    //         Employee::where('employee_type_id', 5)->count(),
    //         Employee::where('employee_type_id', 6)->count(),
    //         Employee::where('employee_type_id', 1)->count(),
    //         Employee::where('employee_type_id', 3)->count(),
    //         Employee::where('employee_type_id', 2)->count(),
    //         Employee::where('employee_type_id', 4)->count(),
    //         ],
    //         'PositionStat' => Position::orderBy('name')->get()->map(
    //                             function($inner){
    //                                 return [
    //                                     'position' => $inner->name,
    //                                     'location' => Location::get()->map(
    //                                         function($inner1) use($inner){
    //                                             return [
    //                                                 'id' => $inner1->id,
    //                                                 'name' => $inner1->name,
    //                                                 'count' => Employee::where('position_id',$inner->id)->whereHas('division', function($query)use($inner1) {
    //                                                                         $query->where('location_id', $inner1->id);
    //                                                                     })
    //                                                     ->paginate()->total(),
    //                                             ];                
    //                                         }
    //                                     ),
    //                                     'count' => Employee::where('position_id',$inner->id)
    //                                                     ->paginate()->total(),
                
    //                                 ];                
    //                             }
    //                         ),
    //                         'Location' => Location::get(), 
    //     ]);
    // })->name('dashboard');

    // Route::resource('employeeTimesheets', EmployeeDTRCOntroller::class);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('submittedclearances', SubmittedClearance::class);
    Route::get('semesters', [SemesterController::class,'index']);
   




    Route::get('/clearances', function (Request $request){
        $per_page =$request->per_page ? $request->per_page : 10; 
        $semester = $request->semester;
        $search = $request->search;

        $semester_id = $request->semester_id;
        $user_id = $request->user_id;
        return Inertia::render('Clearances',[
            'table_data' => new SubmittedClearanceCollection(
                SubmitClearance::orderByDesc('updated_at')
                ->when($semester , function($q) use($semester){
                    $q->whereHas('clearance.purpose', function($q) use($semester){
                        $q->where('semester_id', $semester);
                    });
                })
                ->when($request->search, function($inner) use($request){
                    $inner->whereHas('clearance.student', function($q) use ($request){
                        $q->where('name', 'ILIKE', '%' . $request->search . '%')
                        ->orWhere('student_number', 'ILIKE', '%' . $request->search . '%');
                    });
                })
                ->when($request->college, function($inner) use($request){
                    $inner->whereHas('clearance.student.program',function($q) use($request){
                        $q->where('college_id',$request->college);
                    });
                }) 
                ->when($request->program, function($inner) use($request){
                    $inner->whereHas('clearance.student',function($q) use($request){
                        $q->where('program_id',$request->program);
                    });
                }) 
                ->paginate($per_page))

        ]);
    });

  
});


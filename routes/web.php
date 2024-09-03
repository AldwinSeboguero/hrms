<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SubmittedClearance;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TimesheetController;




use App\Http\Resources\SubmittedClearance as SubmittedClearanceResource;
use App\Http\Resources\SubmittedClearanceCollection;
use App\Models\SubmitClearance; 
use App\Models\Semester; 
use App\Http\Controllers\GoogleController;

use Illuminate\Http\Request; 
use App\Http\Controllers\PDFController;

Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate-pdf');


Route::get('auth/google',[GoogleController::class, 'googlepage'])->name('google');
Route::get('auth/google/callback',[GoogleController::class, 'googlecallback']);
Route::get('/notregister', function () {
    return Inertia::render('NotRegister');
})->name('notregister');
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('submittedclearances', SubmittedClearance::class);
    Route::get('semesters', [SemesterController::class,'index']);
    Route::get('employee/edit', [EmployeeController::class,'edit'])->name('employee.edit');


    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('employees', EmployeeController::class);
    Route::resource('timesheets', TimesheetController::class);
    Route::post('update-timesheet', [TimesheetController::class,'update'])->name('update.timesheet');




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


<?php

namespace App\Http\Controllers;
use Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Holiday;
use App\Models\Division;
use App\Models\Event;
use App\Models\EventParticipant;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use DB;

class EventController extends Controller
{
  public function index()
    {
        return Inertia::render('Event/List/index',[
            'filters' =>  Request::only(['search','selectedStatus','venue','exam_date']),

            'events' => Event::withCount('participants')->orderBy('updated_at', 'desc') 
            ->when(Request::input('when'), function($inner, $exam_date) {
                $inner->whereDate('when', $exam_date);
        
            })
            ->paginate(100)
            ->withQueryString()
            ->through(fn($schedule) => [
                'id' => $schedule->id,
                'name' => $schedule->name, 
                'venue' => $schedule->venue,
                'when' => $schedule->when, 
                'total_participant' => $schedule->participants_count, 

                

                'created_at' => $schedule->created_at ? $schedule->created_at->format('M d, Y') : '',
                'created_at_human' => $schedule->created_at ? $schedule->created_at->diffForHumans() : '',
            ]),
      
    //     'exam_schedules' => ExamSchedule::withCount('applicants')
            
    //         // ->having('slot', '>', 'applicants_count') // Use the correct alias here
    //         ->orderBy('updated_at', 'desc') 
    //         ->when(Request::input('exam_date'), function($inner, $exam_date) {
    //             $inner->whereDate('exam_date', $exam_date);
        
    //         })->when(Request::input('venue'), function($inner, $venue) {
    //             $inner->where('venue_id', $venue);
        
    //         })
    //         ->paginate(100)
    //         ->withQueryString()
    //         ->through(fn($schedule) => [
    //             'id' => $schedule->id,
    //             'exam_date' => $schedule->exam_date->format('M d, Y'),
    //             'exam_time' => $schedule->exam_date->format('h:i A'),
    //             'exam_date_form' => $schedule->exam_date->format('Y-m-d'),
    //             'exam_time_form' => $schedule->exam_date->format('H:i'),
    //             'available' => $schedule->slot - $schedule->applicants_count,
    //             'slot' => $schedule->slot,
    //             'venue' => $schedule->venue->name,
    //             'venue_id' => $schedule->venue->id,

    //             'created_at' => $schedule->created_at ? $schedule->created_at->format('M d, Y') : '',
    //             'created_at_human' => $schedule->created_at ? $schedule->created_at->diffForHumans() : '',
    //         ]),
    //         'venue' => Venue::get(),
    //         'applicants' => Applicant::query()
         
    //         ->when(Request::input('search'), function($inner, $search) {
    //             $inner->where(DB::raw("TRIM(CONCAT(last_name, ' ', first_name, ' ', COALESCE(middle_name, '')))"), 'LIKE', "%" . $search . "%");
    //         })
            
    //         ->paginate(10)
    //         ->withQueryString()
    //         ->through(fn($applicant) => [
    //             'id' => $applicant->id,
    //             'uuid' => $applicant->uuid,
    //             'status' => $applicant->status,

    //             'first_name' => $applicant->first_name,
    //             'last_name' => $applicant->last_name,
    //             'middle_name' => $applicant->middle_name,
    //             'dc_course' => $applicant->course->name,
    //             'dc_campus' => $applicant->course->campus->name,
    //             'created_at' => $applicant->created_at ? $applicant->created_at->format('M d, Y') : '',
    //             'created_at_human' => $applicant->created_at ? $applicant->created_at->diffForHumans() : '',
    //             'schedule' => $applicant->schedule ? 
    //             (new DateTime($applicant->schedule->schedule->exam_date))->format('M d, Y h:i A') : '',
    //             'venue' => $applicant->schedule ? 
    //             $applicant->schedule->schedule->venue->name: '',
    //         ]),
    //         // 'auth' => Auth::user(),
    //      'schedules' => ExamSchedule::query()
    //      ->leftJoin('applicant_schedules', 'exam_schedules.id', '=', 'applicant_schedules.exam_schedule_id')
    //      ->select('exam_schedules.*', DB::raw('COUNT(applicant_schedules.id) as total_applicants'))
    //      ->groupBy('exam_schedules.id')
    //      ->havingRaw('slot > total_applicants') // Check if slots are greater than total applicants
    //      ->get()
    //      ->map(function($schedule) {
    //          $totalApplicants = $schedule->total_applicants; // Get the total applicants count
    //          return [
    //              'id' => $schedule->id,
    //              'exam_date' => (new DateTime($schedule->exam_date))->format('M d, Y h:i A'),
    //              'reserved' => $schedule->slot, // Reserved count (total available slots)
    //              'available' => $schedule->slot - $totalApplicants, // Calculate available slots
    //              'venue' => $schedule->venue->name,
    //          ];
    //      }),
            
 
    ]);
          
    } 
      public function save()
    {
        Event::updateOrCreate(
        ['id' => Request::input('data.id'),],
         
        Request::input('data') 
        );
    }
         public function delete()
    {

      
        // dd(Request::input('data'));
            if (EventParticipant::where('event_id', Request::input('data.id'))->exists()) {
        return response()->json(['error' => 'Cannot delete the event because participants are associated with it.'], 400);
    }
            Event::where('id', Request::input('data.id'))->delete();
    }
}

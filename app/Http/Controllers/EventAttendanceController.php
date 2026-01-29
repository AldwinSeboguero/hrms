<?php

namespace App\Http\Controllers;
use Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Holiday;
use App\Models\Division;
use App\Models\Event;
use App\Models\EventAttendance;
use App\Models\EventDate;
use App\Models\EventParticipant;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use DB;
class EventAttendanceController extends Controller
{
    public function index()
    {
        $eventDate = EventDate::where('id', Request::input('event_id'))->first();

        return Inertia::render('Event/attendanceSheet',[
            'filters' =>  Request::only(['search','selectedStatus','venue','exam_date']),
  'Schedules' => EventDate::get()->map(function ($eventDate) {

        return [
            'id' => $eventDate->id,
            'event_id' => $eventDate->event_id,
            'event_name' => $eventDate->event->name,
            'when' => Carbon::parse($eventDate->when)->format('M d, Y H:i A'), // Specify your desired format
        ];
    }),
    'participants' => EventParticipant::
        when(Request::input('event_id') ,function($inner, $search) {
                $inner->where('event_id',  $search );
            })
         ->when(Request::input('search'), function($inner, $search) {
                $inner->where('name', 'LIKE', "%" . $search . "%");
            })->orderBy('name')->get()
        ->map(function ($participant) use($eventDate) {
            $atteendance =$eventDate ? EventAttendance::where('event_date_id',$eventDate->id )->where('participant_id',$participant->id )->first() : '';
            return [
                'id' => $participant->id,
                'name' => $participant->name,
                'event_name' => $participant->event->name,

                'date_time_arrive' => $atteendance ? Carbon::parse( $atteendance->date_time_arrive)->format('M d, Y H:i A'):'',
                'when' => Carbon::parse($participant->when)->format('M d, Y H:i A'), // Specify your desired format
            ];
        }),
        'participant_arrive_count' => $eventDate ? EventAttendance::where('event_date_id', $eventDate->id)->paginate()->total() : 0,

        'participant_count' => $eventDate ? EventParticipant::where('event_id', $eventDate->event_id)->paginate()->total() : 0
      
        

    ]);
          
    } 
}

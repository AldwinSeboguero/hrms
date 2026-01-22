<?php

namespace App\Http\Controllers;

use Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Holiday;
use App\Models\Event;
use App\Models\EventDate;
use App\Models\EventParticipant;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use DB;
class ParticipantController extends Controller
{
 public function index()
    {
        return Inertia::render('Event/List/participant',[
      
      'filters' =>  Request::only(['search','selectedStatus','venue','exam_date']),
            'event_id' => Request::input("event"),
            'event_dates' => EventDate::where('event_id',Request::input("event"))->get()->map(function ($eventDate) {
        return [
            'id' => $eventDate->id,
            'event_id' => $eventDate->event_id,
            'when' => Carbon::parse($eventDate->when)->format('M d, Y H:i A'), // Specify your desired format
        ];
    }),
            'participants' => EventParticipant::where('event_id',Request::input("event"))->orderBy('updated_at', 'desc')  
            ->paginate(100)
            ->withQueryString()
            ->through(fn($schedule) => [
                'id' => $schedule->id,
                'name' => $schedule->name, 
                'position' => $schedule->position,
                'office' => $schedule->office, 
                'event_id' => $schedule->event_id, 
                'employee' => $schedule->employee, 


                'uuid' => $schedule->uuid, 

                

                'created_at' => $schedule->created_at ? $schedule->created_at->format('M d, Y') : '',
                'created_at_human' => $schedule->created_at ? $schedule->created_at->diffForHumans() : '',
            ]),
        

    ]);
          
    } 
      public function save()
    {
        // dd(Request::input('data'));
        EventParticipant::updateOrCreate(
        ['name' => Request::input('data.name'),],
         
        Request::input('data') 
        );
    }
       public function delete()
    {
      
        // dd(Request::input('data'));
            EventParticipant::where('id', Request::input('data.id'))->delete();
    }
}
<?php

namespace App\Http\Controllers;
use Request;
use Inertia\Inertia;
use App\Models\Employee;
use App\Models\Timesheet;
use App\Models\Holiday;
use App\Models\Division;
use App\Models\EventAttendance;
use App\Models\EventDate;
use App\Models\EventParticipant;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use DB;

class ScannerController extends Controller
{
 public function index()
    {
        return Inertia::render('Event/Scanner/index',[
            'Schedules' => EventDate::get()->map(function ($eventDate) {

        return [
            'id' => $eventDate->id,
            'event_id' => $eventDate->event_id,
            'event_name' => $eventDate->event->name,
            'when' => Carbon::parse($eventDate->when)->format('M d, Y H:i A'), // Specify your desired format
        ];
    }),
      
        

    ]);
          
    }
    
    public function getParticipants()
    {
    //     return Inertia::render('Event/Scanner/index',[
    //         'Schedules' => EventDate::get()->map(function ($eventDate) {

    //     return [
    //         'id' => $eventDate->id,
    //         'event_id' => $eventDate->event_id,
    //         'event_name' => $eventDate->event->name,
    //         'when' => Carbon::parse($eventDate->when)->format('M d, Y H:i A'), // Specify your desired format
    //     ];
    // }),
      
        

    // ]);
        // dd(Request::input('participant_id'));

        $eventDate = EventDate::where('id', Request::input('event_id'))->first();
    return response()->json([
        'participants' => EventParticipant::where('event_id', $eventDate->event_id)
         ->when(Request::input('search'), function($inner, $search) {
                $inner->where('name', 'LIKE', "%" . $search . "%");
            })->orderBy('name')->get()
        ->map(function ($participant) use($eventDate) {
            $atteendance =EventAttendance::where('event_date_id',$eventDate->id )->where('participant_id',$participant->id )->first();
            return [
                'id' => $participant->id,
                'name' => $participant->name,
                'event_name' => $participant->event->name,

                'date_time_arrive' => $atteendance ? Carbon::parse( $atteendance->date_time_arrive)->format('M d, Y H:i A'):'',
                'when' => Carbon::parse($participant->when)->format('M d, Y H:i A'), // Specify your desired format
            ];
        }),
        'participant_arrive_count' => EventAttendance::where('event_date_id', $eventDate->id)->paginate()->total(),

        'participant_count' => EventParticipant::where('event_id', $eventDate->event_id)->paginate()->total()
    ]);
          
    }

    public function getParticipantDetails()
    {
       
        $participant_id = EventParticipant::where('uuid',Request::input('participant_id'))->first();
         if($participant_id){
            
        
        // dd( $participant_id);
        $event_id = Request::input('event_id');

        $data = [
    'event_date_id' => $event_id,
    'participant_id' => $participant_id ? $participant_id->id : '',
    'date_time_arrive' =>  now(),
    'scanned_by' => Auth::user()->id,

];
        // dd($event_id);

          EventAttendance::updateOrCreate(
        ['participant_id' => $data['participant_id'],
    'event_date_id' => $data['event_date_id'],
        ],
         
        $data
        );

        if ($participant_id) {
            return [
                'uuid' => $participant_id->uuid,
                'name' => $participant_id->name  ,
                'date' =>  $data['date_time_arrive'] ?  \Carbon\Carbon::parse($data['date_time_arrive'])->format(' g:i A') : '',
            ];
        }
        }
     return [
               
                'date' => "The QR code is not recognized for this event." ,
            ];
        // Return the found record as JSON
        // $eventDate = EventDate::where('id', Request::input('event_id'))->first();
        // dd($eventDate);
//   ApplicantSchedule::where('uuid', Request::input('exam_id'))
//     ->where('exam_schedule_id', Request::input('exam_schedule_id'))
//     ->whereNull('scan_at')
//     ->update(['scan_at' => now(),'scan_by' => Auth::user()->id]);
//     $participant = ApplicantSchedule::where('uuid', Request::input('exam_id'))
//     ->where('exam_schedule_id', Request::input('exam_schedule_id')) // Ensure scan_at is NULL
//     ->first();

// if ($participant) {
//     return [
//         'uuid' => $participant->uuid,
//         'name' => $participant->applicant->last_name . ' ' . $participant->applicant->first_name . 
//                   ($participant->applicant->suffix ? ' ' . $participant->applicant->suffix : '') . 
//                   ($participant->applicant->middle_name ? ' ' . $participant->applicant->middle_name : ''),
//         'date' => $participant->scan_at ? \Carbon\Carbon::parse($participant->scan_at)->format('F j, Y g:i A') : '',
//     ];
// }
//     return response()->json([
//         'participant' => $participant,
//         ]); // Return the found record as JSON
//         $eventDate = EventDate::where('id', Request::input('event_id'))->first();
//         // dd($eventDate);
//     return response()->json([
//         'participants' => EventParticipant::where('event_id', $eventDate->event_id)->get()
//         ->map(function ($participant) use($eventDate) {
//             $atteendance =EventAttendance::where('event_date_id',$eventDate->id )->where('participant_id',$participant->id )->first();
//             return [
//                 'id' => $participant->id,
//                 'name' => $participant->name,
//                 'event_name' => $participant->event->name,

//                 'date_time_arrive' => $atteendance ? Carbon::parse( $atteendance->date_time_arrive)->format('M d, Y H:i A'):'',
//                 'when' => Carbon::parse($participant->when)->format('M d, Y H:i A'), // Specify your desired format
//             ];
//         }),
//         'participant_arrive_count' => EventAttendance::where('event_date_id', $eventDate->id)->paginate()->total(),

//         'participant_count' => EventParticipant::where('event_id', $eventDate->event_id)->paginate()->total()
//     ]);
          
//     }
}
}

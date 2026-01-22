<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    use HasFactory;

    protected $table = 'event_attendances'; // Specify the table name if necessary

    protected $fillable = [
        'event_date_id',
        'participant_id',
        'date_time_arrive',
        'scanned_by',

    ];

    // Define the relationship with the EventDate model
    public function eventDate()
    {
        return $this->belongsTo(EventDate::class); // Each attendance belongs to an event date
    }

    // Define the relationship with the Participant model
    public function participant()
    {
        return $this->belongsTo(EventParticipant::class); // Each attendance belongs to a participant
    }
}
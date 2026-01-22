<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    use HasFactory;

    protected $table = 'event_dates'; // Specify the table name

    protected $fillable = [
        'event_id',
        'when',
    ];

    // Define the relationship with the Event model
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
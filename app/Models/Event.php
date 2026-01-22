<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'venue',
        'when',
    ];

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }
       public function eventDates()
    {
        return $this->hasMany(EventDate::class);
    }
}
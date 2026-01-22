<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class EventParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'employee_id',
        'event_id',
        'name',
        'position',
        'office',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid(); // Generate and assign a UUID
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
     public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
   
}
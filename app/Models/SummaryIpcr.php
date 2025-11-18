<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryIpcr extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'summary_ipcr';

    // Fillable fields for mass assignment
    protected $fillable = [
        'employee_id', 
        'year',
        'numerical_rating',
        'adjectival_rating',
        'comment_and_recommendation',
        'type',
    ];

    // Relationship with Employee model
       public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
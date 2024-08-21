<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public function position()
    {
        return $this->belongsTo('App\Models\Position','position_id');
    }
    public function division()
    {
        return $this->belongsTo('App\Models\Division','division_id');
    }
    public function employeeType()
    {
        return $this->belongsTo('App\Models\EmployeeType','employee_type_id');
    }
    protected $casts = [
        'date_of_birth' => 'datetime'
    ];
}

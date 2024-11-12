<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
    public function leavetype()
    {
        return $this->belongsTo('App\Models\LeaveType','leave_type_id');
    }
    public function leavestatus()
    {
        return $this->belongsTo('App\Models\LeaveStatus','leave_status_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;
    protected $fillable=['id','employee_id','position','salary','days_with_pay','days_without_pay', 
    'credit_to',
    'vearned',
    'searned',
    'vless',
    'sless','leave_type_id','description','leave_status_id','duration','physician','certificate_number','date_commenced','date_completed', 'remarks' ];
  
    public function leavetype()
    {
        return $this->belongsTo('App\Models\LeaveType','leave_type_id');
    }
    public function leavestatus()
    {
        return $this->belongsTo('App\Models\LeaveStatus','leave_status_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

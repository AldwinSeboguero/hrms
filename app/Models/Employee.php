<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'employee_code',
        'last_name',
        'first_name',          // Note: corrected spelling of 'first_name'
        'middle_name',
        'preferred_name',
        'suffix',
        'salutation',
        'date_of_birth',
        'gender',
        'contact_number',
        'email_address',
        'employment_status_id',
        'employee_type',
        'position_id',
        'location_id',
        'department_id',
        'division_id',
        'start_date',
        'work_day_id',
    ];
    public function position()
    {
        return $this->belongsTo('App\Models\Position','position_id');
    }
    public function division()
    {
        return $this->belongsTo('App\Models\Division','division_id');
    }
      public function campus()
    {
        return $this->belongsTo('App\Models\Location','location_id');
    }
    public function employeeType()
    {
        return $this->belongsTo('App\Models\EmployeeType','employee_type_id');
    }
    public function employeeStatus()
    {
        return $this->belongsTo('App\Models\EmploymentStatus','employment_status_id');
    }
    public function workDays()
    {
        return $this->belongsTo('App\Models\WorkDay','work_day_id');
    }
    public function leaves()
    {
        return $this->hasMany(EmployeeLeave::class);
    }

    public function getTotalLeavesAttribute()
    {
        return $this->leaves()->count();
    }
    protected $casts = [
        'date_of_birth' => 'datetime',
        'start_date' => 'datetime'

    ];
    public function getAgeAttribute()
    {
        if ($this->date_of_birth) {
            // Get the current date
            $currentDate = Carbon::now();

            // Ensure date_of_birth is a valid date
            $dob = Carbon::parse($this->date_of_birth);

            // Check if date_of_birth is in the future
            if ($dob > $currentDate) {
                return 0; // or handle as needed
            }

            // Calculate age and ensure it's a positive integer
            return (int) $currentDate->diffInYears($dob) * -1;
        }

        return 0; 
    }

}

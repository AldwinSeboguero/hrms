<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePositionSalary extends Model
{
    protected $fillable=['id','employee_id','position_id','date_commenced','date_completed','remuneration','per_type_id','remarks','iscurrent'];
    public function position()
    {
        return $this->belongsTo('App\Models\Position','position_id');
    }
}

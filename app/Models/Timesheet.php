<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class Timesheet extends Model
{
    protected $table='attendance_records';
    protected $fillable=['employee_id','loginam','logoutam','loginpm','logoutpm', 'loginot','logoutot','transaction_date'];

    use LogsActivity;
      public function employee()
    {
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
    public function getActivitylogOptions(): LogOptions
     {
          
         $logOptions = new LogOptions();
         $logOptions->logAll();  
         return $logOptions;  
     }
  
}

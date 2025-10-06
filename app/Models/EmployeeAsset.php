<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAsset extends Model
{
    
    //
     public function assetType()
    {
        return $this->belongsTo('App\Models\AssetType','asset_type_id');
    }
     public function assetStatus()
    {
        return $this->belongsTo(AssetStatus::class);
    }
     public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

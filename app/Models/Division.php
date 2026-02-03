<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable=['location_id','name','id'];

    public function location()
    {
        return $this->belongsTo('App\Models\Location','location_id');
    }
}

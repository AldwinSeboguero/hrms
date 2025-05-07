<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerType extends Model
{
    public function pertype()
    {
        return $this->belongsTo('App\Models\PerType','per_type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    protected $table='purposes';
    protected $fillable=['code','purpose'];
}

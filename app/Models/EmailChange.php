<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailChange extends Model
{
    protected $fillable = [
        'email', 'token','user_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table='role_user';
    protected $fillable = ['role_id','user_id'];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id');
    }
}

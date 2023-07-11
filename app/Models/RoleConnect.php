<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleConnect extends Model
{
    protected $table = 'roleconnect';
    protected $fillable = ['userrole_id', 'usertype_id'];
    
}

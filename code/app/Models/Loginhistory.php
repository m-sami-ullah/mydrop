<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loginhistory extends Model
{
    protected $fillable=['user_id','role_id','action','token','ip','details'];
}

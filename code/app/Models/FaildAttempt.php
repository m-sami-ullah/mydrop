<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaildAttempt extends Model
{
    protected $fillable = ['user_id','role_id','email','password','ip','details'];
}

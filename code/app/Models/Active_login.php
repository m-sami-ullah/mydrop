<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Active_login extends Model
{
    protected $fillable=['userable_id','userable_type','token','ip','details'];


    public function userable()
    {
        return $this->morphTo();
    }
}

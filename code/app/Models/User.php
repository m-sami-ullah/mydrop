<?php

namespace App\Models;

use App\Models\Active_login;
use App\Models\Loginhistory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use Notifiable;

    protected $fillable=["name", "email", "password", "activated"];
	const ACTIVATED_SELECT = [ 
				'0' => 'Inactive',
				'1' => 'Active',
			];

	protected $table = "users";



    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return  [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,

        ];
    }
    
    
    /**
    * User belongs to many (many-to-many) Group.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function group_user()
    {
        // belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = user_id, otherKeyOnPivot = group_id)
        return $this->belongsToMany(Group::class,'group_user','user_id','group_id');
    }
    
    public function activelogins()
    {
        return $this->morphMany(Active_login::class, 'userable');
    }

    public function loginhistory()
    {
        return $this->morphMany(Loginhistory::class, 'userable');
    }

}



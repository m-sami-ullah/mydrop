<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Active_login;
use App\Models\Loginhistory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Notifications\NotifyRestPassword as ResetPasswordNotification;
use App\Notifications\NotifyEmailVerify as EmailVerify;
use Illuminate\Support\Facades\Mail;


class Customer  extends Authenticatable  implements JWTSubject,MustVerifyEmail
{
    use Notifiable;

    protected $fillable=["firstname", "lastname", "email", "password", "phone", "status", "lastlogin", "ip", "signup",'activated','blocked','avatar','code','email_verified_at'];
	const STATUS_SELECT = [ 
				'1' => 'Active',
				'2' => 'Inactive',
			];
    const SIGNUP_SELECT = [ 
				'1' => 'Self',
				'2' => 'Admin',
			];

	protected $table = "customers";

    
    public function getAvatar()
    {
        return $this->avatar == 'default/avatar_1.png' ? asset('default/avatar_1.png') : asset('images/avatar/'.$this->avatar);
    }

    /**
     * Customer has many Boxes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boxes()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = customer_id, localKey = id)
        return $this->hasMany(Box::class);
    }
    /**
     * Customer has many Orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = customer_id, localKey = id)
        return $this->hasMany(Order::class);
    }
    
    /**
     * Customer has many Addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = customer_id, localKey = id)
        return $this->hasMany(Address::class,'customer_id','id');
    }


    public function activelogins()
    {
        return $this->morphMany(Active_login::class, 'userable');
    }

    public function loginhistory()
    {
        return $this->morphMany(Loginhistory::class, 'userable');
    }

    /**
     * Query scope notblocked.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotblocked($query)
    {
        return $query->where('blocked',0);
    }
    /**
     * Query scope active.
     *
     * @param  \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('activated',1);
    }
    
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
            'firstname'          => $this->firstname,
            'lastname'          => $this->lastname,
            'email'         => $this->email,

        ];
    }
    
    // public function getAvatar()
    // {
    //     return '';
    // }

    public function fullname()
    {
        return $this->firstname .' ' . $this->lastname;
    }
    
    public function sendPasswordResetNotification($token)
    {
        $notification = new ResetPasswordNotification($token);
        Mail::to($this)->send($notification->toMail($this));
    }

    public function sendEmailVerificationNotification()
    {
        $notification = new EmailVerify();
        Mail::to($this)->send($notification->toMail($this));
    }

}

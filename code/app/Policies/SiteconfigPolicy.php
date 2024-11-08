<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Siteconfig;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiteconfigPolicy
{
    use HandlesAuthorization;
    

    /**
     * Determine whether the user can update the value.
     *
     * @param  \App\User  $user
     * @param  \App\Value  $value
     * @return mixed
     */
    public function update(User $user, Siteconfig $config)
    {
        // $permission = Permission::key('config','update',$user->group_user->pluck('id'))->get();;
        // return $permission->count() ? true:false;
        return true;
    }

    
}

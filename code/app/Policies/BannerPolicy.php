<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Banner;

use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
{
    use HandlesAuthorization;
    
    /*public function before(User $user)
    {
        return ($user->id==1)?true:false;
    }*/
    /**
     * Determine whether the user can view any model= groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $permission = Permission::key('banner','view',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can view the model= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Banner
     * @return mixed
     */
    public function view(User $user, Banner $banner)
    {
        
    }

    /**
     * Determine whether the user can create model= groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permission = Permission::key('banner','add',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can update the model= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Banner
     * @return mixed
     */
    public function update(User $user, Banner $banner)
    {
        $permission = Permission::key('banner','update',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can delete the model= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Banner
     * @return mixed
     */
    public function delete(User $user, Banner $banner)
    {
        $permission = Permission::key('banner','delete',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    public function deleteall(User $user)
    {
        $permission = Permission::key('banner','delete',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can restore the mmodel= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Group
     * @return mixed
     */
    public function restore(User $user, Banner $banner)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Banner
     * @return mixed
     */
    public function forceDelete(User $user, Banner $banner)
    {
        //
    }
}

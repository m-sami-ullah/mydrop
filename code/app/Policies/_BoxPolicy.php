<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Box;

use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxPolicy
{
    use HandlesAuthorization;
    
    /*public function before(User $user)
    {
        return ($user->id==1)?true:false;
    }*/
    /**
     * Determine whether the user can view any model= boxes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $permission = Permission::key('box','view',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can view the model= box.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Box  $model=Box
     * @return mixed
     */
    public function view(User $user, Box $box)
    {
        
    }

    /**
     * Determine whether the user can create model= boxes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $permission = Permission::key('box','add',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can update the model= box.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Box  $model=Box
     * @return mixed
     */
    public function update(User $user, Box $box)
    {
        $permission = Permission::key('box','update',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can delete the model= box.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Box  $model=Box
     * @return mixed
     */
    public function delete(User $user, Box $box)
    {
        $permission = Permission::key('box','delete',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    public function deleteall(User $user)
    {
        $permission = Permission::key('box','delete',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can restore the mmodel= box.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Box  $model=Box
     * @return mixed
     */
    public function restore(User $user, Box $box)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model= box.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Box  $model=Box
     * @return mixed
     */
    public function forceDelete(User $user, Box $box)
    {
        //
    }
}

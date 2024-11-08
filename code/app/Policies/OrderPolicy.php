<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Order;

use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
        $permission = Permission::key('order','view',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can view the model= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Order
     * @return mixed
     */
    public function view(User $user, Order $order)
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
        $permission = Permission::key('order','add',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can update the model= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Order
     * @return mixed
     */
    public function update(User $user, Order $order)
    {
        $permission = Permission::key('order','update',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can delete the model= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Order
     * @return mixed
     */
    public function delete(User $user, Order $order)
    {
        $permission = Permission::key('order','delete',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    public function deleteall(User $user)
    {
        $permission = Permission::key('order','delete',$user->group_user->pluck('id'))->get();;
        return $permission->count() ? true:false;
    }

    /**
     * Determine whether the user can restore the mmodel= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Group
     * @return mixed
     */
    public function restore(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model= group.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Model=Group  $model=Order
     * @return mixed
     */
    public function forceDelete(User $user, Order $order)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\DepartmentProcurement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentProcurementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DepartmentProcurement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DepartmentProcurement $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->user_role == 0) {
            return true;
        } elseif ($user->user_role == 1) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DepartmentProcurement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DepartmentProcurement $model)
    {
        if ($user->user_role == 0) {
            return true;
        } elseif ($user->user_role == 1) {
            return true;
        } else {
            if ($model->status == 2) {
                return true;
            }

            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DepartmentProcurement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DepartmentProcurement $model)
    {
        if ($user->user_role == 0) {
            return true;
        } elseif ($user->user_role == 1) {
            return false;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DepartmentProcurement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DepartmentProcurement $model)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DepartmentProcurement  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DepartmentProcurement $model)
    {
        if ($user->user_role == 0) {
            return true;
        } elseif ($user->user_role == 1) {
            return false;
        } else {
            return false;
        }
    }
}

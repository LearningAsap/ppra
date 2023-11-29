<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProcurementDocument;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProcurementDocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
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
     * @param  \App\Models\ProcurementDocument  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProcurementDocument $model)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProcurementDocument  $district
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProcurementDocument  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProcurementDocument $model)
    {
        if($user->user_role == 0){
            return true;
        } else if($user->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProcurementDocument  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProcurementDocument $model)
    {
        if($user->user_role == 0){
            return true;
        } else if($user->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProcurementDocument  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        if($user->user_role == 0){
            return true;
        } else if($user->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProcurementDocument  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProcurementDocument $model)
    {
        if($user->user_role == 0){
            return true;
        } else if($user->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }
}
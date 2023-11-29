<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DeptProcComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeptProcCommentPolicy
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
        if($user->user_role == 0){
            return true;
        } else if($user->user_role == 1) {
            return true;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeptProcComment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DeptProcComment $model)
    {
        if($user->user_role == 0){
            return true;
        } else if($user->user_role == 1) {
            return true;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeptProcComment  $district
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
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
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DeptProcComment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DeptProcComment $model)
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
     * @param  \App\Models\DeptProcComment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DeptProcComment $model)
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
     * @param  \App\Models\DeptProcComment  $model
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
     * @param  \App\Models\DeptProcComment  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DeptProcComment $model)
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

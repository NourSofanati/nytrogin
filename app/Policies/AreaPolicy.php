<?php

namespace App\Policies;

use App\Models\Area;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AreaPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Area $area)
    {
        if ($user->role->name == 'admin' || $user->role->name == 'project_manager' || $user->role->name == 'deputy_project_manager' || $user->role->name == 'organization')
            return true;
        if ($user->role->name == 'supervisor' || $user->role->name == 'inspector') {
            foreach ($user->assignments as $assignment) {
                if ($assignment->project->city->area == $area)
                    return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role_id == Role::IS_ADMIN || $user->role_id == Role::IS_PROJECT_MANAGER || $user->role_id == Role::IS_DEPUTY_PROJECT_MANAGER;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Area $area)
    {
        return $user->role_id == Role::IS_ADMIN || $user->role_id == Role::IS_PROJECT_MANAGER || $user->role_id == Role::IS_DEPUTY_PROJECT_MANAGER;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Area $area)
    {
        return $user->role_id == Role::IS_ADMIN || $user->role_id == Role::IS_PROJECT_MANAGER || $user->role_id == Role::IS_DEPUTY_PROJECT_MANAGER;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Area $area)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Area $area)
    {
        //
    }
}

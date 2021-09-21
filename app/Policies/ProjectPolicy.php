<?php

namespace App\Policies;

use App\Models\OrganizationProject;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use function Psy\debug;

class ProjectPolicy
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
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OrganizationProject $organizationProject)
    {
        if ($user->role_id == Role::IS_ADMIN || $user->role_id == Role::IS_PROJECT_MANAGER || $user->role_id == Role::IS_DEPUTY_PROJECT_MANAGER) {
            return true;
        }
        if ($organizationProject->assignments->where('user_id', $user->id)->count()) {
            return true;
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
        return $user->role_id === Role::IS_ADMIN;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OrganizationProject $organizationProject)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OrganizationProject $organizationProject)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OrganizationProject $organizationProject)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OrganizationProject $organizationProject)
    {
        //
    }
}

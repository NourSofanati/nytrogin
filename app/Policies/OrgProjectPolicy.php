<?php

namespace App\Policies;

use App\Models\OrgProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrgProjectPolicy
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
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OrgProject $orgProject)
    {
        if ($user->role->name == 'admin') return true;
        if ($orgProject->pm_id == $user->id || $orgProject->dpm_id == $user->id) return true;
        if ($user->role->name == 'inspector' || $user->role->name == 'supervisor') {
            foreach ($user->assignments as $assignments) {
                $project = Project::find($assignments->project_id);
                if ($project->org_project_id === $orgProject->id) {
                    return true;
                }
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
        return $user->role->name == 'admin' || $user->role->name == 'project_manager';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OrgProject $orgProject)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OrgProject $orgProject)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OrgProject $orgProject)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OrgProject $orgProject)
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Models\OrganizationProject;
use App\Models\ProjectAssignment;
use App\Models\ProjectChecklist;
use App\Models\Team;
use App\Models\User;
use App\Policies\ChecklistPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\TeamPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        OrganizationProject::class => ProjectPolicy::class,
        ProjectChecklist::class => ChecklistPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('see', function (User $user, User $other) {
            return $user->role_id <= $other->role_id;
        });
    }
}

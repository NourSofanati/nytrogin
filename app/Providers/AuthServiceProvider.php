<?php

namespace App\Providers;

use App\Models\OrganizationProject;
use App\Models\OrgProject;
use App\Models\ProjectInspection;
use App\Models\Role;
use App\Models\Team;
use App\Policies\InspectionPolicy;
use App\Policies\OrgProjectPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\RolePolicy;
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
        ProjectInspection::class => InspectionPolicy::class,
        OrgProject::class => OrgProjectPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}

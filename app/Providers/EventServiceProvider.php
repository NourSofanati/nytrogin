<?php

namespace App\Providers;

use App\Events\AssignedUser;
use App\Listeners\SendAssignedUserNotiication;
use App\Models\ProjectAssignment;
use App\Observers\AssignmentObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        AssignedUser::class => [
            SendAssignedUserNotiication::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        ProjectAssignment::observe(AssignmentObserver::class);
    }
}

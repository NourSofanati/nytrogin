<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\ProjectAssignment;

class AssignmentObserver
{
    /**
     * Handle the ProjectAssignment "created" event.
     *
     * @param  \App\Models\ProjectAssignment  $projectAssignment
     * @return void
     */
    public function created(ProjectAssignment $projectAssignment)
    {
        Notification::create([
            'user_id' => $projectAssignment->user_id,
            'body' => "تم تعيينك لمشروع (" . $projectAssignment->project->name . ")",
            'link' => route('projects.show', $projectAssignment->project->id),
        ]);
    }

    /**
     * Handle the ProjectAssignment "updated" event.
     *
     * @param  \App\Models\ProjectAssignment  $projectAssignment
     * @return void
     */
    public function updated(ProjectAssignment $projectAssignment)
    {
        //
    }

    /**
     * Handle the ProjectAssignment "deleted" event.
     *
     * @param  \App\Models\ProjectAssignment  $projectAssignment
     * @return void
     */
    public function deleted(ProjectAssignment $projectAssignment)
    {
        //
    }

    /**
     * Handle the ProjectAssignment "restored" event.
     *
     * @param  \App\Models\ProjectAssignment  $projectAssignment
     * @return void
     */
    public function restored(ProjectAssignment $projectAssignment)
    {
        //
    }

    /**
     * Handle the ProjectAssignment "force deleted" event.
     *
     * @param  \App\Models\ProjectAssignment  $projectAssignment
     * @return void
     */
    public function forceDeleted(ProjectAssignment $projectAssignment)
    {
        //
    }
}

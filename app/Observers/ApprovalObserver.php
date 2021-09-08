<?php

namespace App\Observers;

use App\Models\InspectionApproval;
use App\Models\Notification;

class ApprovalObserver
{
    /**
     * Handle the InspectionApproval "created" event.
     *
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return void
     */
    public function created(InspectionApproval $inspectionApproval)
    {
        $project = $inspectionApproval->inspection->project;
        foreach ($project->supervisors as $supervisor) {
            Notification::create([
                'user_id' => $supervisor->user_id,
                'body' => 'تم طلب الموافقة على تقرير ' . $inspectionApproval->inspection->user->name,
                'url' => route('inspection.show', ['inspection' => $inspectionApproval->inspection])
            ]);
        }
    }

    /**
     * Handle the InspectionApproval "updated" event.
     *
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return void
     */
    public function updated(InspectionApproval $inspectionApproval)
    {
        //
    }

    /**
     * Handle the InspectionApproval "deleted" event.
     *
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return void
     */
    public function deleted(InspectionApproval $inspectionApproval)
    {
        //
    }

    /**
     * Handle the InspectionApproval "restored" event.
     *
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return void
     */
    public function restored(InspectionApproval $inspectionApproval)
    {
        //
    }

    /**
     * Handle the InspectionApproval "force deleted" event.
     *
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return void
     */
    public function forceDeleted(InspectionApproval $inspectionApproval)
    {
        //
    }
}

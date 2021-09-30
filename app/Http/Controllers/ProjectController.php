<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create($request->all());
        $project->status = "pending_1";
        $project->save();
        toast('تم إنشاء مشروع جديد', 'info');
        return redirect()->route('project.assign_supervisors', ['project_id' => $project->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
    public function assign_supervisors(Request $request)
    {
        $project = Project::find($request->project_id);
        return view('project.step-two', compact('project'));
    }

    public function assign_inspectors(Request $request)
    {
        $project = Project::find($request->project_id);
        return view('project.step-three', compact('project'));
    }

    public function request_approval_from_supervisor(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = 'pending_2';
        $project->save();
        foreach ($project->supervisors as $supervisor) {
            Notification::create([
                'user_id' => $supervisor->user->id,
                'body' => 'تم طلب الموافقة من المراقبين لمشروع ' . $project->name,
                'link' => route('projects.show', $project),
            ]);
        }
        toast('تم طلب الموافقة منشرفين', 'info');
        return redirect()->back();
    }

    public function approve_project(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = 'pending_3';
        $project->save();
        foreach ($project->inspectors as $supervisor) {
            Notification::create([
                'user_id' => $supervisor->user->id,
                'body' => 'تمت الموافقة على القائمة الخاصة بمشروع ' . $project->name . ' يرجى إعادة النظر في المشروع.',
                'link' => route('projects.show', $project),
            ]);
        }
        $procurators = User::all()->where('role_id', Role::IS_DEPUTY_PROJECT_MANAGER);

        foreach ($procurators as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'body' => 'يرجى الموافقة على تقرير  ' . $project->name,
                'link' => route('projects.show', $project),
            ]);
        }

        return redirect()->back();
    }
    public function decline_project(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = 'declined_2';
        $project->save();
        foreach ($project->inspectors as $supervisor) {
            Notification::create([
                'user_id' => $supervisor->user->id,
                'body' => 'تم الرفض على القائمة الخاصة بمشروع ' . $project->name . ' يرجى إعادة النظر في المشروع.',
                'link' => route('projects.show', $project),
            ]);
        }
        return redirect()->back();
    }
    public function approve_project_procurator(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = 'pending_4';
        $project->save();
        $admins = User::all()->where('role_id', Role::IS_ADMIN);
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'body' => 'يرجى الموافقة على تقرير  ' . $project->name,
                'link' => route('projects.show', $project),
            ]);
        }
        return redirect()->back();
    }
    public function decline_project_procurator(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = 'declined_3';
        $project->save();

        foreach ($project->assignments as $supervisor) {
            Notification::create([
                'user_id' => $supervisor->user->id,
                'body' => 'تم الرفض على القائمة الخاصة بمشروع ' . $project->name . ' يرجى إعادة النظر في المشروع.',
                'link' => route('projects.show', $project),
            ]);
        }
        return redirect()->back();
    }
    public function approve_project_admin(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = 'done_5';
        $project->save();
        return redirect()->back();
    }
    public function decline_project_admin(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = 'declined_4';
        $project->save();
        foreach ($project->assignments as $supervisor) {
            Notification::create([
                'user_id' => $supervisor->user->id,
                'body' => 'تم الرفض على القائمة الخاصة بمشروع ' . $project->name . ' يرجى إعادة النظر في المشروع.',
                'link' => route('projects.show', $project),
            ]);
        }
        return redirect()->back();
    }
}

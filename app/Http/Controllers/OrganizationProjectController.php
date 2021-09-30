<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Organization;
use App\Models\OrganizationProject;
use App\Models\ProjectChecklist;
use Illuminate\Http\Request;

class OrganizationProjectController extends Controller
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

        $areas = Area::all();
        return view('project.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'org_id' => 'required|integer',
            'deadline' => 'required',
        ]);

        $project = OrganizationProject::create($request->all());
        $checklist = ProjectChecklist::create([
            'project_id' => $project->id,
            'notes' => ' ',
            'status' => 'pending_1'
        ]);
        toast('تم إنشاء مشروع جديد', 'info');
        return view('project.step-two', compact('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Http\Response
     */
    public function show(int $project_id)
    {

        $project = OrganizationProject::find($project_id);
        $this->authorize('view', $project);
        $supervisors = $project->assignments->where('assigned_as', 'supervisor');
        $inspectors = $project->assignments->where('assigned_as', 'inspector');
        return view('project.show', compact(['project', 'supervisors', 'inspectors']));
        //Fix the above code
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationProject $organizationProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrganizationProject $organizationProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationProject  $organizationProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationProject $organizationProject)
    {
        //
    }
}

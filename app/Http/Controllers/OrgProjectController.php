<?php

namespace App\Http\Controllers;

use App\Models\OrgProject;
use App\Models\Project;
use Illuminate\Http\Request;

class OrgProjectController extends Controller
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
        return view('org_project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orgProject = OrgProject::create($request->all());
        return redirect()->route('organization_projects.show', $orgProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Http\Response
     */
    public function show($orgProject)
    {
        $orgProject = OrgProject::find($orgProject);
        // $projects = $orgProject->projects;
        // $completedProjects = $projects->where('status', 'done_5');
        // $inProgressProjects = $projects->whereHas('inspections')->where('status', '!=', 'done_5')->get();
        // $newProjects = $projects->doesntHave('inspections')->get();
        $newProjects = Project::where('org_project_id', $orgProject->id)->doesntHave('reports')->get();
        $inProgressProjects = Project::where('org_project_id', $orgProject->id)->whereHas('reports')->where('status', '!=', 'done_5')->get();
        $completedProjects = Project::where('org_project_id', $orgProject->id)->where('status', 'done_5')->get();

        return view('org_project.show', compact('orgProject', 'completedProjects', 'inProgressProjects', 'newProjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Http\Response
     */
    public function edit(OrgProject $orgProject)
    {
        return view('org_project.edit', compact('orgProject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrgProject $orgProject)
    {
        $orgProject->update($request->all());
        return redirect()->route('organization_projects.show', $orgProject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrgProject  $orgProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrgProject $orgProject)
    {
    }
}

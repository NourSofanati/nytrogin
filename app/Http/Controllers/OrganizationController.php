<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Organization;
use App\Models\OrganizationProject;
use App\Models\ProjectAssignment;
use App\Models\Role;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Alert;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        return view('organizations.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $areas = Area::all();
        return view('organizations.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Organization::class);
        $validator = $request->validate([
            'area_id' => 'required|numeric|exists:areas,id',
            'name' => 'required|unique:organizations,name',
            'address' => 'required',
            'phone_number' => 'required|unique:organizations,phone_number',
        ]);
        Organization::create($request->all());
        alert()->success('تم إضافة هيئة بنجاح');
        return redirect()->route('organizations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }

    public function get_by_id(Request $request)
    {
        if (!$request->organization) {
            $html = 'الرجاء اختيار عميل';
        } else {
            $html = '';
            $organization = Organization::where('id', $request->organization)->get()->first();
            $html .= $organization->address . '<br/><bdi>' . $organization->phone_number . '</bdi><br/>' . $organization->area->name;
        }

        return response()->json(['html' => $html]);
    }

    public function get_all_supervisors()
    {
        $supervisors = User::where('role_id', Role::IS_SUPERVISOR)->get();
        $html = '';

        foreach ($supervisors as $index => $supervisor) {
            $s_id = $supervisor["id"];
            $s_name = $supervisor["name"];
            $isEven = $index % 2 ? 'bg-gray-100' : '';
            $html .= "
            <div class=\"flex text-xl justify-between gap-2 w-full $isEven py-2 px-4\">
                <label class=\"block\" for=\"supervisor[$s_id]\">$s_name</label>
                <input type=\"checkbox\" name=\"supervisor[$s_id]\" id=\"supervisor[$s_id]\" class=\"block mr-3 my-auto \">
            </div>";
        }

        return response()->json(['html' => $html]);
    }
    public function get_all_inspectors(Request $request)
    {
        $inspectors = User::where('role_id', Role::IS_INSPECTOR)->get();
        $html = '';

        $project = Project::find($request->project_id);
        foreach ($inspectors as $index => $inspector) {
            $s_id = $inspector["id"];
            $s_name = $inspector["name"];
            $checked = $project->assignments->where('user_id', $inspector->id)->count() > 0 ? 'checked' : '';
            $isEven = $index % 2 ? 'bg-gray-100' : '';
            if ($inspector)
                $html .= "

            <div class=\"flex text-xl justify-between gap-2 w-full $isEven py-2 px-4\">
                <label class=\"block\" for=\"inspector[$s_id]\">$s_name</label>
                <input type=\"checkbox\" name=\"inspector[$s_id]\" id=\"inspector[$s_id]\" class=\"block mr-3 my-auto \" $checked>
            </div>";
        }

        return response()->json(['html' => $html]);
    }

    public function assign_supervisors(Request $request)
    {
        $project = Project::find($request->project_id);
        foreach ($request->supervisor as $user_id => $value) {
            ProjectAssignment::create([
                'user_id' => $user_id,
                'project_id' => $request->project_id,
                'assigned_as' => 'supervisor',
            ]);
        }
        toast('تم تعيين المشرفين', 'success');
        return redirect()->route('project.assign_inspectors', compact('project'));
    }
    public function assign_inspectors(Request $request)
    {
        $project = Project::find($request->project_id);
        foreach ($project->assignments as $assignment) {
            if ($assignment->assigned_as === 'inspector')
                $assignment->delete();
        }
        if ($request->inspector)
            foreach ($request->inspector as $user_id => $value) {
                ProjectAssignment::create([
                    'user_id' => $user_id,
                    'project_id' => $request->project_id,
                    'assigned_as' => 'inspector',
                ]);
            }
        toast('تم تعيين المفتشين', 'success');
        return redirect()->route('projects.show', $project);
    }
    public function edit_inspectors(Request $request)
    {
        $project = Project::find($request->project_id);
        return view('project.step-three', compact('project'));
    }
}

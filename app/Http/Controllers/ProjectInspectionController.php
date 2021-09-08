<?php

namespace App\Http\Controllers;

use App\Models\InspectionMedia;
use App\Models\Project;
use App\Models\ProjectInspection;
use App\Models\ProjectMedia;
use Illuminate\Http\Request;

class ProjectInspectionController extends Controller
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
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create_inspection_report(Request $request)
    {
        $project = Project::find($request->project_id);
        return view('inspection.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectInspection = ProjectInspection::create($request->all());
        // $files = $request->file('files');
        // if ($request->hasFile('files')) {
        //     foreach ($files as $file) {
        //         $filename = time() . '-' . $file->getClientOriginalName();
        //         // File extension
        //         $extension = $file->getClientOriginalExtension();
        //         // File upload location
        //         $location = 'files';
        //         // Upload file
        //         $file->move($location, $filename);
        //         // File path
        //         $filepath = url('files/' . $filename);

        //         //dd($file);

        //         InspectionMedia::create([
        //             'mimeType' => $file->getMimeType(),
        //             'user_id' => auth()->user()->id,
        //             'inspection_id' => $pI->id,
        //             'url' => $filepath,
        //             'filename' => $filename
        //         ]);
        //     }
        // }
        return redirect()->route('inspection.show', ['inspection' => $projectInspection]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectInspection  $projectInspection
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectInspection $inspection)
    {
        return view('inspection.show', compact('inspection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectInspection  $projectInspection
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectInspection $projectInspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectInspection  $projectInspection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectInspection $inspection)
    {
        $inspection->update($request->all());
        toast('تم الحفظ');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectInspection  $projectInspection
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectInspection $projectInspection)
    {
        //
    }
}

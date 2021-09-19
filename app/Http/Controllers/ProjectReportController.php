<?php

namespace App\Http\Controllers;

use App\Models\ProjectInspection;
use App\Models\ProjectReport;
use App\Models\ReportCheckItem;
use App\Models\ReportCheckItemAttachment;
use App\Models\ReportChecklist;
use Illuminate\Http\Request;

class ProjectReportController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $projectReport = ProjectReport::create($request->all());
        $reportChecklist = ReportChecklist::create(['report_id' => $projectReport->id]);
        foreach ($request->row as $index => $row) {
            $checkItem = ReportCheckItem::create($row + ['checklist_id' => $reportChecklist->id]);
            if ($request->hasFile('row.' . $index . '.files')) {
                foreach ($request->file('row.' . $index . '.files') as $file) {
                    $filename = time() . '_' . rand(100, 999) . '_' . $file->getClientOriginalName();
                    $mimeType = $file->getClientMimeType();
                    $location = 'files';
                    $file->move($location, $filename);
                    $filepath = url($location . '/', $filename);
                    ReportCheckItemAttachment::create(['checkitem_id' => $checkItem->id, 'name' => $filename, 'url' => $filepath, 'mimeType' => $mimeType]);
                }
            }
        }

        // $projectInspection = ProjectInspection::create($request->all());
        // $report = ProjectReport::find($request->report_id);

        return redirect()->route('reports.show', ['report' => $projectReport]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectReport  $projectReport
     * @return \Illuminate\Http\Response
     */
    public function show($projectReport)
    {
        $report = ProjectReport::find($projectReport);
        // return view('inspection.show', compact('report'));
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectReport  $projectReport
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectReport $projectReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectReport  $projectReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectReport $projectReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectReport  $projectReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectReport $projectReport)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\InspectionApproval;
use Illuminate\Http\Request;

class InspectionApprovalController extends Controller
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
        //'inspection_id', 'user_id', 'feedback', 'approved'
        $inspectionApproval = InspectionApproval::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return \Illuminate\Http\Response
     */
    public function show(InspectionApproval $inspectionApproval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return \Illuminate\Http\Response
     */
    public function edit(InspectionApproval $inspectionApproval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $inspection)
    {
        $inspection = InspectionApproval::find($inspection);

        $inspection->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InspectionApproval  $inspectionApproval
     * @return \Illuminate\Http\Response
     */
    public function destroy(InspectionApproval $inspectionApproval)
    {
        //
    }
}

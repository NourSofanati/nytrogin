<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        //
    }

    /**
     * Shows the projects in an area
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show_projects(Request $request)
    {
        $area = Area::find($request->area_id);
        $cat = Category::find($request->cat_id);
        $projects = Project::where('area_id', $area->id)->where('cat_id', $cat->id)->get();
        return view('area.projects', compact('area', 'cat', 'projects'));
    }

    /**
     * Shows the project creation page.
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create_project(Request $request)
    {
        $area = Area::find($request->area_id);
        $cat = Category::find($request->cat_id);
        return view('area.create_project', compact('area', 'cat'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}

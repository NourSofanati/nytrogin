<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\OrgProject;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $projects = Project::all();


        $completedProjects = Project::where('status', 'done_5')->get();
        $inProgressProjects = Project::whereHas('reports')->where('status', '!=', 'done_5')->get();
        $newProjects = Project::doesntHave('reports')->get();
        return view('dashboard', compact('areas', 'completedProjects', 'inProgressProjects', 'newProjects'));
    }
}

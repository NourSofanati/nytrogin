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

        $completedProjects = $projects->where('status', 'done_5');
        $inProgressProjects = Project::whereHas('inspections')->where('status', '!=', 'done_5')->get();
        $newProjects = Project::doesntHave('inspections')->get();

        return view('dashboard', compact('areas', 'completedProjects', 'inProgressProjects', 'newProjects'));
    }
}

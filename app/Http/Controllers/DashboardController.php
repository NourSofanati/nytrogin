<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $projects = Project::all();
        $completedProjects = $projects->where('status', 'done_5')->count();
        $inProgressProjects = Project::whereHas('inspections')->count();
        $newProjects = Project::doesntHave('inspections')->count();

        return view('dashboard', compact('areas', 'completedProjects', 'inProgressProjects','newProjects'));
    }
}

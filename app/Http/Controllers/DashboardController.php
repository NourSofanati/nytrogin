<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Organization;
use App\Models\OrganizationProject;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // $organizations = Organization::paginate(5);
        $areas = Area::all();
        return view('dashboard', compact('areas'));
    }
}

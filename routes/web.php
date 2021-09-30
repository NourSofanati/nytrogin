<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InspectionApprovalController;
use App\Http\Controllers\InspectionTypeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrgProjectController;
use App\Http\Controllers\ProjectChecklistController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectInspectionController;
use App\Http\Controllers\ProjectReportController;
use App\Http\Controllers\UserController;
use App\Models\Area;
use App\Models\City;
use App\Models\InspectionMedia;
use App\Models\Notification;
use App\Models\Organization;
use App\Models\OrgProject;
use App\Models\Project;
use App\Models\ProjectReport;
use App\Models\ReportCheckItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('organization_projects', OrgProjectController::class);
    Route::resource('inspection', ProjectInspectionController::class);
    Route::resource('approvals', InspectionApprovalController::class);
    Route::post('create_inspection_report', [ProjectInspectionController::class, 'create_inspection_report'])->name('create_inspection_report');
    Route::resource('reports', ProjectReportController::class);
    Route::get('reports/{id}/pdf', [ProjectReportController::class, 'pdf'])->name('report_pdf');
    Route::post('city/create_project', [CityController::class, 'create_project'])->name('create_project');
    Route::post('city/projects', [CityController::class, 'show_projects'])->name('show_projects');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('organizations/get_by_id', [OrganizationController::class, 'get_by_id'])->name('organizations.get_by_id');
    Route::get('organizations/get_all_supervisors', [OrganizationController::class, 'get_all_supervisors'])->name('organizations.get_all_supervisors');
    Route::get('organizations/get_all_inspectors', [OrganizationController::class, 'get_all_inspectors'])->name('organizations.get_all_inspectors');
    Route::get('organizations/projects/{project_id}/edit_inspectors', [OrganizationController::class, 'edit_inspectors'])->name('organizations.edit_inspectors');
    Route::post('organizations/assign_supervisors', [OrganizationController::class, 'assign_supervisors'])->name('organizations.assign_supervisors');
    Route::post('organizations/assign_inspectors', [OrganizationController::class, 'assign_inspectors'])->name('organizations.assign_inspectors');
    Route::get('project/assign_supervisors', [ProjectController::class, 'assign_supervisors'])->name('project.assign_supervisors');
    Route::get('project/assign_inspectors', [ProjectController::class, 'assign_inspectors'])->name('project.assign_inspectors');
    Route::post('checklist/add_checkitem', [ProjectChecklistController::class, 'add_checkitem'])->name('checklist.add_checkitem');
    Route::get('checklist/get_all_checkitems', [ProjectChecklistController::class, 'get_all_checkitems'])->name('checklist.get_all_checkitems');
    Route::post('project/request_approval_from_supervisor', [ProjectController::class, 'request_approval_from_supervisor'])->name('project.request_approval_from_supervisor');
    Route::post('project/approve_project', [ProjectController::class, 'approve_project'])->name('project.approve_project');
    Route::post('project/decline_project', [ProjectController::class, 'decline_project'])->name('project.decline_project');
    Route::post('project/approve_project_procurator', [ProjectController::class, 'approve_project_procurator'])->name('project.approve_project_procurator');
    Route::post('project/decline_project_procurator', [ProjectController::class, 'decline_project_procurator'])->name('project.decline_project_procurator');
    Route::post('project/approve_project_admin', [ProjectController::class, 'approve_project_admin'])->name('project.approve_project_admin');
    Route::post('project/decline_project_admin', [ProjectController::class, 'decline_project_admin'])->name('project.decline_project_admin');
    Route::post('notifications/read', [NotificationController::class, 'mark_read'])->name('notifications.read');
    Route::resource('projects', ProjectController::class);
    Route::resource('checklist', ProjectChecklistController::class);
    Route::resource('organizations', OrganizationController::class);
    Route::get('area/create/{orgProject_id}', [AreaController::class, 'create'])->name('area.create');
    Route::resource('area', AreaController::class)->except(['create']);
    Route::resource('category', CategoryController::class);
    Route::resource('cities', CityController::class);
    Route::resource('types', InspectionTypeController::class);
    Route::get('create_from_area', [CityController::class, 'create_from_area'])->name('create_from_area');
    Route::post('add-comment', function (Request $request) {
        $project = Project::find($request->project_id);
        $project->comments = $request->comments;
        $project->save();
        return response()->json(['status' => '200 OK']);
    })->name('add-comment');
    Route::resource('users', UserController::class);
    Route::get('notifications', function (Request $request) {
        $notifications = Notification::all()->where('user_id', auth()->user()->id)->where('read_at', null);
        return $notifications->toArray();
    })->name('notifications');

    Route::post('upload_file', function (Request $request) {
        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf,mp4,wmv,mkv,jiff,gif'
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file'); // Error response

        } else {
            if ($request->file('file')) {

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'files';

                // Upload file
                $file->move($location, $filename);

                // File path
                $filepath = url('files/' . $filename);
                InspectionMedia::create([
                    'user_id' => auth()->user()->id,
                    'inspection_id' => $request->inspection_id,
                    'mimeType' => $file->getClientMimeType(),
                    'url' => $filepath,
                    'filename' => $filename
                ]);

                // Response
                $data['success'] = 1;
                $data['message'] = 'Uploaded Successfully!';
                $data['filepath'] = $filepath;
                $data['extension'] = $extension;
            } else {
                // Response
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);
    })->name('upload_file');
});
Route::post('get-comments', function (Request $request) {
    $project = Project::find($request->project_id);
    return response()->json(['comments' => $project->comments]);
})->name('get-comments');

Route::get('search', function (Request $request) {
    $query = $request->text; // <-- Change the query for testing.

    $articles = Organization::search($query)->get();

    return $articles;
})->name('search');



Route::post('attemptLogin', [UserController::class, 'sendOtp'])->name('attemptLogin');
Route::post('loginOtp', [UserController::class, 'loginOtp'])->name('loginOtp');

Route::get('getAttachments', function (Request $request) {
    $checkitem = ReportCheckItem::find($request->checkitem_id);
    return response()->json($checkitem->attachments);
})->name('get_checkitem_attachments');


Route::prefix('charts')->group(function () {
    Route::get('projects_chart', function (Request $request) {

        $completedProjects = Project::where('status', 'done_5')->get()->count();
        $inProgressProjects = Project::whereHas('reports')->where('status', '!=', 'done_5')->get()->count();
        $newProjects = Project::doesntHave('reports')->get()->count();
        return response()->json([
            __('Completed projects') => $completedProjects,
            __('In progress projects') => $inProgressProjects,
            __('New projects') => $newProjects,
        ]);
    })->name('projects_chart');
    Route::get('reports_chart', function () {
        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = \Carbon\Carbon::now()->addDays($i)->format('Y-m-d');
            $dates->put($date, 0);
        }
        $reports = ProjectReport::where('created_at', '>=', $dates->keys()->first())
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as "count"')
            ])->pluck('count', 'date');
        $dates = $dates->merge($reports);
        return response()->json($dates);
    })->name('reports_chart');
    Route::get('reports_category_chart', function () {
        $projects = Project::all()->groupBy('category_id')->get([DB::raw('COUNT(*) as "count"')])->pluck('count');
        return response()->json($projects);
    })->name('category_chart');
});

Route::post('assign_deputy_manager', function (Request $request) {
    $orgProject = OrgProject::find($request->org_project_id);
    $orgProject->update($request->all());
    alert(__('Deputy manager assigned'), '', 'success');
    return redirect()->back();
})->name('assign_dep');

Route::post('assign_supervisor', function (Request $request) {
    $orgProject = OrgProject::find($request->org_project_id);
    $orgProject->update($request->all());
    alert(__('تم تعيين المشرف'), '', 'success');
    return redirect()->back();
})->name('assign_supervisor');

Route::post('area_modal', function (Request $request) {
    $area = Area::create($request->all());
    alert(__('تم اضافة المنطقة للمشروع'), '', 'success');
    return redirect()->back();
})->name('area_modal');
Route::post('city_modal', function (Request $request) {
    $city = City::create($request->all());
    alert(__('تم اضافة المدينة للمشروع'), '', 'success');
    return redirect()->back();
})->name('city_modal');


Route::get('/reports/{id}/place_json', function (Request $request, ProjectReport $id) {

    return response()->json(['json' => $id->place_json]);
})->name('place_json');

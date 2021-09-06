<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationProjectController;
use App\Http\Controllers\ProjectChecklistController;
use App\Http\Controllers\ProjectCommentsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Models\Notification;
use App\Models\Organization;
use App\Models\Project;
use App\Models\ProjectComments;
use App\Models\ProjectMedia;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
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
    Route::post('category/projects', [CategoryController::class, 'show_projects'])->name('show_projects');
    Route::post('category/create_project', [CategoryController::class, 'create_project'])->name('create_project');
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
    Route::resource('area', AreaController::class);
    Route::resource('category', CategoryController::class);
    Route::post('add-comment', function (Request $request) {
        $project = Project::find($request->project_id);
        $project->comments = $request->comments;
        $project->save();
        return response()->json(['status' => '200 OK']);
    })->name('add-comment');
    Route::resource('users', UserController::class);
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


            ProjectMedia::create([
                'user_id' => auth()->user()->id,
                'project_id' => $request->project_id,
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

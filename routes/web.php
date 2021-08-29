<?php

use App\Http\Controllers\CheckItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationProjectController;
use App\Http\Controllers\ProjectChecklistController;
use App\Models\Notification;
use App\Models\Organization;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', OrganizationProjectController::class);
    Route::get('organizations/get_by_id', [OrganizationController::class, 'get_by_id'])->name('organizations.get_by_id');
    Route::get('organizations/get_all_supervisors', [OrganizationController::class, 'get_all_supervisors'])->name('organizations.get_all_supervisors');
    Route::get('organizations/get_all_inspectors', [OrganizationController::class, 'get_all_inspectors'])->name('organizations.get_all_inspectors');
    Route::get('organizations/projects/{project_id}/edit_inspectors', [OrganizationController::class, 'edit_inspectors'])->name('organizations.edit_inspectors');
    Route::post('organizations/assign_supervisors', [OrganizationController::class, 'assign_supervisors'])->name('organizations.assign_supervisors');
    Route::post('organizations/assign_inspectors', [OrganizationController::class, 'assign_inspectors'])->name('organizations.assign_inspectors');
    Route::post('checklist/add_checkitem', [ProjectChecklistController::class, 'add_checkitem'])->name('checklist.add_checkitem');
    Route::get('checklist/get_all_checkitems', [ProjectChecklistController::class, 'get_all_checkitems'])->name('checklist.get_all_checkitems');
    Route::post('checklist/request_approval_from_supervisor', [ProjectChecklistController::class, 'request_approval_from_supervisor'])->name('checklist.request_approval_from_supervisor');
    Route::post('checklist/approve_checklist', [ProjectChecklistController::class, 'approve_checklist'])->name('checklist.approve_checklist');
    Route::post('checklist/decline_checklist', [ProjectChecklistController::class, 'decline_checklist'])->name('checklist.decline_checklist');
    Route::resource('checklist', ProjectChecklistController::class);
});
Route::get('search', function (Request $request) {
    $query = $request->text; // <-- Change the query for testing.

    $articles = Organization::search($query)->get();

    return $articles;
})->name('search');

Route::get('notifications', function (Request $request) {
    $notifications = Notification::all()->where('user_id', auth()->user()->id);
    return $notifications->toArray();
})->name('notifications');

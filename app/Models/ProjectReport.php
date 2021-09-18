<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReport extends Model
{
    use HasFactory;

    // $table->date('report_date');
    // $table->time('report_time');
    // $table->text('license_id')->nullable();
    // $table->date('licence_expiration')->nullable();
    // $table->text('commercial_license_id')->nullable();
    protected $fillable = [
        'user_id', 'project_id', 'license_id', 'report_date', 'report_time', 'licence_expiration', 'commercial_license_id'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function inspections()
    {
        return $this->hasMany(ProjectInspection::class, 'report_id')->orderBy('created_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checklist()
    {
        return $this->hasOne(ReportChecklist::class, 'report_id');
    }

    public function approvals()
    {
        return $this->hasMany(InspectionApproval::class, 'report_id');
    }
    public function isApproved()
    {
        return $this->hasMany(InspectionApproval::class, 'report_id')->where('approved', true)->orderBy('updated_at', 'desc');
    }
    public function isPending()
    {
        return $this->hasMany(InspectionApproval::class, 'report_id')->whereNull('approved')->orderBy('updated_at', 'desc');
    }
    public function declines()
    {
        return $this->hasMany(InspectionApproval::class, 'report_id')->where('approved', false)->orderBy('updated_at', 'desc');
    }
}

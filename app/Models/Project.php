<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'city_id', 'comments', 'status', 'deadline', 'org_project_id', 'category_id'
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function assignments()
    {
        return $this->hasMany(ProjectAssignment::class, 'project_id');
    }
    public function supervisors()
    {
        return $this->hasMany(ProjectAssignment::class, 'project_id')->where('assigned_as', 'supervisor');
    }
    public function inspectors()
    {
        return $this->hasMany(ProjectAssignment::class, 'project_id')->where('assigned_as', 'inspector');
    }
    public function media()
    {
        return $this->hasMany(ProjectMedia::class, 'project_id');
    }
    public function inspections()
    {
        return $this->hasMany(ProjectInspection::class, 'project_id');
    }
    public function reports()
    {
        return $this->hasMany(ProjectReport::class, 'project_id');
    }
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }
}

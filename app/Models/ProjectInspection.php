<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInspection extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'user_id', 'comments', 'type_id', 'report_id'];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function report()
    {
        return $this->belongsTo(ProjectReport::class, 'report_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function type()
    {
        return $this->belongsTo(InspectionType::class, 'type_id');
    }
    public function media()
    {
        return $this->hasMany(InspectionMedia::class, 'inspection_id');
    }
}

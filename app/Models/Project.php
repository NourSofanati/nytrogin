<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'cat_id', 'area_id', 'comments', 'status'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
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
}

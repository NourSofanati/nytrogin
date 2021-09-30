<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationProject extends Model
{
    use HasFactory;

    protected $fillable = ['org_id', 'status', 'description', 'deadline'];
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function assignments()
    {
        return $this->hasMany(ProjectAssignment::class, 'project_id');
    }

    public function checklist()
    {
        return $this->hasOne(ProjectChecklist::class, 'project_id');
    }
    public function inspectors()
    {
        return $this->assignments()->where('assigned_as', 'inspector');
    }
    public function supervisors()
    {
        return $this->assignments()->where('assigned_as', 'supervisor');
    }
}

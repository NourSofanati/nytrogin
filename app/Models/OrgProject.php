<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgProject extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'pm_id', 'dpm_id', 'notes', 'supervisor_id'];

    public function areas()
    {
        return $this->hasMany(Area::class, 'org_project_id');
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, Area::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'org_project_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'pm_id');
    }

    public function deputyManager()
    {
        return $this->belongsTo(User::class, 'dpm_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}

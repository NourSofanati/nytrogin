<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgProject extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'pm_id', 'dpm_id', 'notes'];

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['area_id', 'alias', 'region_id', 'org_project_id'];

    public function area()
    {
        return $this->belongsTo(AreaList::class, 'area_id');
    }

    public function project()
    {
        return $this->belongsTo(OrgProject::class, 'org_project_id');
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'area_id');
    }

    public function projects()
    {
        return $this->hasManyThrough(Project::class, City::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'area_id');
    }
}

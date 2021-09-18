<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'alias', 'region_id'];

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'area_id');
    }

    public function projects()
    {
        //return $this->hasMany(Project::class, 'area_id');
        return $this->hasManyThrough(Project::class, City::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'area_id');
    }
}

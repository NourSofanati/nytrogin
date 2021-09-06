<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'alias'];

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'area_id');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'area_id');
    }
}

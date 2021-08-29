<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'alias'];
    public function organizations()
    {
        return $this->hasMany(Organization::class,'area_id');
    }
}

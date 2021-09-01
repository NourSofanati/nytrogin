<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'cat_id', 'area_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}

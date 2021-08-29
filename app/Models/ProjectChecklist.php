<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectChecklist extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'notes', 'status'];


    public function items()
    {
        return $this->hasMany(CheckItem::class, 'checklist_id');
    }
}

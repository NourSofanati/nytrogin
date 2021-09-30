<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckItem extends Model
{
    use HasFactory;
    protected $fillable = ['inspection_item','status','checklist_id','comment','action_needed'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionMedia extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'inspection_id', 'url', 'filename','mimeType'];

    public function inspection()
    {
        return $this->belongsTo(ProjectInspection::class, 'inspection_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

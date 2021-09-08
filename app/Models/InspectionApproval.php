<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'inspection_id', 'user_id', 'feedback', 'approved'
    ];

    public function project()
    {
        return $this->belongsTo(ProjectInspection::class, 'inspection_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

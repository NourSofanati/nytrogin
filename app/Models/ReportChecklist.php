<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportChecklist extends Model
{
    use HasFactory;
    protected $fillable = ['report_id', 'notes', 'recommendations'];
    public function report()
    {
        return $this->belongsTo(ProjectReport::class, 'report_id');
    }
    public function checkitems()
    {
        return $this->hasMany(ReportCheckItem::class, 'checklist_id');
    }
}

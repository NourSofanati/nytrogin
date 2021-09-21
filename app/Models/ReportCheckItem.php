<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCheckItem extends Model
{
    use HasFactory;
    protected $fillable = ['checklist_id', 'check', 'notes', 'inspection'];

    public function checklist()
    {
        return $this->belongsTo(ReportChecklist::class, 'checklist_id');
    }
    public function attachments()
    {
        return $this->hasMany(ReportCheckItemAttachment::class, 'checkitem_id');
    }
}

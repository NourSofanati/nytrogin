<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCheckItemAttachment extends Model
{
    use HasFactory;
    protected $fillable = ['checkitem_id', 'name', 'url', 'mimeType'];

    public function checkitem()
    {
        return $this->belongsTo(ReportCheckItem::class, 'checkitem_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Organization extends Model
{
    use HasFactory;
    use Searchable;
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}

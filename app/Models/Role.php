<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['alias', 'name',];

    public const IS_ADMIN = 1;
    public const IS_PROCURATOR = 2;
    public const IS_SUPERVISOR = 3;
    public const IS_INSPECTOR = 4;
    public const IS_ORGANIZATION = 5;
}

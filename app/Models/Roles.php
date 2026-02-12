<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status; // only if you are using Status enum

class Cuisine extends Model
{
    protected $table = 'cuisines';

    protected $fillable = [
        'name',
        'status',
    ];

    // Default status
    protected $attributes = [
        'status' => 'Active', // or Status::Active->value if using enum
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'name',
        'status', // still fillable so we can set it internally
    ];

    // Default attribute
    protected $attributes = [
        'status' => Status::Active->value, // default to 'Active'
    ];
}

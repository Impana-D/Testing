<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class ProspectHousehold extends Model
{
    protected $table = 'prospect_household';

    protected $fillable = [
        'prospect_id',
        'household_size',
        'male_count',
        'female_count',
        'infants',
        'children',
        'adults',
        'seniors',
        'auto_tags',
        'status',
    ];

    // Default attribute
    protected $attributes = [
        'status' => Status::Active->value, // default to 'Active'
    ];
}

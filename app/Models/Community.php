<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Community extends Model
{
    protected $table = 'communities';

    protected $fillable = [
        'city_id',
        'community_name',
        'status',
    ];

    // Default status
    protected $attributes = [
        'status' => Status::Active->value,
    ];

    // Relationship to City
    public function city()
    {
        return $this->belongsTo(\App\Models\City::class);
    }
}

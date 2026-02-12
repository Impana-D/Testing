<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'state_id',
        'name',
        'status',
    ];

    // Default status
    protected $attributes = [
        'status' => Status::Active->value,
    ];

    // Relationship to State
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

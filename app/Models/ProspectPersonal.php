<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class ProspectPersonal extends Model
{
    protected $table = 'prospect_personal';

    protected $fillable = [
        'name',
        'mobile',
        'customer_id',
        'flat_no',
        'floor',
        'block_street',
        'gps_location',
        'latitude',
        'longitude',
        'remarks',
        'version',
        'status',
        'community_id',
    ];

    // Default values
    protected $attributes = [
        'status'  => Status::Active->value,
        'version' => 1,
    ];

    // Relationships
    public function community()
    {
        return $this->belongsTo(\App\Models\Community::class);
    }
    // ProspectPersonal.php
public function customer()
{
    return $this->belongsTo(\App\Models\Users::class, 'customer_id');
}

}

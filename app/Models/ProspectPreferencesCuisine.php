<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspectPreferencesCuisine extends Model
{
    protected $table = 'prospect_preferences_cuisine';
    public $timestamps = false; // optional if you don't have created_at / updated_at
    protected $fillable = [
        'prospect_preferences_id',
        'cuisine_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class ProspectPurchase extends Model
{
    protected $table = 'prospect_purchase';

    protected $fillable = [
        'prospect_id',
        'monthly_budget',
        'purchase_frequency',
        'status',
    ];

    // Default status
    protected $attributes = [
        'status' => Status::Active->value, // Default to 'Active'
    ];

    // If you want, you can also define relationship with days
    public function days()
    {
        return $this->hasMany(ProspectPurchaseDay::class, 'prospect_purchase_id');
    }
}

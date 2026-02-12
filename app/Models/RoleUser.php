<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    // 🔒 FORCE timestamps OFF
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    public $timestamps = false;
}

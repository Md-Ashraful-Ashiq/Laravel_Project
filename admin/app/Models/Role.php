<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'roleName',
        'is_admin_enabled',
        'is_settings_enabled',
    ];
}

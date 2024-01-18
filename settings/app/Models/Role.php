<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'roleName',
        'is_admin_enabled',
        'is_settings_enabled',
        'is_operation_enabled',
        'is_audit_enabled',
    ];
    protected $appends = ['users_count'];

    public function getUsersCountAttribute()
    {
        return $this->users()->count();
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LoginHistory extends Model
{
    protected $fillable = [
        'user_id',
        'login_time',
        'logout_time',
        'total_login_time',
    ];

    protected $dates = ['login_time', 'logout_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Specify the correct table name
    protected $table = 'login_history';

    // Calculate total login time attribute
    public function getTotalLoginTimeAttribute()
    {
        return $this->login_time->diffInSeconds($this->logout_time);
    }
}
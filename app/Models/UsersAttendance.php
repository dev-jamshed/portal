<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAttendance extends Model
{
    use HasFactory;
    // Table name, if different from the plural of the model name
    protected $table = 'usersattendance';

    // The attributes that are mass assignable
    protected $fillable = [
        'user_ip',
        'uid',
        'in_time',
        'out_time',
        'total_work_time',
        'check_in_status',
        'check_out_status',
        'date',
        'attendance_status',
    ];

    // Cast attributes to specific types
    

    // Optional: Define relationships with other models
    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}

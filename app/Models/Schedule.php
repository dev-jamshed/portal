<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'start_datetime',
        'end_datetime',
        'late_time',
        'half_day_time',
        'total_worked_time',
        'attendance_status'
    ];
}

<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AttendanceHelper
{
    public static function getTodayAttendanceForUser($userId = null)
    {
        $userId = $userId ?? Auth::user()->id;
        // return $userId;
        // User ka schedule retrieve karna
        $user = DB::table('users')->where('id', $userId)->first();
        $timezone = 'Asia/Karachi';
        if ($user && $user->schedule_id) {
          
            $schedule = DB::table('schedules')->where('id', $user->schedule_id)->first();
          
            
            if ($schedule) {
               
                // Timezone Karachi set karna
                
                $currentTime = Carbon::now($timezone);
    
                // Schedule ke start aur end times
                $scheduledStartTime = Carbon::parse($schedule->start_datetime, $timezone);
                $scheduledEndTime = Carbon::parse($schedule->end_datetime, $timezone);
                
    
                // Agar current time user ke working hours ke baad hai
                if ($currentTime->greaterThanOrEqualTo($scheduledEndTime)) {
                    return false; // Check-in aur Check-out required nahi hai
                }
    
                // Check-in logic agar current time working hours ke andar hai
                if ($currentTime->lessThan($scheduledStartTime)) {
                    return false; // Check-in is not allowed before scheduled time
                }
            }
        }
        
    
        // Attendance data retrieve karna
        return Attendance::where('uid', $userId)
            ->whereDate('date', Carbon::today($timezone)->toDateString())
            ->first();
    }
    
}

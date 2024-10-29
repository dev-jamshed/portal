<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Console\Command;

class MarkAbsentEmployees extends Command
{
    protected $signature = 'mark:absent-employees';
    protected $description = 'Mark absent employees if they have no attendance record for today';

    public function handle()
    {
        $today = Carbon::today();
        $employees = User::all();

        if ($today->isSunday()) {
            foreach ($employees as $employee) {
                // Sunday ke liye agar attendance record already exist karta hai to skip karein
                $attendance = Attendance::where('uid', $employee->id)
                    ->whereDate('date', $today)
                    ->first();

                if (!$attendance) {
                    $attendance = new Attendance();
                    $attendance->uid = $employee->id;
                    $attendance->date = $today;
                    $attendance->check_in_time = null;
                    $attendance->check_out_time = null;
                    $attendance->check_in_status = null;
                    $attendance->check_out_status = null;
                    $attendance->attendance_status = 'holiday';
                    $attendance->save();
                }
            }
            $this->info('Sunday marked as holiday for all employees.');
            return;
        }

        foreach ($employees as $employee) {
            // Check if the employee has attendance for today
            $attendance = Attendance::where('uid', $employee->id)
                ->whereDate('date', $today)
                ->first();

            // If no attendance record exists, mark the employee as absent
            if (!$attendance) {
                $absentAttendance = new Attendance();
                $absentAttendance->uid = $employee->id;
                $absentAttendance->date = $today;
                $absentAttendance->attendance_status = 'absent';
                $absentAttendance->save();
            } elseif ($attendance->attendance_status === 'absent') {
                // If already marked as absent, no need to do anything
                continue;
            }
        }

        $this->info('Absent employees marked successfully.');
    }
}

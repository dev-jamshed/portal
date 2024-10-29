<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'uid');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    protected $attributes = [
        'pic' => "uploads/profile_pic/default.png",
     ];
     public function projects()
     {
         return $this->belongsToMany(Project::class, 'project_employee', 'employee_id', 'project_id');
     }
     public function tickets()
{
    return $this->belongsToMany(Ticket::class, 'employee_ticket', 'employee_id', 'ticket_id');
}
   
}

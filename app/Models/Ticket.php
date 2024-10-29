<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Attachment;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'priority',
        'project_id',
        'department_id',
        'sub_department_id',
        'employee_id',
        'price',
        'status',
        'client_id',
        'project_deadline',
        'project_name',
        'c_company_name'
    ];
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_ticket');
    }

    public function subDepartments()
    {
        return $this->belongsToMany(SubDepartment::class, 'sub_department_ticket');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }
    public function employees()
    {
        return $this->belongsToMany(User::class, 'employee_ticket', 'ticket_id', 'employee_id');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function images()
    {
        return $this->hasMany(Attachment::class);
    }

    public function client()
    {
        return $this->belongsTo(client::class);
    }
    public function assignments()
    {
        return $this->hasMany(TicketAssignment::class);
    }

    // Relationship with Employee (User)
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function views()
    {
        return $this->belongsToMany(User::class, 'ticket_user_views', 'ticket_id', 'user_id')
            ->withTimestamps()
            ->withPivot('viewed_at');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkFromHomePermission extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'date',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
        // return $this->belongsTo(Employee::class);
    }

}

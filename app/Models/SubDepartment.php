<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class SubDepartment extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'department_id'];
    // public function Department(){
    //     return $this->belongsToMany(Department::class,'sub_departments');
    // }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubDepartment;
class Department extends Model
{
    use HasFactory;

    public function SubDepartment(){
        return $this->belongsToMany(SubDepartment::class,);
    }
    public function subdepartments()
    {
        return $this->hasMany(SubDepartment::class);
    }
}

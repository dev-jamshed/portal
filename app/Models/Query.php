<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Query extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'description', 'date_time', 'category','user_id', 'status', 'assigned_to'];

    // public function save(array $options = []): bool
    // {
    //     if (Auth::check()) {
    //         $this->user_id = Auth::id();
    //     }

    //     return parent::save($options);
    // }
    

    public function assignments()
    {
        return $this->hasMany(QueryAssignment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'query_id');
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}

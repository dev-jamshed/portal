<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvoidRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'query_id',
        'requested_by',
        'admin_id',
        'status',
        'OldQuerystatus'
    ];

    public function queryRelation()
    {
        return $this->belongsTo(Query::class,'query_id');
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function acceptedBy()
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }
     public function comments()
    {
        return $this->hasMany(Comment::class, 'query_id');
    }
    public function assignments()
    {
        return $this->hasMany(QueryAssignment::class, 'query_id');
    }
}

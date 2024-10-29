<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['query_id', 'assigned_by', 'assigned_to'];

    public function queries()
    {
        return $this->belongsTo(Query::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'due_date',
        'price',
        'project_id',
    ];

    /**
     * Get the project that owns the milestone.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

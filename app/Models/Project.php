<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
    protected $dates = ['start_date', 'end_date'];
    
    
}

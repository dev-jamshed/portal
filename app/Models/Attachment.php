<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $table  = "attachments";
    public function tempFile()
    {
        return $this->belongsTo(temp_file::class, 'temp_id');
    }

    protected $fillable = ['ticket_id', 'file_path','file_name','file_type'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}

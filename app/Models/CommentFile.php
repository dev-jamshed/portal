<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentFile extends Model
{
    use HasFactory;
    protected $table = 'comment_attachments';
    protected $fillable = [
        'comment_id',
        'file_path',
        'file_name',
    ];
    // Relationship with TicketComment
    public function comment()
    {
        return $this->belongsTo(TicketComment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'query_id',
        'comment',
        'user_id',
    ];

    /**
     * Override the save method to automatically set the user_id.
     */
    public function save(array $options = []): bool
    {
        if (Auth::check()) {
            $this->user_id = Auth::id();
        }

        return parent::save($options);
    }

    public function queryRelation()
    {
        return $this->belongsTo(Query::class, 'query_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

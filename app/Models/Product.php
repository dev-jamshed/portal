<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name',
        'contact',
        'description',
        'date_time',
        'category',
        'status',
        'assigned_to',
    ];

    // Optionally, if you want to manage timestamps manually or use a different format, you can override these properties:
    public $timestamps = true;

}

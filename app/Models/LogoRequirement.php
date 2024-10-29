<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoRequirement extends Model
{
    use HasFactory;
    // Specify the table associated with the model
    protected $table = 'logo_requirements';

    // Specify the fillable fields
    protected $fillable = [
        'company_name',
        'products',
        'logo_name',
        'tagline',
        'website',
        'company_address',
        'other_requirements',
        'logo_type',
        'reference_file',
    ];
}

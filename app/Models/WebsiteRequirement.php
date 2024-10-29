<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteRequirement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'company_name',
        'phone',
        'email',
        'website',
        'company_address',
        'business_type',
        'industry',
        'main_products',
        'company_slogan',
        'website_purpose',
        'domain_name',
        'competitor_website',
        'client_role',
        'color_theme',
        'web_design_suggestion',
        'company_introduction',
        'categories_names',
        'product_names',
        'special_requirement',
        'reference_file',
    ];

}

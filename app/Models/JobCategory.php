<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class JobCategory extends Model
{
   public $table = 'job_categories';

    public $fillable = [
        'parent_id',
        'category_name',
        'category_slug',
        'category_banner',
        'category_icon',
        'category_heading',
        'category_short_description',
        'category_details',
        'show_on_home',
        'position',
        'sequence',
        'tags',
        'seo_title',
        'seo_description',
        'seo_kewords',
        'status',
        'is_home_display',
        'created_at',
        'updated_at',
        'deleted_at',
        'priority_sequence'
    ];
   
}

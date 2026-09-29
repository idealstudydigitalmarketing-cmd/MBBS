<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'university', 'country_slug', 'flag_emoji', 'year_batch',
        'quote', 'stars', 'avatar_initials', 'photo_path', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];
}

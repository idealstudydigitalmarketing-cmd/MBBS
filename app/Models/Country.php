<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'slug', 'name', 'flag_emoji', 'tagline', 'description',
        'duration', 'language', 'tuition_range', 'living_cost_range',
        'total_cost', 'intake_month', 'nmc_approved', 'usmle_track',
        'neet_required', 'min_marks', 'entrance_exam',
        'image_path', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'nmc_approved' => 'boolean',
        'usmle_track'  => 'boolean',
        'neet_required'=> 'boolean',
        'is_active'    => 'boolean',
    ];

    public function universities()
    {
        return $this->hasMany(University::class, 'country_slug', 'slug');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'name', 'city', 'country_slug', 'flag_emoji', 'rank',
        'annual_fee', 'tags', 'description', 'established',
        'who_approved', 'nmc_listed', 'usmle_track', 'language',
        'image_path', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'who_approved' => 'boolean',
        'nmc_listed'   => 'boolean',
        'usmle_track'  => 'boolean',
        'is_active'    => 'boolean',
    ];

    public function getTagsArrayAttribute(): array
    {
        if (!$this->tags) return [];
        $decoded = json_decode($this->tags, true);
        return is_array($decoded) ? $decoded : [];
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_slug', 'slug');
    }
}

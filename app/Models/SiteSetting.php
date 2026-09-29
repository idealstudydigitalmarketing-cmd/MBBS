<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'label', 'group', 'sort_order'];

    /**
     * Get a setting value by key, with optional default.
     */
    public static function get(string $key, $default = null): ?string
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set / update a setting value by key.
     */
    public static function set(string $key, $value): void
    {
        static::where('key', $key)->update(['value' => $value]);
    }

    /**
     * Get all settings as a flat key=>value array.
     */
    public static function all_keyed(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }

    /**
     * Get all settings grouped by their group.
     */
    public static function grouped(): array
    {
        return static::orderBy('group')->orderBy('sort_order')
            ->get()
            ->groupBy('group')
            ->toArray();
    }
}

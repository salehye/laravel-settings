<?php

namespace YourVendor\WebSettings\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    protected $casts = [
        'value' => 'string', // Default, we will handle custom casting in services/DTOs
    ];

    public function getTable()
    {
        return config('web-settings.table_name', 'web_settings');
    }

    /**
     * Scope a query to only include settings of a given group.
     */
    public function scopeOfGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}

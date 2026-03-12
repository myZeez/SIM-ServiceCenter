<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Disease extends Model
{
    protected $fillable = [
        'code',
        'device_type',
        'name',
        'description',
        'category',
        'solution',
        'actions',
        'min_cost',
        'max_cost',
        'level',
    ];

    protected $casts = [
        'actions' => 'array',
        'min_cost' => 'decimal:2',
        'max_cost' => 'decimal:2',
    ];

    /**
     * Relasi ke symptoms melalui rules
     */
    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, 'rules')
            ->withPivot(['cf_value', 'priority'])
            ->withTimestamps();
    }

    /**
     * Get formatted cost range
     */
    public function getCostRangeAttribute(): string
    {
        if ($this->min_cost == 0 && $this->max_cost == 0) {
            return 'Konsultasi gratis';
        }

        return 'Rp ' . number_format($this->min_cost, 0, ',', '.') . ' - Rp ' . number_format($this->max_cost, 0, ',', '.');
    }

    /**
     * Get level badge color
     */
    public function getLevelColorAttribute(): string
    {
        return match($this->level) {
            'Ringan' => 'green',
            'Sedang' => 'yellow',
            'Berat' => 'red',
            default => 'gray',
        };
    }

    /**
     * Scope berdasarkan kategori
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope berdasarkan tipe perangkat
     */
    public function scopeByDeviceType($query, string $deviceType)
    {
        return $query->where('device_type', $deviceType);
    }
}

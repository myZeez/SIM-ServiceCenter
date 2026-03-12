<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryQuestion extends Model
{
    protected $fillable = [
        'device_type',
        'category',
        'question',
        'expected_keyword',
        'leads_to_symptom_id',
        'order',
        'question_type',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    /**
     * Relasi ke Symptom
     */
    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class, 'leads_to_symptom_id');
    }

    /**
     * Get questions for a category
     */
    public static function getQuestionsForCategory(string $category, string $deviceType = 'laptop')
    {
        return static::where('category', $category)
            ->where('device_type', $deviceType)
            ->orderBy('order')
            ->with('symptom')
            ->get();
    }

    /**
     * Scope berdasarkan tipe perangkat
     */
    public function scopeByDeviceType($query, string $deviceType)
    {
        return $query->where('device_type', $deviceType);
    }
}

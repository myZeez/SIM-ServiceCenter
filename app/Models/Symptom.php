<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Symptom extends Model
{
    protected $fillable = [
        'code',
        'device_type',
        'name',
        'category',
        'keywords',
        'follow_up_question',
        'weight',
        'device_type_id',
        'device_component_id',
    ];

    protected $casts = [
        'keywords' => 'array',
        'weight' => 'decimal:2',
    ];

    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class);
    }

    public function component()
    {
        return $this->belongsTo(DeviceComponent::class, 'device_component_id');
    }

    /**
     * Relasi ke diseases melalui rules
     */
    public function diseases(): BelongsToMany
    {
        return $this->belongsToMany(Disease::class, 'rules')
            ->withPivot(['cf_value', 'priority'])
            ->withTimestamps();
    }

    /**
     * Scope untuk mencari berdasarkan keyword
     */
    public function scopeMatchKeywords($query, string $text)
    {
        $textLower = strtolower($text);

        return $query->where(function ($q) use ($textLower) {
            $q->whereRaw("LOWER(name) LIKE ?", ["%{$textLower}%"])
              ->orWhereRaw("LOWER(keywords) LIKE ?", ["%{$textLower}%"]);
        });
    }

    /**
     * Cek apakah text cocok dengan gejala ini
     */
    public function matchesText(string $text): bool
    {
        $textLower = strtolower($text);

        // Cek nama gejala
        if (str_contains($textLower, strtolower($this->name))) {
            return true;
        }

        // Cek keywords
        if ($this->keywords) {
            foreach ($this->keywords as $keyword) {
                if (str_contains($textLower, strtolower($keyword))) {
                    return true;
                }
            }
        }

        return false;
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

    /**
     * Daftar tipe perangkat yang tersedia
     */
    public static function getDeviceTypes(): array
    {
        return [
            'laptop' => 'Laptop',
            'pc' => 'PC Desktop',
            'aio' => 'All-in-One (AIO)',
            'printer' => 'Printer',
        ];
    }
}

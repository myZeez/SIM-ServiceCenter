<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceComponent extends Model
{
    protected $fillable = [
        'device_type_id',
        'name',
        'slug',
        'icon',
        'description',
        'engine_category',
        'problems_data',
        'is_active',
        'order_column',
    ];

    protected $casts = [
        'problems_data' => 'array',
    ];

    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class);
    }

    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

    public function symptoms()
    {
        return $this->hasMany(Symptom::class);
    }

    public function categoryQuestions()
    {
        return $this->hasMany(CategoryQuestion::class);
    }
}

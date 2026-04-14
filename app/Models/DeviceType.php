<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'is_active',
        'order_column',
    ];

    public function components()
    {
        return $this->hasMany(DeviceComponent::class);
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
    }}

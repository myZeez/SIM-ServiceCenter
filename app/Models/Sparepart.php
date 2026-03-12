<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sparepart extends Model
{
    protected $fillable = [
        'name',
        'code',
        'stock',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function serviceSpareparts(): HasMany
    {
        return $this->hasMany(ServiceSparepart::class);
    }
}

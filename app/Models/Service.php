<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'ticket_number',
        'customer_id',
        'user_id',
        'service_type',
        'brand_id',
        'has_adp',
        'adp_original_cost',
        'rma_number',
        'device_name',
        'serial_number',
        'complaint',
        'status',
        'diagnosis_result',
        'service_items',
        'recommendation',
        'estimated_cost',
        'total_cost',
        'service_cost',
        'notes',
        'completed_at',
        'taken_at',
    ];

    protected $casts = [
        'service_items'     => 'array',
        'estimated_cost'    => 'decimal:2',
        'total_cost'        => 'decimal:2',
        'service_cost'      => 'decimal:2',
        'adp_original_cost' => 'decimal:2',
        'has_adp'           => 'boolean',
        'completed_at'      => 'datetime',
        'taken_at'          => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function serviceLogs(): HasMany
    {
        return $this->hasMany(ServiceLog::class);
    }

    public function serviceSpareparts(): HasMany
    {
        return $this->hasMany(ServiceSparepart::class);
    }
}

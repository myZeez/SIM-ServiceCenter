<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'name',
        'phone',
        'address',
        'device_brand',
        'device_name',
        'serial_number',
        'complaint',
        'symptoms',
        'diagnosis_result',
        'ai_recommendation',
        'status',
    ];

    protected $casts = [
        'symptoms' => 'array',
        'diagnosis_result' => 'array',
    ];

    /**
     * Generate booking code
     */
    public static function generateBookingCode(): string
    {
        $prefix = 'BK';
        $date = now()->format('Ym');

        // Get last booking of this month
        $lastBooking = self::where('booking_code', 'like', "{$prefix}-{$date}-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastBooking) {
            $lastNumber = (int) substr($lastBooking->booking_code, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return "{$prefix}-{$date}-{$newNumber}";
    }
}

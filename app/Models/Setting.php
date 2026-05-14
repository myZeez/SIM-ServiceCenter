<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['key', 'value'];

    public static function appLogoPath(): ?string
    {
        return static::where('key', 'app_logo')->value('value') ?: null;
    }

    public static function appLogoUrl(): ?string
    {
        return static::logoUrl(static::appLogoPath());
    }

    public static function logoUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        return route('system.logo', ['v' => substr(md5($path), 0, 10)]);
    }
}

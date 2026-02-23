<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class LicenseInfo
{
    public static function payload(): ?array
    {
        if (!Storage::exists('license.dat')) {
            return null;
        }

        try {
            $license = decrypt(Storage::get('license.dat'));
            $data = json_decode(base64_decode($license), true);
            return $data['payload'] ?? null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public static function daysRemaining(): ?int
    {
        $payload = self::payload();
        if (!$payload) return null;

        return now()->diffInDays($payload['expires_at'], false);
    }
}

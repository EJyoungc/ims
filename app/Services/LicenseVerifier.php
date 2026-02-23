<?php

namespace App\Services;

use App\Helpers\Machine;

class LicenseVerifier
{
    public static function verify(string $license): bool
    {
        $decoded = json_decode(base64_decode($license), true);

        if (!$decoded || !isset($decoded['payload'], $decoded['signature'])) {
            return false;
        }

        $payload   = json_encode($decoded['payload']);
        $signature = base64_decode($decoded['signature']);

        $publicKey = file_get_contents(storage_path('app/keys/public.pem'));

        if (!openssl_verify($payload, $signature, $publicKey, OPENSSL_ALGO_SHA256)) {
            return false;
        }

        if (strtotime($decoded['payload']['expires_at']) < time()) {
            return false;
        }

        if ($decoded['payload']['machine_id'] !== Machine::id()) {
            return false;
        }

        return true;
    }
}

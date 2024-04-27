<?php
class Authentication {
    public static function generateToken($user): string
    {
        $payload = json_encode([
            'id' => $user['id'],
            'position' => $user['position'],
            'exp' => time() + 3600
        ]);
        $encodedPayload = base64_encode($payload);
        $signature = hash_hmac('sha256', $encodedPayload, config('SECRET_KEY'));
        return $encodedPayload . '.' . $signature;
    }

    public static function verifyToken($token): bool
    {
        $parts = explode('.', $token);
        if(count($parts) !== 2) {
            return false;
        }
        $encodedPayload = $parts[0];
        $signature = $parts[1];
        $expectedSignature = hash_hmac('sha256', $encodedPayload, config('SECRET_KEY'));

        if (!hash_equals($expectedSignature, $signature)) {
            return false;
        }

        $decoded = json_decode(base64_decode($encodedPayload), true);
        return isset($decoded['exp']) && $decoded['exp'] > time();
    }
}


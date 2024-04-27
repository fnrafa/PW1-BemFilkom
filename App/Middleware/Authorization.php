<?php

class Authorization
{
    public static function hasAnyRole($token, $requiredRoles): bool {
        if (!Authentication::verifyToken($token)) {
            return false;
        }

        $parts = explode('.', $token);
        $encodedPayload = $parts[0];
        $decoded = json_decode(base64_decode($encodedPayload), true);

        return isset($decoded['position']) && in_array($decoded['position'], $requiredRoles);
    }
}

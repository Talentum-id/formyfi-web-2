<?php

namespace App\Services\SocialVerifiers;

interface SocialVerificationContract
{
    public function verify(string $providerId, string $source, string $action): bool;
}

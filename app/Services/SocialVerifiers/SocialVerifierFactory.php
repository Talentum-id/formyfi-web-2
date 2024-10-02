<?php

namespace App\Services\SocialVerifiers;

use InvalidArgumentException;

class SocialVerifierFactory
{
    public static function make(string $provider): SocialVerificationContract
    {
        return match ($provider) {
            'twitter' => new TwitterVerifier(),
            'discord' => new DiscordVerifier(),
            default => throw new InvalidArgumentException('Invalid provider: ' . $provider),
        };
    }
}

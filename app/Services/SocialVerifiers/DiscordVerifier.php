<?php

namespace App\Services\SocialVerifiers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;

class DiscordVerifier extends BaseVerifier
{
    protected function invite(string $providerId, string $source): bool
    {
        return $this->sendVerificationRequest(sprintf('guilds/%s/members/%s', $source, $providerId));
    }

    protected function sendVerificationRequest(string $endpoint): bool
    {
        try {
            $response = Http::baseUrl(config('services.verifiers.discord_endpoint'))->get($endpoint);

            return $response->ok();
        } catch (ClientException) {
            return false;
        }
    }
}

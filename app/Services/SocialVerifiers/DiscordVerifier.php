<?php

namespace App\Services\SocialVerifiers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;

class DiscordVerifier extends BaseVerifier
{
    protected function invite(string $providerId, string $source): bool
    {
        $inviteCode = getDiscordInviteCode($source);

        if ($inviteCode === null) {
            return false;
        }

        try {
            $invite = Http::baseUrl(config('services.social_verifiers.discord_endpoint'))->get("invites/$inviteCode");

            return $this->sendVerificationRequest(sprintf('guilds/%s/members/%s', $invite->json()['guildId'], $providerId));
        } catch (ClientException) {
            return false;
        }
    }

    protected function sendVerificationRequest(string $endpoint): bool
    {
        try {
            $response = Http::baseUrl(config('services.social_verifiers.discord_endpoint'))->get($endpoint);

            return $response->ok();
        } catch (ClientException) {
            return false;
        }
    }
}

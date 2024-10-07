<?php

namespace App\Services\SocialVerifiers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;

class TwitterVerifier extends BaseVerifier
{
    protected function like(string $providerId, string $source): bool
    {
        $tweetId = getTwitterTweetId($source);

        if ($tweetId === null) {
            return false;
        }

        return $this->sendVerificationRequest(sprintf('likes/v2/%s/%s', $providerId, $tweetId));
    }

    protected function retweet(string $providerId, string $source): bool
    {
        $tweetId = getTwitterTweetId($source);

        if ($tweetId == null) {
            return false;
        }

        return $this->sendVerificationRequest(sprintf('retweet/v2/%s/%s', $providerId, $tweetId));
    }

    protected function reply(string $providerId, string $source): bool
    {
        $tweetId = getTwitterTweetId($source);

        if ($tweetId == null) {
            return false;
        }

        return $this->sendVerificationRequest(sprintf('replies/v2/%s/%s', $providerId, $tweetId));
    }

    protected function follow(string $providerId, string $source): bool
    {
        $user = $this->user($source);

        if ($user === null) {
            return false;
        }

        return $this->sendVerificationRequest(sprintf('following/v2/%s/%s', $providerId, $user['id']));
    }

    protected function user(string $username): ?array
    {
        try {
            $response = Http
                ::baseUrl(config('services.social_verifiers.twitter_endpoint'))
                ->withHeaders([
                    'Authorization' => config('services.social_verifiers.twitter_api_key'),
                ])
                ->get(sprintf('users/%s', $username));
            $data = $response->json();

            if (empty($data) && !$response->ok()) {
                return null;
            }

            return $data ?? null;
        } catch (ClientException) {
            return null;
        }
    }

    protected function sendVerificationRequest(string $endpoint): bool
    {
        try {
            $response = Http
                ::baseUrl(config('services.social_verifiers.twitter_endpoint'))
                ->withHeaders([
                    'Authorization' => config('services.social_verifiers.twitter_api_key'),
                ])
                ->get($endpoint);
            $data = $response->json();

            if (empty($data) && !$response->ok()) {
                return false;
            }

            return (bool)$data['status'];
        } catch (ClientException) {
            return false;
        }
    }
}

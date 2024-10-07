<?php

if (!function_exists('getTwitterTweetId')) {
    function getTwitterTweetId(string $url): ?string
    {
        preg_match(
            '/^(https?:\/\/)?((www.|m.|mobile.)?(twitter|x)\.com)\/(?:#!\/)?(\w+)\/status?\/(?<tweet>\d+)/i',
            $url,
            $tweetMatches,
        );

        return $tweetMatches['tweet'] ?? null;
    }
}

if (!function_exists('getTwitterUsername')) {
    function getTwitterUsername(string $name): ?string
    {
        return substr($name, 1);
    }
}

if (!function_exists('getDiscordInviteCode')) {
    function getDiscordInviteCode(?string $url): ?string
    {
        preg_match(
            '/^(https?:\/\/)?(discord(?:(?:app)?\.com\/invite|\.gg)(?:\/invite)?)\/(?<code>[\w-]{2,255})/i',
            $url,
            $discordMatches,
        );

        return $discordMatches['code'] ?? null;
    }
}

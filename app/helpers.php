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

<?php

declare(strict_types=1);

namespace App\Services\SocialAuthentication;

use App\Services\SocialAuthentication\Exceptions\GoogleRequestFailedException;
use Illuminate\Support\Facades\Http;

class GoogleAuthenticationService
{
    private const GOOGLE_API_URL = 'https://www.googleapis.com/oauth2';

    private static ?GoogleAuthenticationService $instance = null;

    private int $timeout = 30;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param array<string, string> $query
     * @return object{
     *  sub: string,
     *  name: string,
     *  email: string,
     * }
     * @throws \Exception
     */
    public function request(string $uri, array $query): object
    {
        try {
            $response = Http::timeout($this->timeout)->send('GET', self::GOOGLE_API_URL . $uri, [
                'query' => $query,
            ]);

            if (!$response->successful()) {
                throw new GoogleRequestFailedException();
            }

            return $response->object();
        } catch (\Throwable) {
            throw new GoogleRequestFailedException();
        }
    }
}

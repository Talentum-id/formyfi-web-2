<?php

namespace App\Services\SocialVerifiers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class BaseVerifier implements SocialVerificationContract
{
    /**
     * @throws HttpException
     */
    public function verify(string $providerId, string $source, string $action): bool
    {
        if (!method_exists(static::class, $action)) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'Wrong action called');
        }

        return $this->{$action}($providerId, $source);
    }

    abstract protected function sendVerificationRequest(string $endpoint): bool;
}

<?php

namespace App\Services\Socialite\Twitter;

use SocialiteProviders\Manager\SocialiteWasCalled;

class TwitterExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled): void
    {
        $socialiteWasCalled->extendSocialite('twitter', Provider::class);
    }
}

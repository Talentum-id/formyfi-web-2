<?php

namespace App\Services\Socialite\Discord;

use Illuminate\Http\RedirectResponse;
use SocialiteProviders\Manager\OAuth2\User;
use SocialiteProviders\Discord\Provider as BaseProvider;

class Provider extends BaseProvider
{
    protected function mapUserToObject(array $user): \Laravel\Socialite\Two\User|User
    {
        return (new User())
            ->setRaw($user)
            ->map([
                'id' => $user['id'],
                'nickname' => $user['username'] . ($user['discriminator'] !== '0' ? '#' . $user['discriminator'] : ''),
                'name' => $user['username'],
                'email' => $user['email'] ?? null,
                'avatar' => $this->formatAvatar($user),
            ]);
    }

    public function redirect(): RedirectResponse
    {
        $state = null;

        if ($this->request->has('uri')) {
            $state = config('app.frontend_url') . $this->request->get('uri', '/');
        }

        return new RedirectResponse($this->getAuthUrl($state));
    }

    /**
     * Get the GET parameters for the code request.
     *
     * @param string|null $state
     * @return array
     */
    protected function getCodeFields($state = null): array
    {
        $fields = [
            ...parent::getCodeFields($state),
            'state' => $state,
        ];

        return array_merge($fields, $this->parameters);
    }
}

<?php

namespace App\Services\Socialite\Twitter;

use GuzzleHttp\RequestOptions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\{Arr, Str};
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Two\InvalidStateException;
use SocialiteProviders\Manager\OAuth2\User;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;

class Provider extends AbstractProvider
{
    /**
     * @var string[]
     */
    protected $scopes = ['users.read', 'tweet.read'];

    /**
     * @var bool
     */
    protected $usesPKCE = true;

    /**
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * @var int
     */
    protected $encodingType = PHP_QUERY_RFC3986;

    /**
     * {@inheritdoc}
     */
    public function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase('https://twitter.com/i/oauth2/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl(): string
    {
        return 'https://api.twitter.com/2/oauth2/token';
    }

    /**
     * {@inheritdoc}
     */
    public function user(): \Laravel\Socialite\Two\User|\Laravel\Socialite\Contracts\User|null
    {
        if ($this->user) {
            return $this->user;
        }

        if ($this->hasInvalidState()) {
            throw new InvalidStateException;
        }

        if ($this->hasInvalidCodeChallengeKey()) {
            throw new InvalidCodeChallengeKeyException;
        }

        $response = $this->getAccessTokenResponse($this->getCode());

        $this->user = $this->mapUserToObject($this->getUserByToken(
            $token = Arr::get($response, 'access_token')
        ));

        return $this->user
            ->setToken($token)
            ->setRefreshToken(Arr::get($response, 'refresh_token'))
            ->setExpiresIn(Arr::get($response, 'expires_in'))
            ->setApprovedScopes(explode($this->scopeSeparator, Arr::get($response, 'scope', '')));
    }

    public function redirect(): RedirectResponse
    {
        $key = Str::random(96);
        $code = $this->getCodeVerifier();
        $state = null;

        if ($this->request->has('uri')) {
            $state = config('app.frontend_url') . $this->request->get('uri', '/');
        }

        Cache::put($key, $code, 60 * 15);
        $this->request->offsetSet('code_challenge_key', $code);

        $this->redirectUrl($this->redirectUrl . '?code_challenge_key=' . $key);
        return new RedirectResponse($this->getAuthUrl($state));
    }

    protected function getCodeChallenge(): string
    {
        $hashed = hash('sha256', $this->getCodeChallengeKey(), true);

        return rtrim(strtr(base64_encode($hashed), '+/', '-_'), '=');
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param string $code
     * @return array
     */
    protected function getTokenFields($code): array
    {
        $key = $this->getCodeChallengeKey();
        $redirectUrl = $this->redirectUrl . '?code_challenge_key=' . $key;

        $fields = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code,
            'redirect_uri' => $redirectUrl,
        ];

        $fields['code_verifier'] = Cache::pull($key);

        return $fields;
    }

    /**
     * @return bool
     */
    private function hasInvalidCodeChallengeKey(): bool
    {
        $codeChallenge = $this->getCodeChallengeKey();

        return empty($codeChallenge) || empty(Cache::get($codeChallenge));
    }

    private function getCodeChallengeKey()
    {
        return $this->request->input('code_challenge_key');
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessTokenResponse($code)
    {
        $response = $this
            ->getHttpClient()
            ->post($this->getTokenUrl(), [
                RequestOptions::HEADERS => ['Accept' => 'application/json'],
                RequestOptions::AUTH => [$this->clientId, $this->clientSecret],
                RequestOptions::FORM_PARAMS => $this->getTokenFields($code),
            ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function getCodeFields($state = null): array
    {
        $fields = parent::getCodeFields($state);

        if ($this->isStateless()) {
            $fields['state'] = $state ?? 'state';
        }

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this
            ->getHttpClient()
            ->get('https://api.twitter.com/2/users/me', [
                RequestOptions::HEADERS => ['Authorization' => 'Bearer ' . $token],
                RequestOptions::QUERY => ['user.fields' => 'profile_image_url'],
            ]);

        return Arr::get(json_decode($response->getBody(), true), 'data');
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user): \Laravel\Socialite\Two\User|User
    {
        return (new User())
            ->setRaw($user)
            ->map([
                'id' => $user['id'],
                'nickname' => $user['username'],
                'name' => $user['name'],
                'avatar' => $user['profile_image_url'],
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialiteController extends Controller
{
    public function redirect(Request $request, string $provider): RedirectResponse
    {
        $request->validate([
            'uri' => 'string|min:1',
        ]);

        return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    }

    public function callback(Request $request, string $provider): User
    {
        $request->validate([
            'state' => 'string',
        ]);

        $socialite = Socialite::driver($provider);
        $state = $request->get('state');

        if ($state && $state !== 'state') {
            $socialiteUser = $socialite->stateless()->redirectUrl($state)->user();
        }

        return $socialite->stateless()->user();
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\SocialAuthentication\GoogleAuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;

class SocialiteController extends Controller
{
    public function authorizeWithToken(Request $request, string $provider): JsonResponse
    {
        $data = $request->validate([
            'address' => 'required',
            'token' => 'required',
        ]);

        try {
            try {
                $socialiteUser = Socialite::driver($provider)->userFromToken($data['token']);
            } catch (\Exception) {
                $googleTokenInfo = GoogleAuthenticationService::getInstance()->request('/v3/tokeninfo', [
                    'id_token' => $data['token'],
                ]);

                $socialiteUser = new SocialiteUser();
                $socialiteUser->id = $googleTokenInfo->sub;
                $socialiteUser->name = $googleTokenInfo->name;
                $socialiteUser->email = $googleTokenInfo->email;
            }

            return response()->json($socialiteUser->email ?? $socialiteUser->getEmail());
        } catch (\Exception) {
            throw new ('Invalid token or provider');
        }
    }

    public function redirect(Request $request, string $provider): JsonResponse
    {
        $request->validate([
            'uri' => 'string|min:1',
        ]);

        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        if ($url) {
            $url = str_replace('twitter.com/', 'x.com/', $url);
        }

        return response()->json(compact('url'));
    }

    public function callback(Request $request, string $provider): JsonResponse
    {
        $request->validate([
            'state' => 'string',
        ]);

        $socialite = Socialite::driver($provider);
        $state = $request->get('state');

        if ($state && $state !== 'state') {
            return response()->json([
                'data' => $socialite->stateless()->redirectUrl($state)->user(),
            ]);
        }

        return response()->json([
            'data' => $socialite->stateless()->user(),
        ]);
    }
}

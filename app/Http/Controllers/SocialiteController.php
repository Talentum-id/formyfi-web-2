<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(Request $request, string $provider): JsonResponse
    {
        $request->validate([
            'uri' => 'string|min:1',
        ]);

        return response()->json([
            'url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl(),
        ]);
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

<?php

namespace App\Http\Controllers;

use App\Enums\SocialVerifiers\DiscordVerificationActions;
use App\Enums\SocialVerifiers\TwitterVerificationActions;
use App\Services\SocialVerifiers\SocialVerifierFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialVerificationController extends Controller
{
    public function verify(string $provider, Request $request): JsonResponse
    {
        $availableActions = array_map(fn(TwitterVerificationActions $action) => $action->name,
            $provider === 'twitter'
                ? TwitterVerificationActions::cases()
                : DiscordVerificationActions::cases()
        );

        $data = $request->validate([
            'provider_id' => 'required|string',
            'action' => 'required|string|in:' . implode(',', $availableActions),
            'source' => 'required|string',
        ]);

        return response()->json([
            'result' => SocialVerifierFactory::make($provider)->verify(
                $data['provider_id'],
                $data['source'],
                $data['action'],
            ),
        ]);
    }
}

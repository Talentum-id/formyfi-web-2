<?php

namespace App\Http\Controllers;

use App\Services\ZkIdentity\ZkIdentityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ZkIdentityController extends Controller
{
    public function __construct(private readonly ZkIdentityService $zkIdentityService)
    {
    }

    public function getByProvider(Request $request): JsonResponse
    {
        $data = $request->validate([
            'provider' => 'required|string',
            'provider_id' => 'required|string',
        ]);

        $zkIdentity = $this->zkIdentityService->geyByProviderIdAndName($data['provider'], $data['provider_id']);

        return response()->json($zkIdentity);
    }

    public function updateZeroProof(Request $request): void
    {
        $data = $request->validate([
            'jwt' => 'required',
            'extendedEphemeralPublicKey' => 'required',
            'salt' => 'required',
            'kyeClaimName' => 'required',
            'randomness' => 'required',
            'maxEpoch' => 'required',
            'provider' => 'required',
            'provider_id' => 'required',
            'audience' => 'required',
            'secret_key' => 'required',
        ]);

        $this->zkIdentityService->updateOrCreate($data);
    }
}

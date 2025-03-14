<?php

namespace App\Services\ZkIdentity;

use App\Models\ZkIdentity;
use App\Repositories\ZkIdentityRepository;
use Illuminate\Support\Facades\Http;

readonly class ZkIdentityService
{
    public function __construct(
        private ZkIdentityRepository $zkIdentityRepository,
    ) {
    }

    public function geyByProviderIdAndName(string $provider, string $providerId): ?ZkIdentity
    {
        return $this->zkIdentityRepository->getByProviderIdAndName($provider, $providerId);
    }

    public function updateOrCreate(array $data): void
    {
        $zkIdentity = $this->zkIdentityRepository->getByProviderIdAndName($data['provider'], $data['provider_id']);
        if (!$zkIdentity || $zkIdentity->zero_knowledge_proof_expired < now()->subDay()) {
            $request = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->post(config('zklogin.uri'), $data);

            $this->zkIdentityRepository->updateOrCreate([
                'private_key' => $data['secret_key'],
                'max_epoch' => $data['maxEpoch'],
                'zero_knowledge_proof' => $request->json(),
                'zero_knowledge_proof_expired' => now()->addDays(28),
                'randomness' => $data['jwtRandomness'],
                ...$data,
            ]);
        }
    }
}

<?php

namespace App\Repositories;

use App\Models\ZkIdentity;

class ZkIdentityRepository
{
    public function updateOrCreate(array $data): void
    {
        ZkIdentity::query()->updateOrCreate([
            'provider' => $data['provider'],
            'provider_id' => $data['provider_id'],
        ], $data);
    }

    public function getByProviderIdAndName(string $provider, string $providerId): ?ZkIdentity
    {
        /** @var ?ZkIdentity */
        return ZkIdentity::query()
            ->where([
                'provider' => $provider,
                'provider_id' => $providerId,
            ])
            ->first();
    }
}

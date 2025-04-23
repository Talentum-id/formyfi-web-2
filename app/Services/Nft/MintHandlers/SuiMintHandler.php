<?php

declare(strict_types=1);

namespace App\Services\Nft\MintHandlers;

use App\Services\Nft\Dto\NftMintDto;
use Exception;
use Illuminate\Support\Facades\Http;

class SuiMintHandler implements MintHandlerInterface
{
    public const FOREVER_TIMEOUT = 1620;

    /**
     * @throws Exception
     */
    public function handle(NftMintDto $mintDto): ?array
    {
        $payload = [
            'nftName' => $mintDto->name,
            'nftDesc' => $mintDto->name,
            'nftUrl' => $mintDto->url,
            'price' => floor($mintDto->price * 10 ** 9),
            'endTime' => now()->addWeeks(self::FOREVER_TIMEOUT)->timestamp,
            'mode' => config('services.token_sender.mode', 'mainnet'),
            'env' => app()->environment('production') ? 'PROD' : 'DEV',
        ];

        $request = Http::withToken(config('services.token_sender.access_token'))
            ->post(
                config('services.token_sender.uri') . '/mint-sui-sign',
                $payload,
            );

        $data = $request->json();

        if (!$request->successful() || (isset($data['status']) && $data['status'] === 'failed')) {
            return null;
        }

        $data = $data['data'] ?? null;

        if (\is_array($data)) {
            $data['nftName'] = $payload['nftName'];
            $data['nftDesc'] = $payload['nftDesc'];
            $data['nftUrl'] = $payload['nftUrl'];
            $data['endTime'] = $payload['endTime'];
            $data['price'] = $payload['price'];
        }

        return $data;
    }
}

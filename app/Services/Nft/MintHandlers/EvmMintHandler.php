<?php

declare(strict_types=1);

namespace App\Services\Nft\MintHandlers;

use App\Services\Nft\Dto\NftMintDto;
use Exception;
use Illuminate\Support\Facades\Http;

class EvmMintHandler implements MintHandlerInterface
{
    public const FOREVER_TIMEOUT = 1620; // in weeks

    /**
     * @throws Exception
     */
    public function handle(NftMintDto $mintDto): ?array
    {
        $request = Http::withToken(config('services.token_sender.access_token'))
            ->post(
                config('services.token_sender.uri') . '/mint-sign',
                [
                    'nonce' => $mintDto->nonce,
                    'price' => floor($mintDto->price * 10 ** 18),
                    'deadline' => now()->addWeeks(self::FOREVER_TIMEOUT)->timestamp,
                    'args' => '',
                    'wallet' => $mintDto->wallet,
                    'contractAddress' => $mintDto->contractAddress,
                    'mode' => config('services.token_sender.mode', 'mainnet'),
                    'env' => app()->environment('production') ? 'PROD' : 'DEV',
                    'token_id' => $mintDto->tokenId,
                ],
            );

        $data = $request->json();

        if (!$request->successful() || (isset($data['status']) && $data['status'] === 'failed')) {
            return null;
        }

        return $data['data'] ?? null;
    }
}

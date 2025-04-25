<?php

declare(strict_types=1);

namespace App\Services\Nft;

use App\Services\Nft\Dto\NftMintDto;
use App\Services\Nft\MintHandlers\EvmMintHandler;
use App\Services\Nft\MintHandlers\MintHandlerInterface;
use App\Services\Nft\MintHandlers\SuiMintHandler;

final class MintSignService
{
    public function handle(NftMintDto $mintDto): ?array
    {
        return $this->getHandler($mintDto->blockchain)
            ->handle($mintDto);
    }

    private function getHandler(string $typeChain): MintHandlerInterface
    {
        return match (strtolower($typeChain)) {
            'sui' => new SuiMintHandler(),
            default => new EvmMintHandler(),
        };
    }
}

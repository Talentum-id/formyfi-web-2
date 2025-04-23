<?php

declare(strict_types=1);

namespace App\Services\Nft\MintHandlers;

use App\Services\Nft\Dto\NftMintDto;

interface MintHandlerInterface
{
    public function handle(NftMintDto $mintDto): ?array;
}

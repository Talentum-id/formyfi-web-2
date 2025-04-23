<?php

namespace App\Services\Nft\Dto;

readonly class NftMintDto
{
    public function __construct(
        public string $nonce,
        public string $name,
        public float $price,
        public string $args,
        public string $blockchain,
        public string $wallet,
        public string $contractAddress,
        public string $url,
        public ?string $tokenId,
    ) {
    }
}

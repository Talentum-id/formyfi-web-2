<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Nft\Dto\NftMintDto;
use App\Services\Nft\MintSignService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Random\RandomException;

class NftController extends Controller
{
    private const NONCE_LENGTH = 32;

    public function __construct(private readonly MintSignService $mintSignService)
    {
    }

    /**
     * @throws RandomException
     */
    public function sign(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'wallet' => 'required|string',
            'contractAddress' => 'required|string',
            'tokenId' => 'nullable|string',
            'blockchain' => 'required|string',
            'url' => 'required',
            'description' => 'nullable|string',
            'price' => 'numeric',
        ]);

        $result = $this->mintSignService->handle(new NftMintDto(
            nonce: bin2hex(random_bytes(self::NONCE_LENGTH)),
            name: $validated['name'],
            price: $validated['price'],
            args: $validated['description'] ?? '',
            blockchain: $validated['blockchain'],
            wallet: $validated['wallet'],
            contractAddress: $validated['contractAddress'],
            url: $validated['url'],
            tokenId: $validated['tokenId'],
        ));

        return response()->json($result);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Nft\Dto\NftMintDto;
use App\Services\Nft\MintSignService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Random\RandomException;
use Symfony\Component\HttpFoundation\Response;

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
            'nonce' => 'required|string',
            'wallet' => 'required|string',
            'contractAddress' => 'required|string',
            'tokenId' => 'nullable|string',
            'blockchain' => 'required|string',
            'url' => 'required',
            'description' => 'nullable|string',
            'price' => 'numeric',
        ]);

        $result = $this->mintSignService->handle(new NftMintDto(
            nonce: $validated['nonce'],
            name: $validated['name'],
            price: $validated['price'],
            args: $validated['description'] ?? '',
            blockchain: $validated['blockchain'],
            wallet: $validated['wallet'],
            contractAddress: $validated['contractAddress'],
            url: $validated['url'],
            tokenId: $validated['tokenId'] ?? null,
        ));

        return response()->json($result);
    }

    public function getMetadata(Request $request): JsonResponse
    {
        $data = $request->validate([
            'url' => 'required|url',
        ]);

        try {
            $client = new Client();
            $result = $client->request('GET', $data['url'])->getBody()->getContents();
        } catch (GuzzleException) {
            return response()->json([
                'message' => 'Url did return correct response',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(json_decode($result, true));
    }

    public function uploadFile(Request $request): string
    {
        $data = $request->validate([
            'file' => 'required|file',
        ]);

        $uniqId = uniqid();
        $path = Storage::put('/nft-collections/' . $uniqId, $data['file']);

        return sprintf('%s/api/nft/metadata?url=%s', config('app.url'), $path);
    }
}

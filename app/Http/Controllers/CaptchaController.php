<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function verify(Request $request): JsonResponse
    {
        $request->validate([
            'g-recaptcha-response' => 'required|string',
        ]);

        // TODO: Temporary solution, in the future this needs to replaced with real google recaptcha
        return response()->json([
            'success' => true,
        ]);
    }
}

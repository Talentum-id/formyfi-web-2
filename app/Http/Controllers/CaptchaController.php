<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

class CaptchaController extends Controller
{
    public function verify(Request $request): JsonResponse
    {
        $data = $request->validate([
            'g-recaptcha-response' => 'required|string',
        ]);

        $recaptcha = new ReCaptcha(config('services.recaptcha.secret'));
        $response = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
            ->setScoreThreshold(0.5)
            ->verify($data['g-recaptcha-response'], $request->ip());

        if ($response->isSuccess() && $response->getScore() >= 0.5) {
            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }
}

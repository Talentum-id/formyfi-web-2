<?php

namespace App\Http\Controllers;

use App\Mail\SendResponseDuplicateMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ResponseController extends Controller
{
    public function dispatch(Request $request): Response
    {
        $data = $request->validate([
            'quest' => 'required|array',
            'answers' => 'required|array',
            'email' => 'required|email',
            'author' => 'required|array',
        ]);

        Mail::to($data['email'])->send(new SendResponseDuplicateMail($data['quest'], $data['answers'], $data['author']));

        return response()->noContent();
    }
}

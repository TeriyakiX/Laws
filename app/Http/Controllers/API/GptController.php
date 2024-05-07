<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GptController extends BaseController
{
    public function chat(Request $request)
    {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "Bearer  ". env('OPENAI_API_KEY')
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "user",
                    "content" => $request->message
                ]
            ],
            "temperature" => 0,
            "max_tokens" => 2048
        ])->body();

        return $this->sendResponse(json_decode($response), 'Successfully.');

    }

}

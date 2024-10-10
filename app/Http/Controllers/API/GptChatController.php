<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use AppServices\OpenAIService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GptChatController extends Controller
{
//    protected $OpenAIService;
//
//    public function __construct(OpenAIService $OpenAIService)
//    {
//        $this->OpenAIService = $OpenAIService;
//    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $response = $this->chatGPT($request->input('message'));

        return response()->json($response);
    }
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        // Инициализация Guzzle HTTP клиента
        $this->client = new Client();
        // Получение API ключа из .env файла
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function chatGPT($message)
    {
        try {
            // Выполнение POST-запроса к OpenAI API
            $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'user', 'content' => $message],
                    ],
                ],
            ]);

            // Возвращаем декодированный ответ
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Обработка ошибок запроса
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GroqService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key');
        $this->model = config('services.groq.model');
    }

    public function chat(array $messages, array $tools = [])
    {
        $payload = [
            'model' => $this->model,
            'messages' => $messages,
        ];

        if (!empty($tools)) {
            $payload['tools'] = $tools;
        }

        $response = Http::withToken($this->apiKey)
            ->post('https://api.groq.com/openai/v1/chat/completions', $payload);

        if ($response->failed()) {
            throw new \Exception('Error en Groq: ' . $response->body());
        }

        return $response->json();
    }
}
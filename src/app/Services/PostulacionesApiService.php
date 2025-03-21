<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PostulacionesApiService
{
    protected $postulacionesApiUrl;

    protected $token;

    public function __construct()
    {
        $this->postulacionesApiUrl = config('services.postulaciones.api_url');
        $this->token = config('services.postulaciones.api_token');
    }

    public function call(string $endpoint, array $params = []): array
    {
        $response = Http::withToken($this->token)
            ->get("{$this->postulacionesApiUrl}/{$endpoint}", $params);

        if ($response->failed()) {
            throw new \Exception('Error fetching data from Postulaciones API');
        }

        return $response->json();
    }
}

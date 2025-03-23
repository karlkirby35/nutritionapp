<?php

namespace App\Services;

use GuzzleHttp\Client;

class NutritionixService
{
    protected $client;
    protected $appId;
    protected $appKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->appId = env('NUTRITIONIX_APP_ID');
        $this->appKey = env('NUTRITIONIX_APP_KEY');
    }
    public function getNutritionData($query)
    {
        try {
            $response = $this->client->post('https://trackapi.nutritionix.com/v2/natural/nutrients', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-app-id' => $this->appId,
                    'x-app-key' => $this->appKey,
                ],
                'json' => [
                    'query' => $query,
                    'timezone' => 'US/Eastern',
                ],
                'debug' => true, // Enable debugging
                'verify' => false, // Disable SSL verification
            ]);
    
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            \Log::error('Guzzle Request Error: ' . $e->getMessage());
            return null;
        }
    }
}
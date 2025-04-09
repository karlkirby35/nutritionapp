<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class NutritionixService {
    private $appId;
    private $appKey;

    public function __construct() {
        $this->appId = config('services.nutritionix.app_id');
        $this->appKey = config('services.nutritionix.app_key');
    }

    public function fetchByBarcode($barcode) {
        $response = Http::withHeaders([
            'x-app-id' => $this->appId,
            'x-app-key' => $this->appKey,
            'x-remote-user-id' => '0' 
        ])->get("https://trackapi.nutritionix.com/v2/search/item", [
            'upc' => $barcode
        ]);

        if ($response->successful()) {
            return $this->formatResponse($response->json());
        }

        return null;
    }

    private function formatResponse($data) {
        $item = $data['foods'][0] ?? null;
        if (!$item) return null;

        return [
            'name' => $item['food_name'],
            'calories' => $item['nf_calories'],
            'carbs' => $item['nf_total_carbohydrate'],
            'protein' => $item['nf_protein'],
            'fat' => $item['nf_total_fat'],
            'serving_size' => $item['serving_weight_grams'] . 'g'
        ];
    }
}
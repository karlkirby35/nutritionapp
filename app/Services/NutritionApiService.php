<?php
class NutritionApiService {
  public static function fetchByBarcode($barcode) {
    
    $response = Http::get("https://world.openfoodfacts.org/api/v0/product/$barcode.json");
    
    if ($response->successful()) {
      $data = $response->json()['product'];
      return [
        'name' => $data['product_name'] ?? 'Unknown',
        'calories' => $data['nutriments']['energy-kcal_100g'] ?? 0,
        'carbs' => $data['nutriments']['carbohydrates_100g'] ?? 0
      ];
    }
    
    return null;
  }
}
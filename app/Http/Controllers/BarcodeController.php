<?php
namespace App\Http\Controllers;

use App\Services\NutritionixService;
use Illuminate\Http\Request;

class BarcodeController extends Controller {
    public function process(Request $request) {
        $request->validate(['barcode' => 'required|digits:12,13']);

        $data = (new NutritionixService())->fetchByBarcode($request->barcode);

        if (!$data) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        
        $food = FoodItem::updateOrCreate(
            ['barcode' => $request->barcode],
            $data
        );

        return response()->json($food);
    }
}
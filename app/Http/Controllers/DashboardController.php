<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DashboardController extends Controller
{
    // Display the dashboard
    public function index()
    {
        return view('dashboard');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $action = $request->input('action'); // Capture the action (view or add)
    
        // Fetch nutritional data
        $data = $this->fetchNutritionalData($query);
    
        if (isset($data['error'])) {
            return redirect()->route('dashboard')->with('error', $data['error']);
        }
    
        // If user wants to view nutritional info
        if ($action === 'view') {
            return view('nutritional-information', ['data' => $data]);
        }
    
        // If user wants to add food, extract first food item
        if ($action === 'add' && isset($data['foods'][0])) {
            $foodItem = $data['foods'][0];
    
            $foodData = [
                'name' => $foodItem['food_name'],
                'calories' => $foodItem['nf_calories']
            ];
    
            session()->push("meals." . $request->input('meal'), $foodData);
    
            return redirect()->route('dashboard')->with([
                'success' => 'Food added to ' . ucfirst($request->input('meal')) . '!',
                'meal' => $request->input('meal'),
            ]);
        }
    
        return redirect()->route('dashboard')->with('error', 'Invalid action.');
    }
    

    public function addFood(Request $request)
    {
        $meal = $request->input('meal'); // Get the meal type (breakfast, lunch, or dinner)
        $foodName = $request->input('food_name');
        $calories = $request->input('calories');
    
        if (!$meal || !$foodName || !$calories) {
            return back()->with('error', 'Invalid food entry.');
        }
    
        // Retrieve the current meals from the session or create a new array
        $meals = session('meals', []);
    
        // Ensure the meal array exists
        if (!isset($meals[$meal])) {
            $meals[$meal] = [];
        }
    
        // Add the new food item
        $meals[$meal][] = ['name' => $foodName, 'calories' => $calories];
    
        // Store back in session
        session(['meals' => $meals]);
    
        return back()->with([
            'success' => "$foodName added to $meal.",
            'meal' => $meal
        ]);
    }
    

private function fetchNutritionalData($query)
{
    // Nutritionix API credentials
    $appId = '35f6f524'; // Replace with your App ID
    $appKey = '76623d275b43e643adbd449b01154b62'; // Replace with your App Key

    // Create a new Guzzle client
    $client = new Client();

    try {
        // Make a POST request to the Nutritionix API
        $response = $client->post('https://trackapi.nutritionix.com/v2/natural/nutrients', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-app-id' => $appId,
                'x-app-key' => $appKey,
            ],
            'json' => [
                'query' => $query, // The food item to search for
            ],
            'verify' => false,
        ]);

        // Decode the JSON response
        $data = json_decode($response->getBody(), true);

        // Return the nutritional data
        return $data;
    } catch (\Exception $e) {
        // Handle API errors
        return [
            'error' => 'Failed to fetch nutritional data: ' . $e->getMessage(),
        ];
    }
}

public function delete(Request $request)
{
    $meal = $request->input('meal');
    $index = $request->input('index');

    // Retrieve the current meals from the session
    $meals = session("meals.$meal", []);

    // Remove the item at the specified index
    if (isset($meals[$index])) {
        array_splice($meals, $index, 1);
    }

    // Update the session with the modified meals
    session(["meals.$meal" => $meals]);

    return redirect()->back()->with('success', 'Item deleted successfully.');
}



}
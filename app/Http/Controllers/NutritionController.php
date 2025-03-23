<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NutritionController extends Controller
{
    public function getNutritionData(Request $request)
    {
        // Validate user input
        $request->validate([
            'query' => 'required|string',
            'action' => 'required|string',
            'meal' => 'required|string',
        ]);

        // Debug: Log form data
        \Log::info('Form Data:', [
            'query' => $request->input('query'),
            'action' => $request->input('action'),
            'meal' => $request->input('meal'),
        ]);

        // Retrieve credentials from .env
        $appId = env('NUTRITIONIX_APP_ID');
        $apiKey = env('NUTRITIONIX_API_KEY');

        // Define the endpoint
        $endpoint = 'https://trackapi.nutritionix.com/v2/natural/nutrients';

        // Define the headers
        $headers = [
            'x-app-id' => $appId,
            'x-app-key' => $apiKey,
            'Content-Type' => 'application/json',
        ];

        // Define the body using user input
        $body = [
            'query' => $request->input('query'),
        ];

        // Debug: Log API request body
        \Log::info('API Request Body:', $body);

        // Make the POST request using Laravel's HTTP client
        $response = Http::withHeaders($headers)->post($endpoint, $body);

        // Debug: Log API response
        \Log::info('API Response:', $response->json());

        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json();

            // Ensure the 'foods' key exists in the response
            if (!isset($data['foods'])) {
                \Log::error('Nutritionix API Error: No "foods" key in response');
                return back()->withErrors(['error' => 'No nutritional data found for the query.']);
            }

            // Handle the action (View or Add)
            if ($request->input('action') === 'add') {
                // Store the selected food item in the session
                $meal = $request->input('meal');
                $foodItem = [
                    'name' => $data['foods'][0]['food_name'],
                    'calories' => $data['foods'][0]['nf_calories'],
                ];

                // Debug: Log the food item being added
                \Log::info('Food Item Added:', $foodItem);

                // Push the food item to the session
                session()->push("meals.$meal", $foodItem);

                // Redirect back to the dashboard with a success message
                return redirect()->route('dashboard')->with([
                    'success' => 'Food item added successfully!',
                    'meal' => $meal,
                ]);
            } else {
                // Display nutritional info (you can pass $data to a view)
                return view('nutrition.results', ['data' => $data]);
            }
        } else {
            // Debug: Log the API error
            \Log::error('Nutritionix API Error:', $response->json());
            return back()->withErrors(['error' => 'Failed to fetch data from Nutritionix API']);
        }
    }
}
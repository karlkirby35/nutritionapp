<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutritional Information</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Nutritional Information</h1>
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">Back to Dashboard</a>

        @if(isset($data['foods']))
            <ul class="mt-4 space-y-4">
                @foreach($data['foods'] as $food)
                    <li class="bg-white p-6 rounded-lg shadow-md">
                        <strong class="text-lg">{{ $food['food_name'] }}</strong>
                        <div class="mt-2 space-y-1">
                            <div>Calories: {{ $food['nf_calories'] }} kcal</div>
                            <div>Protein: {{ $food['nf_protein'] }} g</div>
                            <div>Carbs: {{ $food['nf_total_carbohydrate'] }} g</div>
                            <div>Fat: {{ $food['nf_total_fat'] }} g</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="mt-4 text-red-600">No nutritional data found.</p>
        @endif
    </div>
</body>
</html>
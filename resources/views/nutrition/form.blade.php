<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutritionix Search</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Search for Nutritional Information</h1>
        <form action="{{ route('nutrition.search') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <label for="query" class="block text-sm font-medium text-gray-700">Enter a food item:</label>
            <input type="text" id="query" name="query" placeholder="e.g., 1 large apple" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <button type="submit" class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Search
            </button>
        </form>
    </div>
</body>
</html>
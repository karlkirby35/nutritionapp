<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        <!-- Meals Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Breakfast -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Breakfast</h2>
                <!-- Add and Search Food Form -->
                <form action="{{ route('nutrition.search') }}" method="POST" class="mb-4">
                    @csrf
                    <label for="query" class="block text-sm font-medium text-gray-700">Search for food:</label>
                    <input type="text" id="query" name="query" placeholder="e.g., 1 large apple" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="mt-4 flex gap-2">
                        <button type="submit" name="action" value="view" class="flex-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            View Nutritional Info
                        </button>
                        <button type="submit" name="action" value="add" class="flex-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Add to Foods
                        </button>
                    </div>
                </form>
                <!-- Confirmation Message -->
                @if(session('success') && session('meal') === 'breakfast')
                    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Display Breakfast Items -->
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Items:</h3>
                    <ul class="space-y-2">
                        @if(session("meals.breakfast"))
                            @foreach(session("meals.breakfast") as $item)
                                <li class="text-sm">{{ $item['name'] }} - {{ $item['calories'] }} kcal</li>
                            @endforeach
                        @else
                            <li class="text-sm">No items added yet.</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Repeat for Lunch and Dinner -->
            <!-- Lunch -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Lunch</h2>
                <!-- Add and Search Food Form -->
                <form action="{{ route('nutrition.search') }}" method="POST" class="mb-4">
                    @csrf
                    <label for="query" class="block text-sm font-medium text-gray-700">Search for food:</label>
                    <input type="text" id="query" name="query" placeholder="e.g., 1 slice of pizza" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="mt-4 flex gap-2">
                        <button type="submit" name="action" value="view" class="flex-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            View Nutritional Info
                        </button>
                        <button type="submit" name="action" value="add" class="flex-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Add to Foods
                        </button>
                    </div>
                </form>
                <!-- Confirmation Message -->
                @if(session('success') && session('meal') === 'lunch')
                    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Display Lunch Items -->
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Items:</h3>
                    <ul class="space-y-2">
                        @if(session("meals.lunch"))
                            @foreach(session("meals.lunch") as $item)
                                <li class="text-sm">{{ $item['name'] }} - {{ $item['calories'] }} kcal</li>
                            @endforeach
                        @else
                            <li class="text-sm">No items added yet.</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Dinner -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Dinner</h2>
                <!-- Add and Search Food Form -->
                <form action="{{ route('nutrition.search') }}" method="POST" class="mb-4">
                    @csrf
                    <label for="query" class="block text-sm font-medium text-gray-700">Search for food:</label>
                    <input type="text" id="query" name="query" placeholder="e.g., 1 grilled chicken breast" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="mt-4 flex gap-2">
                        <button type="submit" name="action" value="view" class="flex-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            View Nutritional Info
                        </button>
                        <button type="submit" name="action" value="add" class="flex-1 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Add to Foods
                        </button>
                    </div>
                </form>
                <!-- Confirmation Message -->
                @if(session('success') && session('meal') === 'dinner')
                    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Display Dinner Items -->
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Items:</h3>
                    <ul class="space-y-2">
                        @if(session("meals.dinner"))
                            @foreach(session("meals.dinner") as $item)
                                <li class="text-sm">{{ $item['name'] }} - {{ $item['calories'] }} kcal</li>
                            @endforeach
                        @else
                            <li class="text-sm">No items added yet.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
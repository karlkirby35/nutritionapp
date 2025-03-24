<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar (Optional) -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto p-4">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold">My App</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        @yield('content')
    </div>

  

    <nav class="fixed bottom-0 left-0 w-full bg-white shadow-lg flex justify-around p-2">
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-600">
            <i class="fas fa-home text-xl"></i>
            <span class="text-xs">Home</span>
        </a>
        <a href="{{ route('map') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-600">
            <i class="fas fa-user text-xl"></i>
            <span class="text-xs">Map</span>
        </a>
       
    </nav>
</body>
</html>
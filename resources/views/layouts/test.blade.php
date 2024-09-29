<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Load Tailwind CSS from CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">

        <!-- Header (optional) -->
        <header class="bg-white shadow py-4">
            <div class="container mx-auto px-4">
                <h1 class="text-3xl font-bold">{{ $title ?? 'App Name' }}</h1>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 container mx-auto px-4 py-6">
            @yield('content')
        </main>

        <!-- Footer (optional) -->
        <footer class="bg-white text-center py-4 border-t mt-8">
            <p class="text-gray-500">&copy; {{ date('Y') }} Your App. All rights reserved.</p>
        </footer>

    </div>

</body>

</html>

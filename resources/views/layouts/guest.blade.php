<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js (diperlukan Jetstream untuk dropdown/logout) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="flex bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden w-full max-w-3xl">

            <!-- Logo -->
            <div class="hidden md:flex w-1/2 items-center justify-center bg-blue-600 dark:bg-gray-700 p-6">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="w-64 h-auto">
            </div>

            <!-- Form -->
            <div class="w-full md:w-1/2 flex items-center justify-center p-8">
                <div class="w-full max-w-sm">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

</body>

</html>
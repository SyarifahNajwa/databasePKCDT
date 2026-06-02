<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PKCDT') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 via-white to-blue-100">
        <div class="min-h-screen flex items-center justify-center px-4 py-10">
            <div class="w-full max-w-6xl">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-10 lg:gap-16 items-center overflow-hidden">
                    <div class="p-10 md:p-14 flex flex-col items-center justify-center text-center">
                        <div class="inline-flex items-center justify-center rounded-3xl p-6 mb-4">
                            <x-application-logo class="w-auto h-44 md:h-52 fill-current text-blue-600" />
                        </div>
                        <p class="text-xl font-semibold tracking-wider text-gray-800">Pemberitahuan Impor Barang Khusus</p>
                        <p class="text-xl font-semibold tracking-wider text-gray-800">(PIBK)</p>
                    </div>

                    <div class="p-8 md:p-12">
                        <div class="bg-white shadow-lg sm:rounded-3xl border border-blue-100 p-8 md:p-12">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center text-xs text-gray-500">
                    <p>&copy; {{ date('Y') }} Kemenkeu. Semua hak cipta dilindungi.</p>
                </div>
            </div>
        </div>
    </body>
</html>

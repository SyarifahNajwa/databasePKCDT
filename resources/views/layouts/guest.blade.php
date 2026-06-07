<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PIBK') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo_bc.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 via-white to-blue-100">
        <div class="min-h-screen flex items-center justify-center px-4 py-6 md:py-10">
            <div class="w-full max-w-6xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-10 lg:gap-16 items-center overflow-hidden">
                    <!-- Logo & Title Section - Hide on mobile, show on lg and up -->
                    <div class="hidden lg:flex p-10 lg:p-14 flex-col items-center justify-center text-center">
                        <div class="inline-flex items-center justify-center rounded-3xl p-6 mb-4">
                            <x-application-logo class="w-auto h-40 lg:h-52 fill-current text-blue-600" />
                        </div>
                        <p class="text-lg lg:text-xl font-semibold tracking-wider text-gray-800">Pemberitahuan Impor Barang Khusus</p>
                        <p class="text-lg lg:text-xl font-semibold tracking-wider text-gray-800">(PIBK)</p>
                    </div>

                    <!-- Form Section -->
                    <div class="w-full px-4 md:px-8 lg:px-0 py-6 md:py-8">
                        <!-- Mobile Logo - Show only on mobile and tablet -->
                        <div class="lg:hidden flex flex-col items-center justify-center text-center mb-6">
                            <div class="inline-flex items-center justify-center rounded-3xl p-4 mb-3">
                                <x-application-logo class="w-auto h-28 md:h-36 fill-current text-blue-600" />
                            </div>
                            <p class="text-base md:text-lg font-semibold tracking-wider text-gray-800">Pemberitahuan Impor Barang Khusus</p>
                            <p class="text-base md:text-lg font-semibold tracking-wider text-gray-800">(PIBK)</p>
                        </div>

                        <div class="bg-white shadow-lg sm:rounded-3xl border border-blue-100 p-6 md:p-10 lg:p-12">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
                <div class="mt-6 md:mt-8 text-center text-xs md:text-sm text-gray-500">
                    <p>&copy; {{ date('Y') }} Kemenkeu. Semua hak cipta dilindungi.</p>
                </div>
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RuangTenang') }}</title>
        <link rel="icon" type="image/svg+xml" href="{{ asset('Logo.svg') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-background">
        <div class="min-h-screen flex flex-col items-center justify-center p-4 sm:p-6 overflow-hidden">
            <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row w-full h-full max-h-[85vh] lg:max-h-[600px] mb-4">
                <!-- Left Side (Image & Branding) -->
                <div class="md:w-1/2 relative bg-primary hidden md:block">
                    <img src="{{ asset('images/auth_image.png') }}" alt="RuangTenang" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    
                    <div class="absolute bottom-8 left-8 right-8 text-white">
                        <div class="flex items-center gap-2 mb-2">
                            <img src="{{ asset('Logo-Nama-Putih.svg') }}" alt="RuangTenang" class="w-152 h-45">
                        </div>
                        <p class="text-sm text-gray-100/90 leading-relaxed max-w-xs">
                            Temukan kedamaian dalam setiap langkah kecil yang kamu ambil hari ini.
                        </p>
                    </div>
                </div>

                <!-- Right Side (Form) -->
                <div class="w-full md:w-1/2 flex flex-col justify-center p-4 lg:p-6 relative overflow-y-auto">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer Text -->
            <div class="text-center text-xs text-gray-400 font-medium tracking-wide">
                Setiap detik yang kamu habiskan untuk diri sendiri<br>
                adalah<br>
                sebuah kemenangan kecil.
            </div>
        </div>
    </body>
</html>

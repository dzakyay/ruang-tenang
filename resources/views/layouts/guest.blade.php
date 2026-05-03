<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RuangTenang') }}</title>

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
                            <svg class="w-7 h-7 fill-current text-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 2.5C17.5 2.5 13.5 2.5 9.5 6.5C5.5 10.5 4.5 15.5 4.5 15.5C4.5 15.5 6.5 14.5 9.5 14.5C12.5 14.5 15.5 16.5 15.5 16.5C15.5 16.5 15.5 11.5 19.5 7.5C21.5 5.5 21.5 2.5 21.5 2.5C21.5 2.5 18.5 2.5 17.5 2.5Z"/>
                                <path d="M9.5 14.5C6.5 14.5 4.5 15.5 4.5 15.5C4.5 15.5 5.5 18.5 7.5 20.5C9.5 22.5 12.5 22.5 12.5 22.5C12.5 22.5 12.5 18.5 9.5 14.5Z"/>
                            </svg>
                            <h1 class="font-serif text-2xl font-semibold italic">RuangTenang</h1>
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
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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-[#614d3c] bg-background">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-[1px_0_10px_rgba(0,0,0,0.02)] flex flex-col justify-between flex-shrink-0 z-10">
                <!-- Top Section -->
                <div>
                    <!-- Logo -->
                    <div class="h-24 flex items-center px-8">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                            <svg class="w-7 h-7 fill-current text-primary" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 2.5C17.5 2.5 13.5 2.5 9.5 6.5C5.5 10.5 4.5 15.5 4.5 15.5C4.5 15.5 6.5 14.5 9.5 14.5C12.5 14.5 15.5 16.5 15.5 16.5C15.5 16.5 15.5 11.5 19.5 7.5C21.5 5.5 21.5 2.5 21.5 2.5C21.5 2.5 18.5 2.5 17.5 2.5Z"/>
                                <path d="M9.5 14.5C6.5 14.5 4.5 15.5 4.5 15.5C4.5 15.5 5.5 18.5 7.5 20.5C9.5 22.5 12.5 22.5 12.5 22.5C12.5 22.5 12.5 18.5 9.5 14.5Z"/>
                            </svg>
                            <span class="font-serif text-xl font-medium text-primary">RuangTenang</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="mt-2 px-4 space-y-1">
                        <!-- Beranda -->
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('dashboard') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                            <svg class="mr-4 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Beranda
                        </a>

                        <!-- Mood Tracker -->
                        <a href="{{ route('mood') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('mood') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                            <svg class="mr-4 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Mood Tracker
                        </a>

                        <!-- Ensiklopedia Perasaan -->
                        <a href="{{ route('encyclopedia.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('encyclopedia.*') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                            <svg class="mr-4 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Ensiklopedia Perasaan
                        </a>

                        <!-- Jurnal -->
                        <div x-data="{ open: {{ request()->routeIs('journal.*') ? 'true' : 'false' }} }">
                            <div class="flex items-center justify-between px-4 py-2 text-sm font-medium rounded-xl {{ request()->routeIs('journal.index') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                                <a href="{{ route('journal.index') }}" class="flex items-center flex-1 py-1">
                                    <svg class="mr-4 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Jurnal
                                </a>
                                <button @click="open = !open" class="ml-2 p-1 focus:outline-none hover:text-primary transition-colors">
                                    <svg class="h-4 w-4 transform transition-transform" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Jurnal Submenu -->
                            <div x-show="open" x-transition class="mt-1 space-y-1 pl-12 pr-4">
                                <a href="{{ route('journal.show') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('journal.*') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                                    <svg class="mr-3 h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4h16v16H4V4zm2 2v12h12V6H6z"/>
                                    </svg>
                                    Jurnal 1
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors">
                                    <svg class="mr-3 h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4h16v16H4V4zm2 2v12h12V6H6z"/>
                                    </svg>
                                    Jurnal 2
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors">
                                    <svg class="mr-3 h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 4h16v16H4V4zm2 2v12h12V6H6z"/>
                                    </svg>
                                    Jurnal 3
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- Bottom Section -->
                <div class="px-4 pb-8 space-y-4">
                    <!-- Pengaturan -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors">
                        <svg class="mr-4 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Pengaturan
                    </a>

                    <!-- User Profile -->
                    <div class="flex items-center px-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-primary-light flex items-center justify-center text-white overflow-hidden shadow-sm">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=a07954&color=fff" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-[#F7F7F5]">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

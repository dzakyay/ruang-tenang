<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RuangTenang') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('Logo.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-[#614d3c] bg-background">
    @php
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user();
        $userJournals = $authUser->journals()->latest()->get();
        $hasJournals = $userJournals->isNotEmpty();
    @endphp

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden relative">

        <!-- Sidebar Backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black/20 lg:hidden"
            @click="sidebarOpen = false" style="display: none;"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-[1px_0_10px_rgba(0,0,0,0.02)] flex flex-col justify-between flex-shrink-0 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">
            <!-- Top Section -->
            <div>
                <!-- Logo Sidebar -->
                <div class="h-24 flex items-center px-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-icons.logo class="w-152 h-45" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="mt-2 px-4 space-y-1">
                    <!-- Beranda -->
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('dashboard') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                        <x-icons.home class="mr-4 h-5 w-5" />
                        Beranda
                    </a>

                    <!-- Mood Tracker -->
                    <a href="{{ route('mood') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('mood') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                        <x-icons.mood class="mr-4 h-5 w-5" />
                        Mood Tracker
                    </a>

                    <!-- Ensiklopedia Perasaan -->
                    <a href="{{ route('encyclopedia.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('encyclopedia.*') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                        <x-icons.encyclopedia class="mr-5 h-5 w-5" />
                        Ensiklopedia Perasaan
                    </a>

                    <!-- Jurnal -->
                    <div x-data="{ journalOpen: {{ request()->routeIs('journal.*') ? 'true' : 'false' }} }">
                        <div
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium rounded-xl {{ request()->routeIs('journal.index') ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                            <a href="{{ route('journal.index') }}" class="flex items-center flex-1 py-1">
                                <x-icons.journal class="mr-4 h-5 w-5" />
                                Jurnal
                            </a>
                            @if ($hasJournals)
                                <button @click="journalOpen = !journalOpen"
                                    class="ml-1 p-1 focus:outline-none hover:text-primary transition-colors flex-shrink-0">
                                    <x-icons.chevron-down class="h-4 w-4 transform transition-all"
                                        x-bind:class="{ 'rotate-180 -translate-y-2': journalOpen }" />
                                </button>
                            @endif
                        </div>

                        <!-- Jurnal Submenu -->
                        @if ($hasJournals)
                            <div x-show="journalOpen" x-transition.opacity class="mt-1 space-y-1 pl-12 pr-4">
                                @foreach ($userJournals as $sidebarJournal)
                                    <a href="{{ route('journal.show', $sidebarJournal) }}"
                                        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->is('journal/' . $sidebarJournal->id) ? 'text-primary bg-[#F7F4F0]' : 'text-gray-400 hover:text-primary hover:bg-[#F7F4F0]/50 transition-colors' }}">
                                        <x-icons.document class="mr-3 h-4 w-4" />
                                        <span class="truncate">{{ $sidebarJournal->title }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="mt-1 pl-12 pr-4">
                                <a href="{{ route('journal.index') }}"
                                    class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-[#a07954] hover:bg-[#F7F4F0] transition-colors">
                                    <x-icons.document class="mr-3 h-4 w-4" />
                                    Buat Jurnal Baru
                                </a>
                            </div>
                        @endif
                    </div>
                </nav>
            </div>

            <!-- Bottom Section -->
            <div class="px-4 pb-8 space-y-4">
                <!-- User Profile -->
                <div x-data="{ profileOpen: false }" class="relative px-2">
                    <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false"
                        class="flex items-center w-full focus:outline-none hover:bg-[#F7F4F0]/50 p-2 rounded-xl transition-colors">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-tr from-primary to-primary-light flex items-center justify-center text-white overflow-hidden shadow-sm flex-shrink-0">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=a07954&color=fff"
                                alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="ml-3 flex-1 text-left min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        </div>
                        <x-icons.chevron-down class="h-4 w-4 text-gray-400 transform transition-all duration-200"
                            x-bind:class="{ 'rotate-180 -translate-y-2': profileOpen }" />
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="profileOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" style="display: none;"
                        class="absolute bottom-full left-2 right-2 mb-2 bg-white rounded-xl shadow-[0_4px_20px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden z-50">

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-[#F7F4F0] hover:text-primary transition-colors">
                            <x-icons.profile class="mr-3 h-4 w-4" />
                            Profil Saya
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors border-t border-gray-100">
                                <x-icons.logout class="mr-3 h-4 w-4" />
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden bg-[#F7F7F5]">

            <!-- Mobile Header -->
            <div
                class="lg:hidden flex items-center gap-3 p-4 bg-white shadow-[0_1px_10px_rgba(0,0,0,0.02)] border-b border-gray-100 z-10">

                <button @click="sidebarOpen = true"
                    class="p-2 -ml-2 text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none">
                    <x-icons.menu class="w-6 h-6" />
                </button>

                <div class="flex items-center gap-2">
                    <x-icons.logo class="w-152 h-45" />
                </div>

            </div>

            <!-- Area Konten Utama -->
            <div class="flex-1 overflow-y-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>

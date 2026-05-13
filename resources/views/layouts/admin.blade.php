<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ruang Tenang</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- Vite (Tailwind + JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#F9F7F4] font-sans antialiased text-gray-800" x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/50 lg:hidden" 
         @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-50 w-72 bg-white flex flex-col transition-transform duration-300 lg:translate-x-0 border-r border-[#e8dbce]/50">
        
        <!-- Logo Area -->
        <div class="px-8 pt-10 pb-8">
            <h1 class="text-2xl font-serif font-bold text-[#a07954]">RuangTenang</h1>
            <p class="text-sm text-gray-500 mt-1">Panel Administrasi</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 space-y-2 mt-4">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-[#a07954] font-semibold bg-[#FAF8F5]' : 'text-gray-500 hover:text-[#a07954] hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </a>
            
            <a href="{{ route('admin.encyclopedia.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.encyclopedia.*') ? 'text-[#a07954] font-semibold bg-[#FAF8F5]' : 'text-gray-500 hover:text-[#a07954] hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Kelola Ensiklopedia
            </a>
        </nav>

        <!-- Logout -->
        <div class="p-4 mb-4">
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-72 min-h-screen flex flex-col">
        <!-- Mobile Header -->
        <header class="lg:hidden bg-white border-b border-[#e8dbce]/50 px-4 py-4 flex items-center justify-between z-30">
            <h1 class="text-xl font-serif font-bold text-[#a07954]">RuangTenang</h1>
            <button @click="sidebarOpen = true" class="text-gray-500 hover:text-[#a07954] focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 lg:p-10">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>

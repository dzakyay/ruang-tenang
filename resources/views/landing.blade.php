<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RuangTenang - Temukan Ketenangan di Kebisingan Hidup</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('Logo.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-background text-gray-800">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-background/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <x-icons.logo class="w-152 h-45" />
                </div>

                <!-- Desktop Menu -->
                <div x-data="{ active: '' }" class="hidden md:flex space-x-8 items-center">
                    <a href="#tentang" @click="active = 'tentang'"
                        :class="active === 'tentang' ? 'text-primary border-primary' : 'text-gray-600 border-transparent hover:text-primary'"
                        class="text-sm font-medium border-b-2 pb-1 transition-colors">Tentang
                        Kami</a>
                    <a href="#fitur" @click="active = 'fitur'"
                        :class="active === 'fitur' ? 'text-primary border-primary' : 'text-gray-600 border-transparent hover:text-primary'"
                        class="text-sm font-medium border-b-2 pb-1 transition-colors">Fitur</a>
                </div>

                <!-- Right Menu / CTA -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-sm font-medium text-gray-600 hover:text-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-600 hover:text-primary hidden sm:block">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-primary-dark transition shadow-sm">
                            Mulai Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="tentang" class="relative pt-20 pb-20 lg:pt-28 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-8">

                <!-- Left Content -->
                <div class="lg:w-1/2 flex flex-col items-start text-left">
                    <div
                        class="inline-flex items-center px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-semibold tracking-wide uppercase mb-6">
                        #1 Aplikasi Kesejahteraan Mental
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-serif font-bold text-gray-900 leading-tight mb-6">
                        Temukan<br>Ketenangan di<br>Kebisingan<br>Hidup
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-lg leading-relaxed">
                        Berikan diri Anda ruang untuk bernapas. Temukan keseimbangan emosional melalui panduan ahli dan
                        teknologi yang dirancang untuk kedamaian Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-medium rounded-lg text-white bg-primary hover:bg-primary-dark transition shadow-md">
                            Mulai Sekarang
                        </a>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="lg:w-1/2 relative w-full mt-10 lg:mt-0">
                    <div
                        class="relative rounded-[2rem] overflow-hidden shadow-2xl aspect-[4/5] sm:aspect-square lg:aspect-[4/5]">
                        <img src="{{ asset('images/hero_image.png') }}" alt="Stones in water"
                            class="absolute inset-0 w-full h-full object-cover">

                        <!-- Glassmorphism Quote -->
                        <div
                            class="absolute bottom-6 left-6 right-6 lg:bottom-10 lg:left-10 lg:right-10 bg-white/20 backdrop-blur-xl border border-white/30 p-6 rounded-2xl shadow-lg">
                            <p class="text-white font-medium text-sm lg:text-base leading-relaxed italic">
                                "Ketenangan bukanlah saat Anda jauh dari masalah. Ketenangan adalah saat Anda berada di
                                tengah masalah namun pikiran Anda tetap tenang."
                            </p>
                        </div>
                    </div>
                    <!-- Decorative Element -->
                    <div class="absolute -z-10 -top-10 -right-10 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
        <!-- Background Gradient -->
        <div
            class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-orange-50/50 via-background to-background -z-20">
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Pintu Menuju Ketenanganmu</h2>
                <div class="w-24 h-1 bg-primary/30 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="bg-background rounded-3xl p-8 hover:-translate-y-2 transition duration-300 shadow-sm hover:shadow-md">
                    <div class="w-14 h-14 bg-primary/20 rounded-2xl flex items-center justify-center mb-6 text-primary">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-serif text-gray-900 mb-3">Jurnal Refleksi</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Tuliskan pikiran Anda untuk menjernihkan pikiran. Ruang aman untuk memproses emosi setiap hari.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-background rounded-3xl p-8 hover:-translate-y-2 transition duration-300 shadow-sm hover:shadow-md">
                    <div class="w-14 h-14 bg-primary/20 rounded-2xl flex items-center justify-center mb-6 text-primary">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-serif text-gray-900 mb-3">Pelacak Suasana</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Catat dan lacak suasana Anda untuk memahami diri sendiri lebih lanjut dari pola emosi harian.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-background rounded-3xl p-8 hover:-translate-y-2 transition duration-300 shadow-sm hover:shadow-md">
                    <div class="w-14 h-14 bg-primary/20 rounded-2xl flex items-center justify-center mb-6 text-primary">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold font-serif text-gray-900 mb-3">Ensiklopedia Perasaan</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Kenali perasaan Anda jauh lebih dalam dengan definisi dan penjelasan komprehensif tentang emosi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-primary/10 rounded-[3rem] p-12 lg:p-20 text-center">
                <h2 class="text-4xl lg:text-5xl font-serif font-bold text-gray-900 mb-6">Siap untuk memulai
                    perjalananmu?</h2>
                <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan orang lainnya yang telah menemukan kedamaian batin mereka kembali.
                </p>
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-medium rounded-xl text-white bg-primary hover:bg-primary-dark transition shadow-lg hover:shadow-xl">
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white pt-16 pb-8 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-4 flex flex-col items-center text-center">
                    <div class="flex justify-center items-center gap-2 mb-4">
                        <x-icons.logo class="w-152 h-45" />
                    </div>
                    <p class="text-gray-500 text-sm max-w-sm leading-relaxed">
                        Misi kami adalah mendemokratisasi akses ke kesehatan mental yang berkualitas dan penuh kasih.
                    </p>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-400">© {{ date('Y') }} RuangTenang. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>
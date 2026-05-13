<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Ruang Tenang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F9F7F4] font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden w-full max-w-5xl flex flex-col md:flex-row min-h-[600px]">

        <!-- Left Side -->
        <div class="w-full md:w-[45%] relative hidden md:block">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80"
                 alt="Admin" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 bg-gradient-to-t from-black/80 to-transparent"></div>
            <div class="absolute inset-0 p-10 flex flex-col justify-end text-white">
                <p class="font-serif italic text-lg leading-relaxed mb-4">
                    "Every scar is proof that you healed stronger than before..."
                </p>
                <h2 class="text-3xl font-serif font-bold mb-2">RuangTenang</h2>
                <p class="text-white/80 text-sm">Temukan kedamaian dalam setiap langkah kecil yang kamu ambil hari ini.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full md:w-[55%] p-10 lg:p-16 flex flex-col justify-center">
            <div class="max-w-md w-full mx-auto">

                <h1 class="text-3xl lg:text-4xl font-serif font-bold text-[#a07954] mb-10 text-center md:text-left">
                    Selamat Datang Admin
                </h1>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-600 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3.5 text-gray-800 focus:ring-2 focus:ring-[#a07954] outline-none transition"
                               placeholder="nama@email.com" required autofocus>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-semibold text-gray-600">Kata Sandi</label>
                        </div>
                        <div class="relative" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" id="password" name="password"
                                   class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3.5 text-gray-800 focus:ring-2 focus:ring-[#a07954] outline-none transition"
                                   placeholder="••••••••" required>
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-[#b89b82] text-white font-medium py-3.5 rounded-xl hover:bg-[#a07954] hover:-translate-y-0.5 transition duration-300 shadow-md">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

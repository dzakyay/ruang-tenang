<x-guest-layout>
    <div class="w-full max-w-sm mx-auto">
        <h2 class="text-3xl font-bold font-serif text-gray-900 mb-2">Buat Akun<br>Baru</h2>
        <p class="text-sm text-gray-500 mb-8">Mari mulai perjalanan menuju ketenangan pikiranmu.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-5">
                <label for="name" class="block text-xs font-semibold text-primary mb-1">Nama Lengkap</label>
                <div class="relative">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" class="block w-full px-0 py-2 border-0 border-b border-gray-200 focus:border-primary focus:ring-0 text-sm bg-transparent placeholder-gray-300">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-5">
                <label for="email" class="block text-xs font-semibold text-primary mb-1">Email</label>
                <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com" class="block w-full px-0 py-2 border-0 border-b border-gray-200 focus:border-primary focus:ring-0 text-sm bg-transparent placeholder-gray-300">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-xs font-semibold text-primary mb-1">Kata Sandi</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" class="block w-full px-0 py-2 border-0 border-b border-gray-200 focus:border-primary focus:ring-0 text-sm bg-transparent placeholder-gray-300 tracking-widest">
                    <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-8">
                <label for="password_confirmation" class="block text-xs font-semibold text-primary mb-1">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" class="block w-full px-0 py-2 border-0 border-b border-gray-200 focus:border-primary focus:ring-0 text-sm bg-transparent placeholder-gray-300 tracking-widest">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full py-3 px-4 bg-[#A07954] hover:bg-[#8e6a49] text-white font-medium rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A07954]">
                    Daftar
                </button>
            </div>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Sudah memiliki akun? <a href="{{ route('login') }}" class="font-bold text-[#A07954] hover:underline">Masuk</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>

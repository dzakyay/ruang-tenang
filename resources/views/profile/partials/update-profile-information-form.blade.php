<section>
    <header class="flex items-center gap-3 mb-6">
        <svg class="w-5 h-5 text-[#614d3c]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
        </svg>
        <h2 class="text-xl font-serif font-bold text-[#614d3c]">
            Informasi Pribadi
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Nama Lengkap -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input id="name" name="name" type="text" 
                   class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3.5 text-gray-800 focus:ring-2 focus:ring-[#a07954] outline-none transition shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Nama Lengkap Anda" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Alamat Email -->
        <div>
            <div class="flex justify-between items-end mb-2">
                <label for="email" class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <span class="bg-yellow-100 text-yellow-800 text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1 border border-yellow-200">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Belum Verifikasi
                    </span>
                @else
                    <span class="bg-[#e8f5e9] text-[#2e7d32] text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1 border border-[#c8e6c9]">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Terverifikasi
                    </span>
                @endif
            </div>

            <div class="relative">
                <input id="email" name="email" type="email" 
                       class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3.5 text-gray-800 focus:ring-2 focus:ring-[#a07954] outline-none transition shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] {{ ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()) ? 'pr-32' : '' }}" 
                       value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="alamat@email.com" />
                
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <button form="send-verification" class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#2e7d32] hover:bg-[#1b5e20] text-white text-xs font-semibold px-4 py-2 rounded-lg transition shadow-sm">
                        Verifikasi Email
                    </button>
                @endif
            </div>
            
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600">
                        {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="flex items-center justify-end gap-4 pt-2">
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-medium text-green-600">
                    {{ __('Perubahan disimpan.') }}
                </p>
            @endif

            <button type="submit" class="bg-[#b89b82] text-white font-medium px-6 py-3 rounded-xl hover:bg-[#a07954] hover:-translate-y-0.5 transition duration-300 shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>

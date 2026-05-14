<x-app-layout>
    <div class="px-6 lg:px-10 py-10 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-10 lg:mb-14">
            <h1 class="text-3xl lg:text-4xl font-serif text-[#614d3c] mb-3 font-bold">Pengaturan Profil</h1>
            <p class="text-gray-600">Kelola informasi pribadimu dengan tenang. Perubahan di sini akan langsung<br class="hidden lg:block"> tersimpan di ruang amanmu.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-10 lg:gap-16">
            <!-- Left Column: User Info -->
            <div class="w-full lg:w-1/3 flex flex-col items-start lg:pt-4">
                <div class="w-40 h-40 rounded-full border-8 border-white shadow-xl overflow-hidden mb-6 relative bg-gray-100">
                    <img src="{{ Auth::user()->profile_picture_url }}"
                         alt="{{ Auth::user()->name }}"
                         class="w-full h-full object-cover absolute inset-0">
                </div>
                <h2 class="text-2xl font-serif font-bold text-[#1c1917] tracking-tight">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-gray-500 mt-1.5">Anggota sejak {{ Auth::user()->created_at->translatedFormat('F Y') }}</p>

            </div>

            <!-- Right Column: Forms -->
            <div class="w-full lg:w-2/3 space-y-8 lg:space-y-10">
                <!-- Informasi Pribadi -->
                <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e8dbce]/30">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Keamanan -->
                <div class="bg-white rounded-[2rem] p-8 lg:p-10 shadow-[0_8px_30px_rgba(0,0,0,0.02)] border border-[#e8dbce]/30">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Hapus Akun -->
                <div class="bg-[#FFF8F8] rounded-[2rem] p-8 lg:p-10 border border-red-100">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<section class="space-y-6">
    <header class="flex items-center gap-4">
        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div>
            <h2 class="text-xl font-serif font-bold text-[#b71c1c]">
                Hapus Akun
            </h2>
        </div>
    </header>

    <p class="text-sm text-red-700/80 leading-relaxed ml-14">
        Tindakan ini tidak dapat dibatalkan. Semua data jurnal, riwayat meditasi, dan pengaturan preferensimu akan dihapus secara permanen dari ruang aman kami.
    </p>

    <div class="ml-14 mt-4">
        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="bg-[#C62828] text-white font-medium px-6 py-3 rounded-xl hover:bg-[#b71c1c] transition duration-300 shadow-md">
            Hapus Akun Secara Permanen
        </button>
    </div>

    <!-- Modal Konfirmasi -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-serif font-bold text-gray-900 mb-4">
                Apakah Anda yakin ingin menghapus akun ini?
            </h2>

            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                Sekali akun dihapus, semua sumber daya dan datanya akan terhapus permanen. Masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun.
            </p>

            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                <input id="password" name="password" type="password" 
                       class="w-full bg-[#FAF8F5] border-0 rounded-xl px-4 py-3 text-gray-800 focus:ring-2 focus:ring-red-500 outline-none transition shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]" 
                       placeholder="Kata Sandi Anda" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-600" />
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')"
                        class="bg-white border border-gray-300 text-gray-700 font-medium px-6 py-3 rounded-xl hover:bg-gray-50 transition shadow-sm">
                    Batal
                </button>

                <button type="submit"
                        class="bg-[#C62828] text-white font-medium px-6 py-3 rounded-xl hover:bg-[#b71c1c] transition shadow-md">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>

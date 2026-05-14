<x-guest-layout>
    <div class="w-full max-w-sm mx-auto">
        <h2 class="text-3xl font-bold font-serif text-gray-900 my-6">Verifikasi Email Anda</h2>
        
        <div class="mb-6 text-sm text-gray-600 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkannya kembali.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 font-medium text-sm text-green-600 p-4 bg-green-50 rounded-lg">
                Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
            </div>
        @endif

        <div class="mt-8 flex flex-col gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 px-4 bg-[#A07954] hover:bg-[#8e6a49] text-white font-medium rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#A07954]">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
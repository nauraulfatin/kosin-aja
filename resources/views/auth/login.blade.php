<x-guest-layout>
    <div class="flex min-h-screen bg-[#FDFAF4]">
        
        {{-- Kolom Kiri: Foto Pintu --}}
        <div class="hidden lg:block w-2/4 relative">
            <img 
                src="{{ asset('pintu-kosin.jpeg') }}" 
                alt="KosinAja!" 
                class="absolute inset-0 w-full h-full object-cover"
            >
        </div>

        {{-- Kolom Kanan: Form --}}
        <div class="w-full lg:w-3/4 flex items-center justify-center px-10 py-12">
            <div class="w-full max-w-lg">

                {{-- Logo --}}
                <div class="flex items-center mb-6">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                    <span class="text-2xl font-bold text-[#0F0937]"> KosinAja!</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-xl font-bold text-[#0F0937] mb-1">Selamat Datang</h1>
                <p class="text-lg text-gray-500 mb-8">Masuk dan lanjutkan aktivitas Anda di KosinAja!</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="text-s text-gray-500 mb-1" />
                        <x-text-input 
                            id="email" 
                            class="block w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:ring-[#6C8B6B] focus:border-[#6C8B6B]" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus
                            placeholder="Email"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-s" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-2">
                        <x-input-label for="password" :value="__('Password')" class="text-s text-gray-500 mb-1" />
                        <div class="relative">
                            <x-text-input 
                                id="password" 
                                class="block w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:ring-[#6C8B6B] focus:border-[#6C8B6B] pr-10" 
                                type="password" 
                                name="password" 
                                required
                                placeholder="Password"
                            />
                            <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>

                    {{-- Remember Me & Lupa Password --}}
                    <div class="flex items-center justify-between mb-8">
                        <label class="flex items-center gap-2 text-s text-gray-500">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#6C8B6B]">
                            Ingat Saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-s text-[#6C8B6B] hover:underline">
                                Lupa Password
                            </a>
                        @endif
                    </div>

                    {{-- Tombol Masuk --}}
                    <button 
                        type="submit" 
                        class="w-full bg-[#6C8B6B] hover:bg-[#5a7a59] text-white font-semibold py-4 rounded-lg transition duration-200 text-base"
                    >
                        Masuk
                    </button>

                    {{-- Link Register --}}
                    <p class="text-center text-s text-gray-500 mt-4">
                        Belum Punya Akun? 
                        <a href="{{ route('register') }}" class="text-[#6C8B6B] font-semibold hover:underline">Daftar Sekarang</a>
                    </p>

                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>
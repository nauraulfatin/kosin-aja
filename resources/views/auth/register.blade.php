<x-guest-layout>
    <div class="flex min-h-screen bg-[#FDFAF4]">
        
        {{-- Kolom Kiri: Form --}}
<div class="w-full lg:w-3/4 flex items-center justify-center px-10 py-12">
            <div class="w-full max-w-lg">

                {{-- Logo --}}
                <div class="flex items-center mb-6">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                    <span class="text-2xl font-bold text-[#0F0937]">KosinAja!</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-xl font-bold text-[#0F0937] mb-1">Kelola Kos Jadi Lebih Mudah</h1>
                <p class="text-lg text-gray-500 mb-8">Daftarkan kos Anda dan mulai kelola penghuni dengan lebih praktis</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nama Lengkap & No. Telp (2 kolom) --}}
                    <div class="flex gap-4 mb-4">
                        <div class="flex-1">
                            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-s text-gray-500 mb-1" />
                            <x-text-input 
                                id="name" 
                                class="block w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:ring-[#6C8B6B] focus:border-[#6C8B6B]" 
                                type="text" 
                                name="name" 
                                :value="old('name')" 
                                required autofocus 
                                placeholder="Nama Lengkap"
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="phone" :value="__('No. Telp')" class="text-s text-gray-500 mb-1" />
                            <x-text-input 
                                id="phone" 
                                class="block w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:ring-[#6C8B6B] focus:border-[#6C8B6B]" 
                                type="text" 
                                name="phone" 
                                :value="old('phone')" 
                                placeholder="No. Telp"
                            />
                            <x-input-error :messages="$errors->get('phone')" class="mt-1 text-s" />
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="text-ss text-gray-500 mb-1" />
                        <x-text-input 
                            id="email" 
                            class="block w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:ring-[#6C8B6B] focus:border-[#6C8B6B]" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            placeholder="Email"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-s" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-4 relative">
                        <x-input-label for="password" :value="__('Password')" class="text-s text-gray-500 mb-1" />
                        <div class="relative">
                            <x-text-input 
                                id="password" 
                                class="block w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:ring-[#6C8B6B] focus:border-[#6C8B6B] pr-10" 
                                type="password" 
                                name="password" 
                                required 
                                autocomplete="new-password"
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

                    {{-- Confirm Password --}}
                    <div class="mb-6 relative">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-s text-gray-500 mb-1" />
                        <div class="relative">
                            <x-text-input 
                                id="password_confirmation" 
                                class="block w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:ring-[#6C8B6B] focus:border-[#6C8B6B] pr-10" 
                                type="password" 
                                name="password_confirmation" 
                                required 
                                placeholder="Confirm Password"
                            />
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-s" />
                    </div>

                    {{-- Tombol Buat Akun --}}
                    <button 
                        type="submit" 
                        class="w-full bg-[#6C8B6B] hover:bg-[#5a7a59] text-white font-semibold py-4 rounded-lg transition duration-200 text-base"
                    >
                        Buat Akun
                    </button>

                    {{-- Link Login --}}
                    <p class="text-center text-s text-gray-500 mt-4">
                        Sudah Punya Akun? 
                        <a href="{{ route('login') }}" class="text-[#6C8B6B] font-semibold hover:underline">Masuk</a>
                    </p>

                </form>
            </div>
        </div>

        {{-- Kolom Kanan: Foto Pintu --}}
        <div class="hidden lg:block w-2/4 relative">
            <img 
                src="{{ asset('pintu-login.png') }}" 
                alt="KosinAja!" 
                class="absolute inset-0 w-full h-full object-cover"
            >
        </div>

    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>
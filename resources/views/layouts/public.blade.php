<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KosinAja!')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #FDFBF7;
            color: #1B2B1D;
        }

        h1,h2,h3,h4,h5,h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    @yield('styles')
</head>

<body class="overflow-x-hidden">

    {{-- NAVBAR --}}
    <nav class="fixed top-0 left-0 right-0 z-50
                bg-white/85 backdrop-blur-xl
                border-b border-[#edf1ed]">

        <div class="max-w-7xl mx-auto
                    px-6 lg:px-8
                    h-[84px]
                    flex items-center justify-between">

            {{-- LOGO --}}
            <a href="{{ route('home') }}"
               class="flex items-center gap-3">

                <img src="{{ asset('logo.png') }}"
                     alt="KosinAja"
                     class="w-11 h-11 object-contain">

                <span class="text-[30px] font-extrabold text-[#102313]">
                    KosinAja!
                </span>

            </a>

            {{-- MENU --}}
            <ul class="hidden lg:flex items-center gap-12">

                <li>
    <a href="{{ route('home') }}"
       class="relative
              text-[15px]
              font-semibold
              transition-all duration-300
              pb-2

              {{ request()->is('/') 
                ? 'text-[#6C8B6B]' 
                : 'text-[#314233] hover:text-[#6C8B6B]' }}">

        Beranda

        @if(request()->is('/'))

            <span class="absolute left-0 bottom-0
                         w-full h-[3px]
                         rounded-full
                         bg-[#6C8B6B]">
            </span>

        @endif

    </a>

</li>

                <li>

    <a href="{{ route('tentang') }}"
       class="relative
              text-[15px]
              font-semibold
              transition-all duration-300
              pb-2

              {{ request()->is('tentang') 
                ? 'text-[#6C8B6B]' 
                : 'text-[#314233] hover:text-[#6C8B6B]' }}">

        Tentang

        @if(request()->is('tentang'))

            <span class="absolute left-0 bottom-0
                         w-full h-[3px]
                         rounded-full
                         bg-[#6C8B6B]">
            </span>

        @endif

    </a>

</li>

                <li>

    <a href="{{ route('hubungi') }}"
       class="relative
              text-[15px]
              font-semibold
              transition-all duration-300
              pb-2

              {{ request()->is('hubungi') 
                ? 'text-[#6C8B6B]' 
                : 'text-[#314233] hover:text-[#6C8B6B]' }}">

        Hubungi

        @if(request()->is('hubungi'))

            <span class="absolute left-0 bottom-0
                         w-full h-[3px]
                         rounded-full
                         bg-[#6C8B6B]">
            </span>

        @endif

    </a>

</li>

            </ul>

            {{-- ACTION --}}
            <div class="flex items-center gap-4">

                @auth

                    <span class="hidden md:block text-[15px] text-[#526453] font-medium">
                        Halo, {{ auth()->user()->name }}
                    </span>

                    @if(auth()->user()->role == 'super_admin')

                        <a href="{{ route('superadmin.dashboard') }}"
                           class="px-6 py-3
                                  rounded-2xl
                                  border border-[#6C8B6B]
                                  text-[#6C8B6B]
                                  font-semibold
                                  hover:bg-[#6C8B6B]
                                  hover:text-white
                                  transition-all duration-200">

                            Dashboard

                        </a>

                    @elseif(auth()->user()->role == 'admin')

                        <a href="{{ route('admin.dashboard') }}"
                           class="px-6 py-3
                                  rounded-2xl
                                  border border-[#6C8B6B]
                                  text-[#6C8B6B]
                                  font-semibold
                                  hover:bg-[#6C8B6B]
                                  hover:text-white
                                  transition-all duration-200">

                            Dashboard

                        </a>

                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="px-6 py-3
                                       rounded-2xl
                                       bg-[#6C8B6B]
                                       hover:bg-[#587357]
                                       text-white
                                       font-semibold
                                       transition-all duration-200">

                            Logout

                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}"
                       class="px-6 py-3
                              rounded-2xl
                              border border-[#6C8B6B]
                              text-[#6C8B6B]
                              font-semibold
                              hover:bg-[#6C8B6B]
                              hover:text-white
                              transition-all duration-200">

                        Masuk

                    </a>

                @endauth

            </div>

        </div>

    </nav>

    {{-- CONTENT --}}
    <main class="pt-[84px]">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-[#162818] mt-24 overflow-hidden relative">

        {{-- BACKGROUND --}}
        <div class="absolute inset-0 opacity-10">
            <img src="{{ asset('footer.png') }}"
                 class="w-full h-full object-cover"
                 alt="">
        </div>

        <div class="relative z-10
                    max-w-7xl mx-auto
                    px-6 lg:px-8
                    py-20">

            <div class="grid lg:grid-cols-4 gap-14">

                {{-- BRAND --}}
                <div class="lg:col-span-2">

                    <div class="flex items-center gap-3 mb-6">

                        <img src="{{ asset('logo.png') }}"
                             class="w-12 h-12 object-contain">

                        <h2 class="text-3xl font-extrabold text-white">
                            KosinAja!
                        </h2>

                    </div>

                    <p class="text-[#c7d5c8] leading-8 max-w-md">
                        Platform pencarian dan pengelolaan kos modern yang membantu pencari kos menemukan hunian nyaman dengan cepat, aman, dan terpercaya.
                    </p>

                </div>

                {{-- MENU --}}
                <div>

                    <h3 class="text-white font-bold text-lg mb-6">
                        Navigasi
                    </h3>

                    <div class="flex flex-col gap-4">

                        <a href="{{ route('home') }}"
                           class="text-[#c7d5c8] hover:text-white transition">

                            Beranda

                        </a>

                        <a href="{{ route('hubungi') }}"
                           class="text-[#c7d5c8] hover:text-white transition">

                            Hubungi Kami

                        </a>

                        <a href="{{ route('tentang') }}"
                           class="text-[#c7d5c8] hover:text-white transition">

                            Tentang Kami

                        </a>

                    </div>

                </div>

                {{-- CONTACT --}}
                <div>

                    <h3 class="text-white font-bold text-lg mb-6">
                        Kontak
                    </h3>

                    <div class="space-y-5">

                        <div class="flex items-start gap-3">

                            <div class="w-10 h-10 rounded-xl bg-[#223725]
                                        flex items-center justify-center">

                                📍

                            </div>

                            <p class="text-[#c7d5c8] leading-7">
                                Banyuwangi, Indonesia
                            </p>

                        </div>

                        <div class="flex items-start gap-3">

                            <div class="w-10 h-10 rounded-xl bg-[#223725]
                                        flex items-center justify-center">

                                ✉️

                            </div>

                            <p class="text-[#c7d5c8]">
                                admin@kosinaja.id
                            </p>

                        </div>

                        <div class="flex items-start gap-3">

                            <div class="w-10 h-10 rounded-xl bg-[#223725]
                                        flex items-center justify-center">

                                ☎️

                            </div>

                            <p class="text-[#c7d5c8]">
                                (+62) 82264676843
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- COPYRIGHT --}}
            <div class="border-t border-[#2b412d]
                        mt-16 pt-8
                        text-center">

                <p class="text-[#91A392] text-sm">
                    © {{ date('Y') }} KosinAja! — Orbit
                </p>

            </div>

        </div>

    </footer>

</body>
</html>
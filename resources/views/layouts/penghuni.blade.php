<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosinAja! - Penghuni</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F6F1] font-sans">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-60 bg-white flex flex-col justify-between py-6 px-4 shadow-sm fixed h-full">

        <div>

            {{-- LOGO --}}
            <div class="flex items-center gap-2 mb-10 px-2">

                <img src="{{ asset('logo.png') }}"
                     alt="Logo"
                     class="h-10 w-10 object-contain">

                <span class="text-xl font-bold text-[#0F0937]">
                    KosinAja!
                </span>

            </div>

            {{-- MENU --}}
            <nav class="flex flex-col gap-1">

                {{-- DASHBOARD --}}
                <a href="{{ route('penghuni.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('penghuni.dashboard') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />

                    </svg>

                    Dashboard

                </a>

                {{-- PEMBAYARAN --}}
                <a href="{{ route('penghuni.pembayaran.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   hover:bg-gray-100 text-gray-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 9V7a5 5 0 00-10 0v2M5 9h14l1 10H4L5 9z" />

                    </svg>

                    Pembayaran

                </a>

                {{-- ATURAN --}}
                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   hover:bg-gray-100 text-gray-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                    </svg>

                    Aturan Kos

                </a>

                {{-- ADUAN --}}
                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   hover:bg-gray-100 text-gray-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 10h.01M12 10h.01M16 10h.01M9 16h6" />

                    </svg>

                    Aduan

                </a>

                {{-- PROFIL --}}
<a href="{{ route('penghuni.profil.index') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
   hover:bg-gray-100 text-gray-600
   {{ request()->routeIs('penghuni.profil.*') ? 'bg-[#F8F5F0] text-[#6C8B6B]' : '' }}">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-5 w-5"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M5.121 17.804A9 9 0 1118.364 4.56 9 9 0 015.12 17.804z" />

    </svg>

    Profil

</a>

            </nav>

        </div>

        {{-- LOGOUT --}}
        <div class="px-2">

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="flex items-center gap-3 text-red-500 hover:text-red-700 text-sm font-medium px-4 py-3 w-full">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />

                    </svg>

                    Logout

                </button>

            </form>

        </div>

    </aside>

    {{-- CONTENT --}}
    <main class="ml-60 flex-1 p-8">

        @yield('content')

    </main>

</div>

</body>
</html>
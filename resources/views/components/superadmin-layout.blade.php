<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosinAja! - Super Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-60 bg-white flex flex-col justify-between py-6 px-4 shadow-sm fixed h-full">
        
        {{-- Logo --}}
        <div>
            <div class="flex items-center gap-2 mb-10 px-2">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                <span class="text-xl font-bold text-[#0F0937]">KosinAja!</span>
            </div>

            {{-- Menu --}}
            <nav class="flex flex-col gap-1">
                <a href="{{ route('superadmin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('superadmin.dashboard') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('superadmin.pengajuan') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('superadmin.pengajuan') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Daftar Pengajuan
                </a>

                <a href="{{ route('superadmin.riwayat') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('superadmin.riwayat') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Riwayat
                </a>

                <a href="{{ route('superadmin.admin') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('superadmin.admin') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Daftar Admin Kos
                </a>
            </nav>
        </div>

        {{-- Logout --}}
        <div class="px-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 text-red-500 hover:text-red-700 text-sm font-medium px-4 py-3 w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="ml-60 flex-1 p-8">
        {{ $slot }}
    </main>

</div>

</body>
</html>
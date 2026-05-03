<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosinAja! - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-60 bg-white flex flex-col justify-between py-6 px-4 shadow-sm fixed h-full">
        
        <div>
            {{-- Logo --}}
            <div class="flex items-center gap-2 mb-10 px-2">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                <span class="text-xl font-bold text-[#0F0937]">KosinAja!</span>
            </div>

            {{-- Menu --}}
            <nav class="flex flex-col gap-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('admin.dashboard') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.kamar.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('admin.kamar.*') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Daftar Kamar
                </a>

                <a href="{{ route('admin.penghuni.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('admin.penghuni.*') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Penghuni
                </a>

                <a href="{{ route('admin.pembayaran.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('admin.pembayaran.*') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Pembayaran
                </a>

                <a href="{{ route('admin.aduan.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('admin.aduan.*') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Tanggapan Aduan
                </a>

                <a href="{{ route('admin.aturan.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('admin.aturan.*') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Aturan Kos
                </a>

                <a href="{{ route('admin.informasi.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium
                   {{ request()->routeIs('admin.informasi.*') ? 'bg-[#D6E5D6] text-[#3a5c3a]' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Kos
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

    {{-- KONTEN --}}
    <main class="ml-60 flex-1 p-8">
        {{ $slot }}
    </main>

</div>

</body>
</html>
@extends('layouts.penghuni')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-end mb-6">

    <div class="flex items-center gap-2 text-gray-700 font-medium">

        <span>
            Halo, {{ auth()->user()->name }}
        </span>

        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-6 w-6"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5.121 17.804A9 9 0 1118.364 4.56 9 9 0 015.12 17.804z" />

        </svg>

    </div>

</div>

{{-- CARD --}}
<div class="bg-white rounded-2xl shadow-sm
            border border-gray-100
            max-w-4xl mx-auto p-10">

    {{-- TITLE --}}
    <h1 class="text-2xl font-bold text-[#0F0937] mb-8">

        Profil Penghuni

    </h1>

    {{-- CONTENT --}}
    <div class="grid grid-cols-2 gap-10">

        {{-- KIRI --}}
        <div class="space-y-6">

            {{-- NAMA --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    Nama Lengkap
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937]">

                    {{ $penghuni->nama }}

                </h2>

            </div>

            {{-- NIK --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    NIK
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937]">

                    {{ $penghuni->nik }}

                </h2>

            </div>

            {{-- EMAIL --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    Email
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937]">

                    {{ $penghuni->email }}

                </h2>

            </div>

            {{-- NOMOR HP --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    Nomor HP
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937]">

                    {{ $penghuni->no_hp }}

                </h2>

            </div>

            {{-- ALAMAT --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    Alamat
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937] leading-relaxed">

                    {{ $penghuni->alamat }}

                </h2>

            </div>

        </div>

        {{-- KANAN --}}
        <div class="space-y-6">

            {{-- KAMAR --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    Nomor Kamar
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937]">

                    Kamar {{ $penghuni->kamar->nomor_kamar }}

                </h2>

            </div>

            {{-- HARGA --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    Harga Kamar
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937]">

                    Rp {{ number_format($penghuni->kamar->harga, 0, ',', '.') }}

                </h2>

            </div>

            {{-- TANGGAL MASUK --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    Tanggal Masuk
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937]">

                    {{ \Carbon\Carbon::parse($penghuni->tanggal_masuk)->translatedFormat('d F Y') }}

                </h2>

            </div>

            {{-- MASA KOS --}}
            <div>

                <p class="text-sm text-gray-500 mb-1">
                    Masa Kos
                </p>

                <h2 class="text-lg font-semibold text-[#0F0937]">

                    {{ $penghuni->masa_kos }} Bulan

                </h2>

            </div>

            {{-- STATUS --}}
            <div>

                <p class="text-sm text-gray-500 mb-2">
                    Status
                </p>

                <span class="bg-[#D6E5D6]
                             text-[#3a5c3a]
                             px-4 py-2 rounded-full
                             text-sm font-medium">

                    Aktif

                </span>

            </div>

        </div>

    </div>

    {{-- BUTTON --}}
    <div class="flex justify-end mt-10">

        <a href="{{ route('penghuni.profil.edit') }}"
           class="bg-[#6C8B6B]
                  hover:bg-[#587357]
                  text-white px-6 py-3
                  rounded-xl transition">

            Edit Profil

        </a>

    </div>

</div>

@endsection
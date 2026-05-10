@extends('layouts.penghuni')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-2xl font-bold text-[#0F0937]">
            Edit Profil
        </h1>

        <p class="text-gray-500 mt-1">
            Perbarui informasi akun penghuni
        </p>

    </div>

</div>

{{-- ERROR --}}
@if ($errors->any())

    <div class="bg-red-100 border border-red-200
                text-red-700 px-5 py-4 rounded-2xl mb-6">

        <ul class="list-disc ml-5 space-y-1">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

{{-- CARD --}}
<div class="bg-white rounded-2xl p-8
            shadow-sm border border-gray-100">

    <form method="POST"
          action="{{ route('penghuni.profil.update') }}">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- NAMA --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama', $penghuni->nama) }}"
                       class="w-full border border-gray-300
                              rounded-xl p-3">

            </div>

            {{-- EMAIL --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>

                <input type="email"
                       value="{{ $penghuni->email }}"
                       readonly
                       class="w-full bg-gray-100 border border-gray-300
                              rounded-xl p-3 text-gray-500">

            </div>

            {{-- NIK --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    NIK
                </label>

                <input type="text"
                       value="{{ $penghuni->nik }}"
                       readonly
                       class="w-full bg-gray-100 border border-gray-300
                              rounded-xl p-3 text-gray-500">

            </div>

            {{-- NOMOR HP --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor HP
                </label>

                <input type="text"
                       name="no_hp"
                       value="{{ old('no_hp', $penghuni->no_hp) }}"
                       class="w-full border border-gray-300
                              rounded-xl p-3">

            </div>

            {{-- KAMAR --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Kamar
                </label>

                <input type="text"
                       value="Kamar {{ $penghuni->kamar->nomor_kamar }}"
                       readonly
                       class="w-full bg-gray-100 border border-gray-300
                              rounded-xl p-3 text-gray-500">

            </div>

            {{-- MASA KOS --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Masa Kos
                </label>

                <input type="text"
                       value="{{ $penghuni->masa_kos }} Bulan"
                       readonly
                       class="w-full bg-gray-100 border border-gray-300
                              rounded-xl p-3 text-gray-500">

            </div>

        </div>

        {{-- ALAMAT --}}
        <div class="mt-6">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Alamat
            </label>

            <textarea name="alamat"
                      rows="4"
                      class="w-full border border-gray-300
                             rounded-xl p-3">{{ old('alamat', $penghuni->alamat) }}</textarea>

        </div>

        {{-- PASSWORD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            {{-- PASSWORD BARU --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Password Baru
                </label>

                <input type="password"
                       name="password"
                       class="w-full border border-gray-300
                              rounded-xl p-3">

            </div>

            {{-- KONFIRMASI --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password
                </label>

                <input type="password"
                       name="password_confirmation"
                       class="w-full border border-gray-300
                              rounded-xl p-3">

            </div>

        </div>

        {{-- BUTTON --}}
        <div class="flex items-center justify-end gap-3 mt-8">

            <a href="{{ route('penghuni.profil.index') }}"
               class="bg-gray-100 hover:bg-gray-200
                      text-gray-700 px-6 py-3 rounded-xl transition">

                Batal

            </a>

            <button type="submit"
                    class="bg-[#6C8B6B]
                           hover:bg-[#587357]
                           text-white px-6 py-3 rounded-xl transition">

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>

@endsection
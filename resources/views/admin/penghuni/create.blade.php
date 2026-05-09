<x-admin-layout>
{{-- Header --}}
<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-2xl font-bold text-[#0F0937]">
            Tambah Penghuni
        </h1>

        <p class="text-gray-500 mt-1">
            Tambahkan data penghuni baru dan akun login penghuni
        </p>
    </div>

    <a href="{{ route('admin.penghuni.index') }}"
       class="bg-gray-100 hover:bg-gray-200
              text-gray-700 px-5 py-3 rounded-xl transition">

        Kembali

    </a>

</div>

{{-- Alert --}}
@if(session('success'))

    <div class="mb-6 bg-green-100 border border-green-200
                text-green-700 px-4 py-3 rounded-xl">

        {{ session('success') }}

    </div>

@endif

{{-- Card --}}
<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">

    <form method="POST"
          action="{{ route('admin.penghuni.store') }}">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            {{-- Nama --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama lengkap"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

                @error('nama')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Email --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

 {{-- Password --}}
<div>
<label class="block text-sm font-medium text-gray-700 mb-2">
    Password Sementara
</label>

<div class="relative">

    <input 
        id="password"
        type="password"
        name="password"
        placeholder="Masukkan password sementara"
        class="block w-full border border-gray-300
               rounded-xl px-4 py-3 pr-10
               text-base
               focus:ring-[#6C8B6B]
               focus:border-[#6C8B6B]"
    />

    <button type="button"
            onclick="togglePassword('password')"
            class="absolute right-3 top-1/2
                   -translate-y-1/2
                   text-gray-400 hover:text-gray-600">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-5 w-5"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                     c4.478 0 8.268 2.943 9.542 7
                     -1.274 4.057-5.064 7-9.542 7
                     -4.477 0-8.268-2.943-9.542-7z" />

        </svg>

    </button>

</div>

@error('password')

    <p class="mt-1 text-sm text-red-500">
        {{ $message }}
    </p>

@enderror
</div>

            {{-- NIK --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    NIK
                </label>

                <input type="text"
                       name="nik"
                       value="{{ old('nik') }}"
                       placeholder="Masukkan NIK"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

                @error('nik')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- No HP --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Telepon
                </label>

                <input type="text"
                       name="no_hp"
                       value="{{ old('no_hp') }}"
                       placeholder="Masukkan nomor telepon"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

                @error('no_hp')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Kamar --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Kamar
                </label>

                <select name="kamar_id"
                        class="w-full border border-gray-300 rounded-xl p-3
                               focus:ring-[#6C8B6B]
                               focus:border-[#6C8B6B]">

                    <option value="">
                        -- Pilih Kamar --
                    </option>

                    @foreach($kamars as $kamar)

                        <option value="{{ $kamar->id }}">

                            Kamar {{ $kamar->nomor_kamar }}

                        </option>

                    @endforeach

                </select>

                @error('kamar_id')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Tanggal Masuk --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Masuk
                </label>

                <input type="date"
                       name="tanggal_masuk"
                       value="{{ old('tanggal_masuk') }}"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

                @error('tanggal_masuk')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Status --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status Penghuni
                </label>

                <select name="status"
                        class="w-full border border-gray-300 rounded-xl p-3
                               focus:ring-[#6C8B6B]
                               focus:border-[#6C8B6B]">

                    <option value="aktif">
                        Aktif
                    </option>

                    <option value="nonaktif">
                        Nonaktif
                    </option>

                </select>

                @error('status')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

        {{-- Alamat --}}
        <div class="mt-6">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Alamat
            </label>

            <textarea name="alamat"
                      rows="4"
                      placeholder="Masukkan alamat lengkap"
                      class="w-full border border-gray-300 rounded-xl p-3
                             focus:ring-[#6C8B6B]
                             focus:border-[#6C8B6B]">{{ old('alamat') }}</textarea>

            @error('alamat')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Button --}}
        <div class="mt-8 flex justify-end">

            <button type="submit"
                    class="bg-[#6C8B6B]
                           hover:bg-[#587357]
                           text-white px-6 py-3 rounded-xl
                           transition duration-200">

                Simpan Penghuni

            </button>

        </div>

    </form>

</div>

<script>

    function togglePassword() {

        const passwordInput =
            document.getElementById('password');

        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

        } else {

            passwordInput.type = 'password';

        }
    }

</script>


</x-admin-layout>

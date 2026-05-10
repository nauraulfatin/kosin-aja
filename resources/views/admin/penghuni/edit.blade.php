<x-admin-layout>

{{-- Header --}}
<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-2xl font-bold text-[#0F0937]">
            Edit Penghuni
        </h1>

        <p class="text-gray-500 mt-1">
            Perbarui data penghuni kos
        </p>

    </div>

    <a href="{{ route('admin.penghuni.index') }}"
       class="bg-gray-100 hover:bg-gray-200
              text-gray-700 px-5 py-3 rounded-xl transition">

        Kembali

    </a>

</div>

{{-- Error --}}
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

{{-- Card --}}
<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">

    <form method="POST"
          action="{{ route('admin.penghuni.update', $penghuni->id) }}">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Nama --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama', $penghuni->nama) }}"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

            </div>

            {{-- Email --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>

                <input type="email"
                       value="{{ $penghuni->email }}"
                       readonly
                       class="w-full bg-gray-100 border border-gray-300
                              rounded-xl p-3 text-gray-500 cursor-not-allowed">

            </div>

            {{-- NIK --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    NIK
                </label>

                <input type="text"
                       name="nik"
                       value="{{ old('nik', $penghuni->nik) }}"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

            </div>

            {{-- No HP --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Telepon
                </label>

                <input type="text"
                       name="no_hp"
                       value="{{ old('no_hp', $penghuni->no_hp) }}"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

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

                    @foreach($kamars as $kamar)

                        <option value="{{ $kamar->id }}"
                            {{ $penghuni->kamar_id == $kamar->id ? 'selected' : '' }}>

                            Kamar {{ $kamar->nomor_kamar }}

                        </option>

                    @endforeach

                </select>

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

                    <option value="aktif"
                        {{ $penghuni->status == 'aktif' ? 'selected' : '' }}>

                        Aktif

                    </option>

                    <option value="nonaktif"
                        {{ $penghuni->status == 'nonaktif' ? 'selected' : '' }}>

                        Nonaktif

                    </option>

                </select>

            </div>

            {{-- Tanggal Masuk --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Masuk
                </label>

                <input type="date"
                       name="tanggal_masuk"
                       value="{{ old('tanggal_masuk', $penghuni->tanggal_masuk) }}"
                       class="w-full border border-gray-300 rounded-xl p-3
                              focus:ring-[#6C8B6B]
                              focus:border-[#6C8B6B]">

            </div>

            {{-- Masa Kos --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Masa Kos
                </label>

                <select name="masa_kos"
                        class="w-full border border-gray-300 rounded-xl p-3
                               focus:ring-[#6C8B6B]
                               focus:border-[#6C8B6B]">

                    <option value="1"
                        {{ $penghuni->masa_kos == 1 ? 'selected' : '' }}>

                        1 Bulan

                    </option>

                    <option value="3"
                        {{ $penghuni->masa_kos == 3 ? 'selected' : '' }}>

                        3 Bulan

                    </option>

                    <option value="6"
                        {{ $penghuni->masa_kos == 6 ? 'selected' : '' }}>

                        6 Bulan

                    </option>

                    <option value="12"
                        {{ $penghuni->masa_kos == 12 ? 'selected' : '' }}>

                        12 Bulan

                    </option>

                    <option value="24"
                        {{ $penghuni->masa_kos == 24 ? 'selected' : '' }}>

                        24 Bulan

                    </option>

                </select>

            </div>

        </div>

        {{-- Alamat --}}
        <div class="mt-6">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Alamat
            </label>

            <textarea name="alamat"
                      rows="4"
                      class="w-full border border-gray-300 rounded-xl p-3
                             focus:ring-[#6C8B6B]
                             focus:border-[#6C8B6B]">{{ old('alamat', $penghuni->alamat) }}</textarea>

        </div>

        {{-- Button --}}
        <div class="mt-8 flex justify-end">

            <button type="submit"
                    class="bg-[#6C8B6B]
                           hover:bg-[#587357]
                           text-white px-6 py-3 rounded-xl
                           transition duration-200">

                Update Penghuni

            </button>

        </div>

    </form>

</div>

</x-admin-layout>
<x-admin-layout>

```
{{-- Header --}}
<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-2xl font-bold text-[#0F0937]">
            Edit Penghuni
        </h1>

        <p class="text-gray-500 mt-1">
            Perbarui data penghuni
        </p>

    </div>

    <a href="{{ route('admin.penghuni.index') }}"
       class="bg-gray-100 hover:bg-gray-200
              text-gray-700 px-5 py-3 rounded-xl transition">

        Kembali

    </a>

</div>

{{-- Card --}}
<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">

    <form method="POST"
          action="{{ route('admin.penghuni.update', $penghuni->id) }}">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">

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
```

</x-admin-layout>

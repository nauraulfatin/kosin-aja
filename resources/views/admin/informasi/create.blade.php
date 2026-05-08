@php
$isEdit = isset($kos) && $kos;
@endphp

<x-admin-layout>

    ```
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $isEdit ? 'Edit Informasi Kos' : 'Tambah Informasi Kos' }}
                </h1>
                <p class="text-gray-500 mt-1">Lengkapi detail properti kos Anda dengan tampilan profesional.</p>
            </div>
            <div
                class="bg-white px-4 py-3 rounded-2xl shadow-sm border border-gray-100 text-sm text-gray-600 font-medium">
                Halo, {{ auth()->user()->name }}
            </div>
        </div>

        <form method="POST" action="{{ $isEdit ? route('admin.informasi.update') : route('admin.informasi.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if($isEdit)
            @method('PUT')
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                {{-- LEFT CONTENT --}}
                <div class="xl:col-span-2 space-y-8">

                    {{-- INFORMASI UTAMA --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">Informasi Utama</h2>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Nama Kos <span
                                        class="text-red-400">*</span></label>
                                <input type="text" name="nama_kos" value="{{ old('nama_kos', $kos->nama_kos ?? '') }}"
                                    class="w-full rounded-2xl border border-gray-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#6C8B6B]"
                                    placeholder="Contoh: Kos Melati Indah" required>
                                @error('nama_kos')<p class="text-red-400 text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Alamat Lengkap <span
                                        class="text-red-400">*</span></label>
                                <textarea name="alamat" rows="3"
                                    class="w-full rounded-2xl border border-gray-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#6C8B6B] resize-none"
                                    placeholder="Nama jalan, nomor rumah, dll"
                                    required>{{ old('alamat', $kos->alamat ?? '') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Kota / Kabupaten</label>
                                <input type="text" name="kota" value="{{ old('kota', $kos->kota ?? '') }}"
                                    class="w-full rounded-2xl border border-gray-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#6C8B6B]"
                                    placeholder="Contoh: Banyuwangi">
                            </div>
                        </div>
                    </div>

                    {{-- LOKASI --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">Lokasi & Peta</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Latitude</label>
                                <input type="text" name="latitude" id="input-lat"
                                    value="{{ old('latitude', $kos->latitude ?? '') }}" onchange="updatePeta()"
                                    class="w-full rounded-2xl border border-gray-200 px-4 py-3" placeholder="-8.2192">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Longitude</label>
                                <input type="text" name="longitude" id="input-lng"
                                    value="{{ old('longitude', $kos->longitude ?? '') }}" onchange="updatePeta()"
                                    class="w-full rounded-2xl border border-gray-200 px-4 py-3" placeholder="114.3691">
                            </div>
                        </div>

                        <div class="bg-[#F8F5F0] rounded-2xl p-4 mb-4 text-sm text-gray-600">
                            <p class="font-semibold mb-2">📍 Cara ambil koordinat:</p>
                            <ol class="list-decimal list-inside space-y-1 text-gray-500">
                                <li>Buka Google Maps</li>
                                <li>Cari lokasi kos</li>
                                <li>Klik kanan titik lokasi</li>
                                <li>Copy koordinat ke Latitude & Longitude</li>
                            </ol>
                        </div>

                        <button type="button" onclick="tampilkanPeta()"
                            class="mb-4 inline-flex items-center gap-2 bg-[#6C8B6B] hover:bg-[#5b755a] text-white px-5 py-3 rounded-2xl font-semibold transition">
                            🗺️ Tampilkan Peta
                        </button>

                        <div id="map-error" class="hidden p-3 rounded-2xl bg-red-50 text-red-500 text-sm mb-4"></div>

                        <div id="map-container"
                            style="display:{{ (old('latitude', $kos->latitude ?? null)) ? 'block' : 'none' }};">
                            <div id="map" class="h-[320px] rounded-3xl border border-gray-200"></div>
                            <p class="text-xs text-gray-400 mt-2">Drag pin atau klik peta untuk koreksi lokasi.</p>
                        </div>
                    </div>

                    {{-- DETAIL --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">Detail Kos</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">No. Telepon</label>
                                <input type="text" name="no_telepon"
                                    value="{{ old('no_telepon', $kos->no_telepon ?? '') }}"
                                    class="w-full rounded-2xl border border-gray-200 px-4 py-3"
                                    placeholder="08xxxxxxxxxx">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Harga Mulai (Rp)</label>
                                <input type="number" name="harga_mulai"
                                    value="{{ old('harga_mulai', $kos->harga_mulai ?? '') }}"
                                    class="w-full rounded-2xl border border-gray-200 px-4 py-3" placeholder="500000">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Tipe Kos</label>
                            <select name="tipe_kos" class="w-full rounded-2xl border border-gray-200 px-4 py-3">
                                <option value="campur"
                                    {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'campur' ? 'selected' : '' }}>Campur
                                </option>
                                <option value="putra"
                                    {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'putra' ? 'selected' : '' }}>Putra
                                </option>
                                <option value="putri"
                                    {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'putri' ? 'selected' : '' }}>Putri
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full rounded-2xl border border-gray-200 px-4 py-3 resize-none"
                                placeholder="Ceritakan tentang kos Anda...">{{ old('deskripsi', $kos->deskripsi ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="space-y-8">

                    {{-- FASILITAS --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Fasilitas Umum</h2>
                        <p class="text-sm text-gray-500 mb-4">Tambahkan fasilitas utama kos.</p>
                        {{-- Existing fasilitas script tetap dipakai dari code lama --}}
                    </div>

                    {{-- FOTO --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-6">Media Properti</h2>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Foto Utama</label>
                            @if($isEdit && $kos->foto_utama)
                            <img src="{{ Storage::url($kos->foto_utama) }}"
                                class="h-40 w-full object-cover rounded-2xl mb-3">
                            @endif
                            <input type="file" name="foto_utama" accept="image/*"
                                class="w-full rounded-2xl border border-gray-200 px-4 py-3">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Foto Galeri</label>
                            <input type="file" name="foto_galeri[]" accept="image/*" multiple
                                class="w-full rounded-2xl border border-gray-200 px-4 py-3">
                        </div>
                    </div>

                    {{-- ACTION --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sticky top-24">
                        <button type="submit"
                            class="w-full bg-[#6C8B6B] hover:bg-[#5b755a] text-white py-4 rounded-2xl font-semibold transition mb-3">
                            {{ $isEdit ? 'Update Informasi Kos' : 'Simpan Informasi Kos' }}
                        </button>

                        <a href="{{ route('admin.informasi.index') }}"
                            class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-4 rounded-2xl font-semibold transition">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- LEAFLET --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- GUNAKAN SCRIPT MAP & FASILITAS LAMA MILIKMU TANPA DIHAPUS --}}
    ```

</x-admin-layout>
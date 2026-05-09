<x-admin-layout>

    <form method="POST"
          action="{{ isset($kos) 
                    ? route('admin.informasi.update')
                    : route('admin.informasi.store') }}"
          enctype="multipart/form-data">

        @csrf

        @if(isset($kos))
            @method('PUT')
        @endif

        <div class="space-y-6">

            {{-- HEADER --}}
            <div class="flex items-center justify-between">

                <div>

                    <h1 class="text-2xl font-bold text-[#0F0937]">
                        Informasi Kos
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Lengkapi informasi kos untuk ditampilkan di katalog
                    </p>

                </div>

                <button type="submit"
                        class="bg-[#6C8B6B]
                               hover:bg-[#587357]
                               text-white px-6 py-3 rounded-xl
                               transition">

                    Simpan Informasi

                </button>

            </div>

            {{-- SECTION 1: Informasi Utama --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <h2 class="text-sm font-semibold text-gray-700 mb-5">
                    Informasi Utama
                </h2>

                <div class="grid grid-cols-2 gap-5">

                    {{-- Nama Kos --}}
                    <div>

                        <label class="block text-xs text-gray-500 mb-1">
                            Nama Kos
                        </label>

                        <input type="text"
                               name="nama_kos"
                               value="{{ old('nama_kos', $kos->nama_kos ?? '') }}"
                               class="w-full border border-gray-200
                                      rounded-xl px-4 py-3 text-sm
                                      focus:outline-none
                                      focus:border-[#6C8B6B]"
                               placeholder="Contoh: Kos Putri Melati">

                    </div>

                    {{-- Tipe Kos --}}
                    <div>

                        <label class="block text-xs text-gray-500 mb-1">
                            Tipe Kos
                        </label>

                        <select name="tipe_kos"
                                class="w-full border border-gray-200
                                       rounded-xl px-4 py-3 text-sm
                                       focus:outline-none
                                       focus:border-[#6C8B6B]">

                            <option value="">
                                -- Pilih Tipe --
                            </option>

                            <option value="Putra"
                                {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'Putra' ? 'selected' : '' }}>
                                Putra
                            </option>

                            <option value="Putri"
                                {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'Putri' ? 'selected' : '' }}>
                                Putri
                            </option>

                            <option value="Campur"
                                {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'Campur' ? 'selected' : '' }}>
                                Campur
                            </option>

                        </select>

                    </div>

                </div>

                {{-- Deskripsi --}}
                <div class="mt-5">

                    <label class="block text-xs text-gray-500 mb-1">
                        Deskripsi Kos
                    </label>

                    <textarea name="deskripsi"
                              rows="5"
                              class="w-full border border-gray-200
                                     rounded-xl px-4 py-3 text-sm
                                     focus:outline-none
                                     focus:border-[#6C8B6B]"
                              placeholder="Tuliskan deskripsi kos...">{{ old('deskripsi', $kos->deskripsi ?? '') }}</textarea>

                </div>

            </div>

            {{-- SECTION 2: Alamat --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <h2 class="text-sm font-semibold text-gray-700 mb-5">
                    Alamat Kos
                </h2>

                <textarea name="alamat"
                          rows="4"
                          class="w-full border border-gray-200
                                 rounded-xl px-4 py-3 text-sm
                                 focus:outline-none
                                 focus:border-[#6C8B6B]"
                          placeholder="Masukkan alamat lengkap kos">{{ old('alamat', $kos->alamat ?? '') }}</textarea>

                {{-- Kota / Kabupaten --}}
<div class="mt-5">

    <label class="block text-xs text-gray-500 mb-1">
        Kota / Kabupaten
    </label>

    <input type="text"
           name="kota"
           value="{{ old('kota', $kos->kota ?? '') }}"
           class="w-2xl border border-gray-200
                  rounded-xl px-4 py-3 text-sm
                  focus:outline-none
                  focus:border-[#6C8B6B]"
           placeholder="Contoh: Banyuwangi">

</div>
            </div>

            {{-- SECTION 3: Lokasi Kos --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <h2 class="text-sm font-semibold text-gray-700 mb-4">
                    Lokasi Kos
                </h2>

                {{-- Petunjuk --}}
                <div class="mb-5 p-4 rounded-xl border border-[#dbe8dc]"
                     style="background:#f8fbf8;">

                    <p class="text-sm font-semibold text-gray-700 mb-3">
                        📍 Cara dapat koordinat dari Google Maps
                    </p>

                    <ol class="text-sm text-gray-600 list-decimal list-inside space-y-2 leading-relaxed">

                        <li>
                            Buka
                            <a href="https://maps.google.com"
                               target="_blank"
                               class="text-[#6C8B6B] underline">
                                Google Maps
                            </a>
                        </li>

                        <li>
                            Cari lokasi kos kamu
                        </li>

                        <li>
                            Klik kanan tepat di lokasi →
                            klik koordinat yang muncul
                            (otomatis tercopy)
                        </li>

                        <li>
                            Paste angka pertama ke Latitude,
                            angka kedua ke Longitude
                        </li>

                    </ol>

                    <p class="text-xs text-gray-400 mt-4">
                        Contoh:
                        <span class="font-mono">
                            -8.2192, 114.3691
                        </span>
                    </p>

                </div>

                {{-- Latitude Longitude --}}
                <div class="grid grid-cols-2 gap-4 mb-5">

                    {{-- Latitude --}}
                    <div>

                        <label class="block text-xs text-gray-500 mb-1">
                            Latitude
                        </label>

                        <input type="text"
                               name="latitude"
                               id="input-lat"
                               value="{{ old('latitude', $kos->latitude ?? '') }}"
                               placeholder="-8.2192"
                               class="w-full border border-gray-200
                                      rounded-xl px-4 py-3 text-sm
                                      focus:outline-none
                                      focus:border-[#6C8B6B]">

                    </div>

                    {{-- Longitude --}}
                    <div>

                        <label class="block text-xs text-gray-500 mb-1">
                            Longitude
                        </label>

                        <input type="text"
                               name="longitude"
                               id="input-lng"
                               value="{{ old('longitude', $kos->longitude ?? '') }}"
                               placeholder="114.3691"
                               class="w-full border border-gray-200
                                      rounded-xl px-4 py-3 text-sm
                                      focus:outline-none
                                      focus:border-[#6C8B6B]">

                    </div>

                </div>

                {{-- MAP --}}
                <div id="map"
                     class="w-full rounded-2xl border border-gray-200"
                     style="height:260px;">
                </div>
                <div class="mt-4 flex justify-end">

    <button type="button"
            class="bg-[#6C8B6B]
                   hover:bg-[#587357]
                   text-white text-sm
                   px-5 py-2 rounded-xl transition">

        Gunakan Lokasi Ini

    </button>

</div>
            </div>

            {{-- SECTION 4: Foto Kos --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

    <h2 class="text-sm font-semibold text-gray-700 mb-5">
        Foto Kos
    </h2>

    {{-- FOTO UTAMA --}}
    <div class="mb-8">

        <label class="block text-xs text-gray-500 mb-2">
            Foto Utama
        </label>

        <input type="file"
               name="foto_utama"
               id="fotoUtamaInput"
               accept="image/*"
               class="w-full border border-gray-200
                      rounded-xl px-4 py-3 text-sm">

        <p class="text-xs text-gray-400 mt-2">
            Foto utama akan tampil sebagai thumbnail katalog
        </p>

        {{-- Preview Foto Utama --}}
        <div id="previewFotoUtama"
     class="mt-4">

    @if(isset($kos) && $kos->foto_utama)

        <img src="{{ asset('storage/' . $kos->foto_utama) }}"
             class="w-52 h-40 object-cover
                    rounded-2xl border border-gray-200">

    @endif

</div>

    </div>

    {{-- GALERI FOTO --}}
    <div>

        <label class="block text-xs text-gray-500 mb-2">
            Galeri Foto
        </label>

        <input type="file"
               name="foto_galeri[]"
               id="fotoGaleriInput"
               multiple
               accept="image/*"
               class="w-full border border-gray-200
                      rounded-xl px-4 py-3 text-sm">

        <p class="text-xs text-gray-400 mt-2">
            Bisa upload lebih dari satu foto
        </p>

        {{-- Preview Galeri --}}
        <div id="previewGaleri"
     class="grid grid-cols-4 gap-4 mt-5">

    @if(isset($kos) && $kos->foto_galeri)

        @foreach($kos->foto_galeri as $foto)

            <div class="relative">

                <img src="{{ asset('storage/' . $foto) }}"
                     class="w-full h-32 object-cover
                            rounded-xl border border-gray-200">

            </div>

        @endforeach

    @endif

</div>

    </div>

</div>
            {{-- SECTION 5: Informasi Harga --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

    <h2 class="text-sm font-semibold text-gray-700 mb-5">
        Informasi Harga
    </h2>

    {{-- Petunjuk --}}
    <div class="max-w-sm
                mb-6 p-4 rounded-2xl
                border border-[#dbe8dc]"
         style="background:#f8fbf8;">

        <p class="text-sm font-semibold text-gray-700 mb-3">
            💰 Informasi harga kos
        </p>

        <ul class="text-sm text-gray-600 space-y-2 leading-relaxed">

            <li>
                • Masukkan harga sewa kos per bulan
            </li>

            <li>
                • Gunakan angka tanpa titik atau koma
            </li>

            <li>
                • Contoh:
                <span class="font-semibold">
                    500000
                </span>
            </li>

        </ul>

    </div>

    {{-- Harga --}}
    <div class="max-w-sm">

        <label class="block text-xs text-gray-500 mb-2">
            Harga Mulai
        </label>

        <div class="flex items-center
                    rounded-2xl overflow-hidden
                    border border-gray-200
                    focus-within:border-[#6C8B6B]
                    focus-within:ring-2
                    focus-within:ring-[#6C8B6B]/10
                    transition">

            {{-- RP --}}
            <div class="px-5 py-4 bg-gray-50
                        text-gray-500 text-sm
                        border-r border-gray-200">

                Rp

            </div>

            {{-- INPUT --}}
            <input type="number"
                   name="harga_mulai"
                   value="{{ old('harga_mulai', $kos->harga_mulai ?? '') }}"
                   placeholder="Contoh: 800000"
                   class="flex-1 px-5 py-4 text-sm
                          border-none outline-none
                          focus:ring-0">

            {{-- BULAN --}}
            <div class="px-5 py-4 bg-gray-50
                        text-xs text-gray-400
                        border-l border-gray-200">

                / bulan

            </div>

        </div>

    </div>

</div>

        </div>

    </form>

    {{-- LEAFLET --}}
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>

        let map;
        let marker;

        function initMap(lat = -8.2192, lng = 114.3691)
        {
            map = L.map('map').setView([lat, lng], 15);

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    attribution: '© OpenStreetMap'
                }
            ).addTo(map);

            marker = L.marker([lat, lng]).addTo(map);
        }

        window.addEventListener('load', function () {

            const lat =
                parseFloat(document.getElementById('input-lat').value)
                || -8.2192;

            const lng =
                parseFloat(document.getElementById('input-lng').value)
                || 114.3691;

            initMap(lat, lng);

        });

        document.getElementById('input-lat')
            .addEventListener('input', updateMap);

        document.getElementById('input-lng')
            .addEventListener('input', updateMap);

        function updateMap()
        {
            const lat =
                parseFloat(document.getElementById('input-lat').value);

            const lng =
                parseFloat(document.getElementById('input-lng').value);

            if (!isNaN(lat) && !isNaN(lng))
            {
                map.setView([lat, lng], 16);

                marker.setLatLng([lat, lng]);
            }
        }

    </script>

<script>

    // =========================
    // PREVIEW FOTO UTAMA
    // =========================

    document.getElementById('fotoUtamaInput')
    .addEventListener('change', function(e)
    {
        const preview =
            document.getElementById('previewFotoUtama');

        preview.innerHTML = '';

        const file = e.target.files[0];

        if (file)
        {
            const reader = new FileReader();

            reader.onload = function(event)
            {
                preview.innerHTML = `
                    <img src="${event.target.result}"
                         class="w-52 h-40 object-cover
                                rounded-2xl border border-gray-200">
                `;
            }

            reader.readAsDataURL(file);
        }
    });

    // =========================
    // PREVIEW FOTO UTAMA
    // =========================

    document.getElementById('fotoUtamaInput')
    .addEventListener('change', function(e)
    {
        const preview =
            document.getElementById('previewFotoUtama');

        preview.innerHTML = '';

        const file = e.target.files[0];

        if (file)
        {
            const reader = new FileReader();

            reader.onload = function(event)
            {
                preview.innerHTML = `
                    <img src="${event.target.result}"
                         class="w-52 h-40 object-cover
                                rounded-2xl border border-gray-200">
                `;
            }

            reader.readAsDataURL(file);
        }
    });

    // =========================
    // MULTIPLE PREVIEW GALERI
    // =========================

    let selectedFiles = [];

    document.getElementById('fotoGaleriInput')
    .addEventListener('change', function(e)
    {
        const preview =
            document.getElementById('previewGaleri');

        const files = Array.from(e.target.files);

        // tambah file baru ke array lama
        selectedFiles.push(...files);

        // reset preview
        preview.innerHTML = '';

        // render semua file
        selectedFiles.forEach((file, index) =>
        {
            const reader = new FileReader();

            reader.onload = function(event)
            {
                const wrapper =
                    document.createElement('div');

                wrapper.className = 'relative';

                wrapper.innerHTML = `
                    <img src="${event.target.result}"
                         class="w-full h-32 object-cover
                                rounded-xl border border-gray-200">

                    <button type="button"
                            onclick="removeImage(${index})"
                            class="absolute top-2 right-2
                                   bg-red-500 text-white
                                   w-6 h-6 rounded-full
                                   text-xs">

                        ✕

                    </button>
                `;

                preview.appendChild(wrapper);
            }

            reader.readAsDataURL(file);
        });
    });

    // =========================
    // HAPUS PREVIEW
    // =========================

    function removeImage(index)
    {
        selectedFiles.splice(index, 1);

        const preview =
            document.getElementById('previewGaleri');

        preview.innerHTML = '';

        selectedFiles.forEach((file, index) =>
        {
            const reader = new FileReader();

            reader.onload = function(event)
            {
                const wrapper =
                    document.createElement('div');

                wrapper.className = 'relative';

                wrapper.innerHTML = `
                    <img src="${event.target.result}"
                         class="w-full h-32 object-cover
                                rounded-xl border border-gray-200">

                    <button type="button"
                            onclick="removeImage(${index})"
                            class="absolute top-2 right-2
                                   bg-red-500 text-white
                                   w-6 h-6 rounded-full
                                   text-xs">

                        ✕

                    </button>
                `;

                preview.appendChild(wrapper);
            }

            reader.readAsDataURL(file);
        });
    }

</script>
</x-admin-layout>
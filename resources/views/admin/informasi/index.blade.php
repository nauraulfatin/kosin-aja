<x-admin-layout>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-2xl font-bold text-[#0F0937]">
                Informasi Kos
            </h1>

            <p class="text-gray-500 mt-1">
                Informasi lengkap kos yang tampil di katalog
            </p>

        </div>

        <a href="{{ route('admin.informasi.edit') }}"
           class="bg-[#6C8B6B]
                  hover:bg-[#587357]
                  text-white px-5 py-3 rounded-xl
                  transition">

            Edit Informasi

        </a>

    </div>

    {{-- Jika belum ada data --}}
    @if(!$kos)

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 text-center">

            <h2 class="text-lg font-semibold text-[#0F0937] mb-2">
                Informasi kos belum tersedia
            </h2>

            <p class="text-gray-500 mb-6">
                Lengkapi informasi kos terlebih dahulu
            </p>

            <a href="{{ route('admin.informasi.create') }}"
               class="bg-[#6C8B6B]
                      hover:bg-[#587357]
                      text-white px-5 py-3 rounded-xl transition">

                Tambah Informasi

            </a>

        </div>

    @else

        <div class="space-y-6">

            {{-- Informasi Utama --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

                <div class="flex items-start justify-between gap-6">

                    <div class="flex-1">

                        {{-- Nama --}}
                        <h2 class="text-2xl font-bold text-[#0F0937]">

                            {{ $kos->nama_kos }}

                        </h2>

                        {{-- Tipe --}}
                        <div class="mt-3">

                            <span class="bg-[#F8F5F0]
                                         text-[#6C8B6B]
                                         px-4 py-2 rounded-full
                                         text-sm font-medium">

                                Kos {{ $kos->tipe_kos }}

                            </span>

                        </div>

                        {{-- Alamat --}}
<div class="mt-6">

    <p class="text-sm text-gray-500 mb-2">
        Alamat
    </p>

    <div class="space-y-3">

        {{-- Alamat Lengkap --}}
        <div>

            <p class="text-xs text-gray-400 mb-1">
                Alamat Lengkap
            </p>

            <div class="border border-gray-200
                        rounded-xl px-4 py-3
                        text-sm text-gray-700">

                {{ $kos->alamat }}

            </div>

        </div>

        {{-- Kota & Provinsi --}}
        <div class="grid grid-cols-2 gap-4">

            {{-- Kabupaten / Kota --}}
            <div>

                <p class="text-xs text-gray-400 mb-1">
                    Kabupaten / Kota
                </p>

                <div class="border border-gray-200
                            rounded-xl px-4 py-3
                            text-sm text-gray-700">

                    {{ $kos->kota ?? '-' }}

                </div>

            </div>

        </div>

    </div>

</div>

                        {{-- Deskripsi --}}
                        <div class="mt-6">

                            <p class="text-sm text-gray-500 mb-1">
                                Deskripsi
                            </p>

                            <p class="text-gray-700 leading-relaxed">

                                {{ $kos->deskripsi }}

                            </p>

                        </div>

                    </div>

                   {{-- Foto --}}
<div class="w-[320px] shrink-0">

    @if($kos->foto_utama)

        <img src="{{ asset('storage/' . $kos->foto_utama) }}"
             class="w-full h-[220px]
                    object-cover rounded-2xl border border-gray-100">

    @else

        <div class="w-full h-[220px]
                    bg-gray-100 rounded-2xl
                    flex items-center justify-center
                    text-gray-400 text-sm">

            Belum ada foto

        </div>

    @endif

</div>
                </div>

            </div>

            {{-- Harga --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

                <p class="text-sm text-gray-500 mb-2">
                    Harga Mulai
                </p>

                <h2 class="text-2xl font-bold text-[#0F0937]">

                    Rp {{ number_format($kos->harga_mulai, 0, ',', '.') }}

                    <span class="text-sm text-gray-400 font-normal">
                        / bulan
                    </span>

                </h2>

            </div>

            {{-- Lokasi --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

                <h2 class="text-lg font-bold text-[#0F0937] mb-4">
                    Lokasi Kos
                </h2>

                {{-- Koordinat --}}
                <div class="grid grid-cols-2 gap-4 mb-5">

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Latitude
                        </p>

                        <div class="border border-gray-200
                                    rounded-xl px-4 py-3 text-sm text-gray-700">

                            {{ $kos->latitude }}

                        </div>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500 mb-1">
                            Longitude
                        </p>

                        <div class="border border-gray-200
                                    rounded-xl px-4 py-3 text-sm text-gray-700">

                            {{ $kos->longitude }}

                        </div>

                    </div>

                </div>

                {{-- Map --}}
                <div id="map-detail"
                     class="w-full rounded-2xl border border-gray-200"
                     style="height:320px;">
                </div>

            </div>

        </div>

    @endif

    {{-- LEAFLET --}}
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- MAP --}}
    @if($kos)

        <script>

            const lat = {{ $kos->latitude ?? -8.2192 }};
            const lng = {{ $kos->longitude ?? 114.3691 }};

            const mapDetail = L.map('map-detail')
                .setView([lat, lng], 15);

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    attribution: '© OpenStreetMap'
                }
            ).addTo(mapDetail);

            L.marker([lat, lng]).addTo(mapDetail);

        </script>

    @endif

</x-admin-layout>
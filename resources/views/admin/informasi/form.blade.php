<x-admin-layout>

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">{{ $kos ? 'Edit' : 'Tambah' }} Informasi Kos</h1>
            <p class="text-sm text-gray-400 mt-0.5">Lengkapi informasi kos dengan detail dan akurat</p>
        </div>
        <span class="text-gray-600 font-medium text-sm">Halo, {{ auth()->user()->name }}</span>
    </div>

    <form method="POST" action="{{ $kos ? route('admin.informasi.update') : route('admin.informasi.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if($kos) @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

            {{-- ===== KOLOM KIRI ===== --}}
            <div class="space-y-6">

                {{-- SECTION 1: Informasi Dasar --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-semibold text-gray-700 mb-4">
                        1. Informasi Dasar
                    </h2>


                    <div class="grid grid-cols-2 gap-4 mb-4">
                        {{-- Nama Kos --}}
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Nama Kos <span
                                    class="text-red-400">*</span></label>
                            <input type="text" name="nama_kos" value="{{ old('nama_kos', $kos->nama_kos ?? '') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                                placeholder="Contoh: Kos Melati Indah" required>
                            @error('nama_kos')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Tipe Kos --}}
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Tipe Kos <span
                                    class="text-red-400">*</span></label>
                            <select name="tipe_kos"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20 bg-white">
                                <option value="campur"
                                    {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'campur' ? 'selected' : '' }}>Campur
                                </option>
                                <option value="putra"
                                    {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'putra'  ? 'selected' : '' }}>Putra
                                </option>
                                <option value="putri"
                                    {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'putri'  ? 'selected' : '' }}>Putri
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Deskripsi Kos</label>
                        <textarea name="deskripsi" rows="4" maxlength="500" id="deskripsi-input"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20 resize-none"
                            placeholder="Ceritakan tentang kos Anda, fasilitas, keunggulan, dll...">{{ old('deskripsi', $kos->deskripsi ?? '') }}</textarea>
                        <p class="text-xs text-gray-400 text-right mt-1"><span
                                id="char-count">{{ strlen(old('deskripsi', $kos->deskripsi ?? '')) }}</span> / 500</p>
                    </div>
                </div>

                {{-- SECTION 2: Alamat Kos --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-semibold text-gray-700 mb-4">
                        2. Alamat Kos
                    </h2>

                    {{-- Alamat Lengkap --}}
                    <div class="mb-4">
                        <label class="block text-xs text-gray-500 mb-1">Alamat Lengkap <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="alamat" value="{{ old('alamat', $kos->alamat ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                            placeholder="Nama jalan, nomor rumah, RT/RW, dll" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        {{-- Kota --}}
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Kota / Kabupaten <span
                                    class="text-red-400">*</span></label>
                            <input type="text" name="kota" value="{{ old('kota', $kos->kota ?? '') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                                placeholder="Contoh: Banyuwangi">
                        </div>
                        {{-- Provinsi --}}
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Provinsi <span
                                    class="text-red-400">*</span></label>
                            <input type="text" name="provinsi" value="{{ old('provinsi', $kos->provinsi ?? '') }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                                placeholder="Contoh: Jawa Timur">
                        </div>
                    </div>

                    {{-- Kode Pos --}}
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Kode Pos</label>
                        <input type="text" name="kode_pos" value="{{ old('kode_pos', $kos->kode_pos ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                            placeholder="Contoh: 68416">
                    </div>
                </div>

                {{-- SECTION 3: Lokasi Kos (Peta) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-semibold text-gray-700 mb-4">
                        3. Lokasi Kos
                    </h2>

                    {{-- Petunjuk --}}
                    <div class="mb-3 p-3 rounded-lg text-xs text-gray-500" style="background:#f0f5f1;">
                        Pilih lokasi kos Anda di peta dengan klik pada titik yang sesuai
                    </div>

                    {{-- Search Box --}}
                    <div class="relative mb-3">
                        <input type="text" id="search-lokasi"
                            class="w-full border border-gray-200 rounded-lg pl-4 pr-10 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B]"
                            placeholder="Cari lokasi...">
                        <button type="button" onclick="cariLokasi()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#6C8B6B]">

                        </button>
                    </div>

                    {{-- Map --}}
                    <div id="map" style="height:240px;border-radius:12px;border:1px solid #e5e7eb;margin-bottom:12px;">
                    </div>

                    {{-- Error --}}
                    <div id="map-error"
                        style="display:none;padding:10px 12px;background:#fee2e2;border-radius:8px;color:#ef4444;font-size:0.8rem;margin-bottom:8px;">
                    </div>

                    {{-- Lat Lng inputs --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Latitude</label>
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                <input type="text" name="latitude" id="input-lat"
                                    value="{{ old('latitude', $kos->latitude ?? '') }}"
                                    class="flex-1 px-3 py-2.5 text-sm focus:outline-none" placeholder="-8.2192">
                                <button type="button" onclick="copyToClipboard('input-lat')"
                                    class="px-3 py-2.5 text-gray-400 hover:text-[#6C8B6B] border-l border-gray-200 bg-gray-50">

                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Longitude</label>
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                <input type="text" name="longitude" id="input-lng"
                                    value="{{ old('longitude', $kos->longitude ?? '') }}"
                                    class="flex-1 px-3 py-2.5 text-sm focus:outline-none" placeholder="114.3691">
                                <button type="button" onclick="copyToClipboard('input-lng')"
                                    class="px-3 py-2.5 text-gray-400 hover:text-[#6C8B6B] border-l border-gray-200 bg-gray-50">

                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- ===== END KOLOM KIRI ===== --}}

            {{-- ===== KOLOM KANAN ===== --}}
            <div class="space-y-6">

                {{-- SECTION 4: Informasi Kontak --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-4">
                        <span class="text-lg"></span>
                        4. Informasi Kontak
                    </h2>

                    <div class="mb-4">
                        <label class="block text-xs text-gray-500 mb-1">Nama Pemilik / Pengelola <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="nama_pemilik"
                            value="{{ old('nama_pemilik', $kos->nama_pemilik ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                            placeholder="Contoh: Budi Santoso">
                    </div>

                    <div class="mb-4">
                        <label class="block text-xs text-gray-500 mb-1">No. Telepon / WhatsApp <span
                                class="text-red-400">*</span></label>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $kos->no_telepon ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                            placeholder="Contoh: 081234567890">
                    </div>

                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Email (Opsional)</label>
                        <input type="email" name="email" value="{{ old('email', $kos->email ?? '') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                            placeholder="Contoh: email@domain.com">
                    </div>
                </div>

                {{-- SECTION 5: Informasi Harga --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-4">
                        <span class="text-lg"></span>
                        5. Informasi Harga
                    </h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Harga Mulai <span
                                    class="text-red-400">*</span></label>
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                <span
                                    class="px-3 py-2.5 bg-gray-50 text-xs text-gray-500 border-r border-gray-200 font-medium">Rp</span>
                                <input type="number" name="harga_mulai"
                                    value="{{ old('harga_mulai', $kos->harga_mulai ?? '') }}"
                                    class="flex-1 px-3 py-2.5 text-sm focus:outline-none" placeholder="Contoh: 800000">
                                <span class="px-3 py-2.5 bg-gray-50 text-xs text-gray-400 border-l border-gray-200">/
                                    bulan</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Deposit (Opsional)</label>
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                <span
                                    class="px-3 py-2.5 bg-gray-50 text-xs text-gray-500 border-r border-gray-200 font-medium">Rp</span>
                                <input type="number" name="deposit" value="{{ old('deposit', $kos->deposit ?? '') }}"
                                    class="flex-1 px-3 py-2.5 text-sm focus:outline-none" placeholder="Contoh: 500000">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 6: Fasilitas Kos --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-semibold text-gray-700 mb-4">
                        6. Fasilitas Kos
                    </h2>

                    @php
                    $selectedFasilitas = old('fasilitas', $kos->fasilitas ?? []);
                    @endphp

                    {{-- List fasilitas --}}
                    <div id="fasilitas-list" class="flex flex-wrap gap-2 mb-3 min-h-[44px]">
                        @foreach($selectedFasilitas as $item)
                        <div
                            class="fasilitas-item flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium border border-gray-200 bg-[#f0f5f1] text-[#3a5c3a]">
                            <span>{{ $item }}</span>
                            <input type="hidden" name="fasilitas[]" value="{{ $item }}">
                            <button type="button" onclick="hapusFasilitas(this)"
                                class="text-[#6C8B6B] hover:text-red-400 font-bold leading-none">
                                ×
                            </button>
                        </div>
                        @endforeach
                    </div>

                    {{-- Input tambah fasilitas --}}
                    <div class="flex gap-2">
                        <input type="text" id="input-fasilitas"
                            class="flex-1 border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B]/20"
                            placeholder="Contoh: WiFi, AC, Kamar Mandi Dalam..."
                            onkeydown="if(event.key==='Enter'){event.preventDefault();tambahFasilitas()}">

                        <button type="button" onclick="tambahFasilitas()"
                            class="px-4 py-2.5 text-sm font-semibold text-white rounded-lg" style="background:#6C8B6B;">
                            Tambah
                        </button>
                    </div>

                    <p class="text-xs text-gray-400 mt-2">
                        Ketik fasilitas lalu klik Tambah atau tekan Enter
                    </p>
                </div>

                <script>
                function tambahFasilitas() {
                    const input = document.getElementById('input-fasilitas');
                    const nilai = input.value.trim();

                    if (!nilai) return;

                    const list = document.getElementById('fasilitas-list');

                    // Cek duplikat
                    const existing = list.querySelectorAll('input[name="fasilitas[]"]');
                    for (let i = 0; i < existing.length; i++) {
                        if (existing[i].value.toLowerCase() === nilai.toLowerCase()) {
                            input.value = '';
                            input.focus();
                            return;
                        }
                    }

                    const div = document.createElement('div');
                    div.className =
                        'fasilitas-item flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium border border-gray-200 bg-[#f0f5f1] text-[#3a5c3a]';

                    div.innerHTML = `
        <span>${nilai}</span>
        <input type="hidden" name="fasilitas[]" value="${nilai}">
        <button type="button"
            onclick="hapusFasilitas(this)"
            class="text-[#6C8B6B] hover:text-red-400 font-bold leading-none">
            ×
        </button>
    `;

                    list.appendChild(div);

                    input.value = '';
                    input.focus();
                }

                function hapusFasilitas(button) {
                    button.closest('.fasilitas-item').remove();
                }
                </script>

                {{-- Foto Utama & Galeri --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-4">
                        <span class="text-lg"></span>
                        7. Foto Kos
                    </h2>

                    <div class="mb-4">
                        <label class="block text-xs text-gray-500 mb-1">Foto Utama</label>
                        @if($kos && $kos->foto_utama)
                        <div class="mb-2">
                            <img src="{{ Storage::url($kos->foto_utama) }}" class="h-28 rounded-lg object-cover">
                            <p class="text-xs text-gray-400 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                        </div>
                        @endif
                        <input type="file" name="foto_utama" accept="image/*"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:text-white cursor-pointer"
                            style="--file-bg:#6C8B6B;">
                        @error('foto_utama')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Foto Galeri (bisa lebih dari 1)</label>
                        <input type="file" name="foto_galeri[]" accept="image/*" multiple
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium cursor-pointer">
                        <p class="text-xs text-gray-400 mt-1">Tahan Ctrl/Cmd untuk upload beberapa foto sekaligus</p>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.informasi.index') }}"
                        class="flex-1 text-center border border-gray-200 text-gray-600 py-3 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 text-white py-3 rounded-xl font-semibold text-sm transition"
                        style="background:#6C8B6B;">
                        {{ $kos ? 'Update Informasi Kos' : 'Simpan Informasi Kos' }}
                    </button>
                </div>

            </div>
            {{-- ===== END KOLOM KANAN ===== --}}

        </div>
    </form>

    {{-- ===== SCRIPTS ===== --}}
    <script>
    // ---- Char counter ----
    const deskripsiInput = document.getElementById('deskripsi-input');
    const charCount = document.getElementById('char-count');
    if (deskripsiInput) {
        deskripsiInput.addEventListener('input', () => {
            charCount.textContent = deskripsiInput.value.length;
        });
    }

    // ---- Copy to clipboard ----
    function copyToClipboard(id) {
        const val = document.getElementById(id).value;
        navigator.clipboard.writeText(val).then(() => {
            // optional: bisa tambah toast
        });
    }

    // ---- Fasilitas checkbox style toggle ----
    function toggleFasilitasStyle(checkbox) {
        const label = checkbox.closest('label');
        const box = label.querySelector('.fasilitas-box');
        if (checkbox.checked) {
            label.classList.add('border-[#6C8B6B]', 'bg-[#f0f5f1]');
            label.classList.remove('border-gray-200');
            box.classList.add('border-[#6C8B6B]', 'bg-[#6C8B6B]');
            box.classList.remove('border-gray-300', 'bg-white');
            box.textContent = '✓';
        } else {
            label.classList.remove('border-[#6C8B6B]', 'bg-[#f0f5f1]');
            label.classList.add('border-gray-200');
            box.classList.remove('border-[#6C8B6B]', 'bg-[#6C8B6B]');
            box.classList.add('border-gray-300', 'bg-white');
            box.textContent = '';
        }
    }

    // ---- Peta Leaflet ----
    let map = null;
    let marker = null;

    function initMap(lat, lng) {
        if (map) {
            map.remove();
            map = null;
        }

        map = L.map('map').setView([lat, lng], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        marker = L.marker([lat, lng], {
            draggable: true
        }).addTo(map);

        marker.on('dragend', function(e) {
            const pos = e.target.getLatLng();
            document.getElementById('input-lat').value = pos.lat.toFixed(7);
            document.getElementById('input-lng').value = pos.lng.toFixed(7);
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('input-lat').value = e.latlng.lat.toFixed(7);
            document.getElementById('input-lng').value = e.latlng.lng.toFixed(7);
        });
    }

    function cariLokasi() {
        const query = document.getElementById('search-lokasi').value.trim();
        if (!query) return;

        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
            .then(r => r.json())
            .then(data => {
                if (data.length === 0) {
                    document.getElementById('map-error').style.display = 'block';
                    document.getElementById('map-error').textContent = '❌ Lokasi tidak ditemukan.';
                    return;
                }
                document.getElementById('map-error').style.display = 'none';
                const lat = parseFloat(data[0].lat);
                const lng = parseFloat(data[0].lon);
                document.getElementById('input-lat').value = lat.toFixed(7);
                document.getElementById('input-lng').value = lng.toFixed(7);
                initMap(lat, lng);
            });
    }

    // ---- Search on Enter ----
    document.getElementById('search-lokasi').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            cariLokasi();
        }
    });

    // ---- Auto init peta kalau edit mode ----
    window.addEventListener('load', function() {
        const lat = document.getElementById('input-lat').value;
        const lng = document.getElementById('input-lng').value;
        if (lat && lng) {
            initMap(parseFloat(lat), parseFloat(lng));
        } else {
            // Default view: Indonesia
            initMap(-8.2192, 114.3691);
        }
    });
    </script>

</x-admin-layout>
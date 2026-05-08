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
                        Informasi Dasar
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
                        Alamat Kos
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
                        Lokasi Kos
                    </h2>

                    <div class="mb-4 p-4 rounded-xl border border-[#dbe8dc]" style="background:#f8fbf8;">
                        <p class="text-xs font-semibold text-gray-700 mb-2">Cara menentukan lokasi kos:</p>

                        <ol class="text-xs text-gray-600 list-decimal list-inside space-y-1 leading-relaxed">
                            <li>Ketik nama lokasi pada kolom pencarian <span class="font-medium">atau</span> klik
                                langsung pada peta</li>
                            <li>Marker akan otomatis berpindah ke titik yang dipilih</li>
                            <li>Koordinat Latitude & Longitude terisi otomatis</li>
                            <li>Pastikan titik sesuai lokasi kos agar penghuni tidak salah alamat</li>
                        </ol>

                        <p class="text-[11px] text-gray-400 mt-3">
                            Contoh koordinat: <span class="font-mono">-8.2192, 114.3691</span>
                        </p>
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

                {{-- ===== END KOLOM KANAN ===== --}}
                {{-- SPACE / PEMISAH --}}
                <div class="h-6"></div>

                {{-- Tombol Aksi (GLOBAL FORM) --}}
                <div class="flex gap-3 mt-4">
                    <a href="{{ route('admin.informasi.index') }}" class="flex-1 text-center bg-white border border-[#6C8B6B] text-[#6C8B6B]
    py-3 rounded-xl font-semibold text-sm hover:bg-[#f0f5f1] transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 text-white py-3 rounded-xl font-semibold text-sm transition"
                        style="background:#6C8B6B;">
                        {{ $kos ? 'Update Informasi Kos' : 'Simpan Informasi Kos' }}
                    </button>
                </div>
            </div>
            {{-- ===== END KOLOM KIRI ===== --}}



            {{-- ===== KOLOM KANAN ===== --}}
            <div class="space-y-6">

                {{-- SECTION 4: Informasi Kontak --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-4">
                        <span class="text-lg"></span>
                        Informasi Kontak
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
                        Informasi Harga
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
                        Fasilitas Kos
                    </h2>
                    {{-- Petunjuk Fasilitas --}}
                    <div class="mb-4 p-4 rounded-xl" style="background:#f0f5f1; border:1px solid #dbe8dc;">
                        <p class="text-xs font-semibold text-gray-700 mb-2">
                            Cara menambahkan fasilitas: </p>

                        <ol class="text-xs text-gray-600 list-decimal list-inside space-y-1 leading-relaxed">
                            <li>Ketik fasilitas pada kolom input (contoh: WiFi, AC, Kamar Mandi Dalam)</li>
                            <li>Klik tombol <span class="font-medium">Tambah</span> atau tekan <span
                                    class="font-medium">Enter</span></li>
                            <li>Fasilitas dapat dihapus dengan menekan tombol <span class="font-medium">×</span></li>
                        </ol>

                        <p class="text-[11px] text-gray-400 mt-3">
                            Tips: gunakan kata singkat agar tampilan lebih rapi, contoh “WiFi”, “AC”, “Dapur Bersama”
                        </p>
                    </div>

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

                {{-- SECTION 7: Foto Kos --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-4">
                        <span class="text-lg"></span>
                        Foto Kos
                    </h2>

                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        {{-- Petunjuk Foto Kos --}}
                        <div class="mb-4 p-4 rounded-xl" style="background:#f0f5f1; border:1px solid #dbe8dc;">
                            <p class="text-xs font-semibold text-gray-700 mb-2">
                                Cara upload foto kos:
                            </p>

                            <ol class="text-xs text-gray-600 list-decimal list-inside space-y-1 leading-relaxed">
                                <li>Klik area upload atau tarik (drag) foto ke kotak upload</li>
                                <li>Bisa memilih lebih dari satu foto sekaligus</li>
                                <li>Foto akan langsung muncul sebagai preview sebelum disimpan</li>
                                <li>Foto pertama otomatis dijadikan foto utama</li>
                                <li>Foto dapat dihapus dengan tombol <span class="font-medium">×</span></li>
                            </ol>

                            <p class="text-[11px] text-gray-400 mt-3">
                                Format yang didukung: JPG, PNG, JPEG. Maksimal 5MB per foto.
                            </p>
                        </div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-sm font-medium text-gray-600">
                                Upload Foto Kos<span class="text-red-400">*</span>
                            </label>
                            <span class="text-xs text-gray-400" id="foto-count">
                                {{ count($existingFotos ?? []) }} foto dipilih
                            </span>
                        </div>



                        @php
                        $existingFotos = old(
                        'existing_foto',
                        is_array($kos->foto_galeri ?? null)
                        ? $kos->foto_galeri
                        : (json_decode($kos->foto_galeri ?? '[]', true) ?: [])
                        );
                        @endphp

                        {{-- Upload Area --}}
                        <label for="foto-input" id="drop-area"
                            class="relative flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:border-[#6C8B6B] hover:bg-[#f9fbf9] transition text-center py-10 px-6">

                            <svg class="w-12 h-12 text-[#6C8B6B] mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>

                            <p class="text-sm font-semibold text-gray-600">Klik atau Drag foto ke sini</p>
                            <p class="text-xs text-gray-400 mt-1">
                                Bisa upload banyak foto sekaligus (PNG, JPG, JPEG max 5MB/foto)
                            </p>

                            <input type="file" name="foto_galeri[]" id="foto-input" accept="image/*" multiple
                                class="hidden">
                        </label>

                        {{-- Preview Gallery --}}
                        <div id="preview-container" class="flex flex-wrap gap-4 mt-5">
                            @foreach($existingFotos as $index => $foto)
                            <div
                                class="foto-preview relative w-32 h-32 rounded-xl overflow-hidden border border-gray-200 group">

                                <img src="{{ asset('storage/' . $foto) }}" class="w-full h-full object-cover">

                                @if($index === 0)
                                <span
                                    class="absolute top-2 left-2 bg-[#6C8B6B] text-white text-[10px] px-2 py-1 rounded-md font-medium">
                                    Utama
                                </span>
                                @endif

                                <button type="button" onclick="hapusExistingFoto(this)"
                                    class="absolute top-2 right-2 w-7 h-7 rounded-full bg-black/60 text-white flex items-center justify-center text-sm font-bold hover:bg-red-500 transition z-20">
                                    ✕
                                </button>

                                <input type="hidden" name="existing_foto[]" value="{{ $foto }}">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <script>
                    const fotoInput = document.getElementById('foto-input');
                    const previewContainer = document.getElementById('preview-container');
                    const fotoCount = document.getElementById('foto-count');
                    const dropArea = document.getElementById('drop-area');

                    let selectedFiles = [];

                    function updateFotoCount() {
                        const existing = document.querySelectorAll('input[name="existing_foto[]"]').length;
                        fotoCount.textContent = `${existing + selectedFiles.length} foto dipilih`;
                    }

                    function renderPreview() {
                        previewContainer.querySelectorAll('.new-photo').forEach(el => el.remove());

                        selectedFiles.forEach((file, index) => {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                const div = document.createElement('div');
                                div.className =
                                    'foto-preview new-photo relative w-32 h-32 rounded-xl overflow-hidden border border-gray-200 group';

                                div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-full object-cover">

                ${(document.querySelectorAll('.foto-preview').length === 0 && index === 0) ? `
                    <span class="absolute top-2 left-2 bg-[#6C8B6B] text-white text-[10px] px-2 py-1 rounded-md font-medium">
                        Utama
                    </span>
                ` : ''}

                <button type="button"
                    class="absolute top-2 right-2 w-7 h-7 rounded-full bg-black/60 text-white flex items-center justify-center text-sm font-bold hover:bg-red-500 transition z-20"
                    onclick="hapusPreview(${index})">
                    ✕
                </button>
            `;

                                previewContainer.appendChild(div);
                            };

                            reader.readAsDataURL(file);
                        });

                        updateFotoCount();
                    }

                    function hapusPreview(index) {
                        selectedFiles.splice(index, 1);

                        const dt = new DataTransfer();
                        selectedFiles.forEach(file => dt.items.add(file));
                        fotoInput.files = dt.files;

                        renderPreview();
                    }

                    function hapusExistingFoto(button) {
                        button.closest('.foto-preview').remove();
                        updateFotoCount();
                    }

                    fotoInput.addEventListener('change', function(e) {
                        const files = Array.from(e.target.files);

                        files.forEach(file => {
                            if (file.type.startsWith('image/') && file.size <= 5 * 1024 * 1024) {
                                selectedFiles.push(file);
                            }
                        });

                        const dt = new DataTransfer();
                        selectedFiles.forEach(file => dt.items.add(file));
                        fotoInput.files = dt.files;

                        renderPreview();
                    });

                    ['dragenter', 'dragover'].forEach(eventName => {
                        dropArea.addEventListener(eventName, e => {
                            e.preventDefault();
                            dropArea.classList.add('border-[#6C8B6B]');
                        });
                    });

                    ['dragleave', 'drop'].forEach(eventName => {
                        dropArea.addEventListener(eventName, e => {
                            e.preventDefault();
                            dropArea.classList.remove('border-[#6C8B6B]');
                        });
                    });

                    dropArea.addEventListener('drop', e => {
                        const files = Array.from(e.dataTransfer.files);

                        files.forEach(file => {
                            if (file.type.startsWith('image/') && file.size <= 5 * 1024 * 1024) {
                                selectedFiles.push(file);
                            }
                        });

                        const dt = new DataTransfer();
                        selectedFiles.forEach(file => dt.items.add(file));
                        fotoInput.files = dt.files;

                        renderPreview();
                    });

                    updateFotoCount();
                    </script>

                </div>

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
<x-admin-layout>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">{{ $kos ? 'Edit' : 'Tambah' }} Informasi Kos</h1>
        <span class="text-gray-600 font-medium">Halo, {{ auth()->user()->name }}</span>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-3xl">

        <form method="POST" action="{{ $kos ? route('admin.informasi.update') : route('admin.informasi.store') }}" enctype="multipart/form-data">
            @csrf
            @if($kos) @method('PUT') @endif

            {{-- Nama Kos --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-1">Nama Kos <span class="text-red-400">*</span></label>
                <input type="text" name="nama_kos" value="{{ old('nama_kos', $kos->nama_kos ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
                    placeholder="Contoh: Kos Melati Indah" required>
                @error('nama_kos')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

{{-- Alamat --}}
<div class="mb-4">
    <label class="block text-sm text-gray-500 mb-1">Alamat Lengkap <span class="text-red-400">*</span></label>
    <textarea name="alamat" rows="2"
        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B] resize-none"
        placeholder="Nama jalan, nomor rumah, dll" required>{{ old('alamat', $kos->alamat ?? '') }}</textarea>
</div>

{{-- Kota --}}
<div class="mb-4">
    <label class="block text-sm text-gray-500 mb-1">Kota/Kabupaten</label>
    <input type="text" name="kota" value="{{ old('kota', $kos->kota ?? '') }}"
        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
        placeholder="Contoh: Banyuwangi">
</div>

{{-- Latitude & Longitude --}}
<div class="grid grid-cols-2 gap-4 mb-2">
    <div>
        <label class="block text-sm text-gray-500 mb-1">Latitude</label>
        <input type="text" name="latitude" id="input-lat"
            value="{{ old('latitude', $kos->latitude ?? '') }}"
            onchange="updatePeta()"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
            placeholder="-8.2192">
    </div>
    <div>
        <label class="block text-sm text-gray-500 mb-1">Longitude</label>
        <input type="text" name="longitude" id="input-lng"
            value="{{ old('longitude', $kos->longitude ?? '') }}"
            onchange="updatePeta()"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
            placeholder="114.3691">
    </div>
</div>

{{-- Petunjuk --}}
<div class="mb-4 p-3 rounded-lg" style="background:#f0f5f1;">
    <p class="text-xs font-semibold text-gray-600 mb-1">📍 Cara dapat koordinat dari Google Maps:</p>
    <ol class="text-xs text-gray-500 list-decimal list-inside space-y-1">
        <li>Buka <a href="https://maps.google.com" target="_blank" class="text-[#6C8B6B] underline">Google Maps</a></li>
        <li>Cari lokasi kos kamu</li>
        <li>Klik kanan tepat di lokasi → klik koordinat yang muncul (otomatis tercopy)</li>
        <li>Paste angka pertama ke Latitude, angka kedua ke Longitude</li>
    </ol>
    <p class="text-xs text-gray-400 mt-2">Contoh: <span class="font-mono">-8.2192, 114.3691</span></p>
</div>

{{-- Tombol Tampilkan Peta --}}
<div class="mb-2">
    <button type="button" onclick="tampilkanPeta()"
        style="display:inline-flex;align-items:center;gap:6px;background:#6C8B6B;color:white;padding:10px 20px;border-radius:8px;font-weight:600;border:none;cursor:pointer;font-size:0.85rem;">
        🗺️ Tampilkan Peta
    </button>
    <span class="text-xs text-gray-400 ml-2">Preview lokasi setelah isi koordinat</span>
</div>

{{-- Peta --}}
<div class="mb-6">
    <div id="map-error" style="display:none;padding:12px;background:#fee2e2;border-radius:8px;color:#ef4444;font-size:0.85rem;margin-bottom:8px;"></div>
    <div id="map-container" style="display:{{ (old('latitude', $kos->latitude ?? null)) ? 'block' : 'none' }};">
        <label class="block text-sm text-gray-500 mb-1">Preview Lokasi</label>
        <div id="map" style="height:280px;border-radius:12px;border:1px solid #e5e7eb;"></div>
        <p class="text-xs text-gray-400 mt-1">Drag pin untuk koreksi lokasi — koordinat update otomatis</p>
    </div>
</div>

{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map = null;
let marker = null;

// Auto tampilkan peta kalau sudah ada koordinat (mode edit)
window.addEventListener('load', function() {
    const lat = document.getElementById('input-lat').value;
    const lng = document.getElementById('input-lng').value;
    if (lat && lng) initMap(parseFloat(lat), parseFloat(lng));
});

function tampilkanPeta() {
    const lat = document.getElementById('input-lat').value.trim();
    const lng = document.getElementById('input-lng').value.trim();

    if (!lat || !lng) {
        document.getElementById('map-error').style.display = 'block';
        document.getElementById('map-error').textContent = '❌ Isi Latitude dan Longitude terlebih dahulu.';
        return;
    }

    const latNum = parseFloat(lat);
    const lngNum = parseFloat(lng);

    if (isNaN(latNum) || isNaN(lngNum)) {
        document.getElementById('map-error').style.display = 'block';
        document.getElementById('map-error').textContent = '❌ Format koordinat tidak valid. Contoh: -8.2192';
        return;
    }

    document.getElementById('map-error').style.display = 'none';
    initMap(latNum, lngNum);
}

function updatePeta() {
    // Auto update peta kalau peta sudah tampil
    if (map) tampilkanPeta();
}

function initMap(lat, lng) {
    document.getElementById('map-container').style.display = 'block';

    if (map) { map.remove(); map = null; }

    map = L.map('map').setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    marker = L.marker([lat, lng], { draggable: true }).addTo(map);

    // Update input saat pin di-drag
    marker.on('dragend', function(e) {
        const pos = e.target.getLatLng();
        document.getElementById('input-lat').value = pos.lat.toFixed(7);
        document.getElementById('input-lng').value = pos.lng.toFixed(7);
    });

    // Update input saat klik peta
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('input-lat').value = e.latlng.lat.toFixed(7);
        document.getElementById('input-lng').value = e.latlng.lng.toFixed(7);
    });
}
</script>

            {{-- No Telepon & Harga --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-gray-500 mb-1">No. Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $kos->no_telepon ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
                        placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Harga Mulai (Rp)</label>
                    <input type="number" name="harga_mulai" value="{{ old('harga_mulai', $kos->harga_mulai ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
                        placeholder="500000">
                </div>
            </div>

            {{-- Tipe Kos --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-1">Tipe Kos <span class="text-red-400">*</span></label>
                <select name="tipe_kos"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]">
                    <option value="campur" {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'campur' ? 'selected' : '' }}>Campur</option>
                    <option value="putra" {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="putri" {{ old('tipe_kos', $kos->tipe_kos ?? '') == 'putri' ? 'selected' : '' }}>Putri</option>
                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B] resize-none"
                    placeholder="Ceritakan tentang kos Anda...">{{ old('deskripsi', $kos->deskripsi ?? '') }}</textarea>
            </div>

            {{-- Fasilitas Umum --}}
<div class="mb-4">
    <label class="block text-sm text-gray-500 mb-2">Fasilitas Umum</label>

    <div id="fasilitas-list" class="flex flex-wrap gap-2 mb-3 min-h-[40px]">
        @php $selected = old('fasilitas', $kos->fasilitas ?? []); @endphp
        @foreach($selected as $item)
        <div class="fasilitas-item flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm font-medium"
             style="background:#f0f5f1;color:#3a5c3a;">
            <span>{{ $item }}</span>
            <input type="hidden" name="fasilitas[]" value="{{ $item }}">
            <button type="button" onclick="hapusFasilitas(this)"
                style="background:none;border:none;cursor:pointer;color:#6C8B6B;font-size:14px;padding:0;margin-left:4px;line-height:1;">
                ✕
            </button>
        </div>
        @endforeach
    </div>

    <div class="flex gap-2">
        <input type="text" id="input-fasilitas"
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B]"
            placeholder="Contoh: WiFi, Parkir, Dapur Bersama..."
            onkeydown="if(event.key==='Enter'){event.preventDefault();tambahFasilitas()}">
        <button type="button" onclick="tambahFasilitas()"
            style="background:#6C8B6B;color:white;padding:10px 20px;border-radius:8px;font-weight:600;border:none;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
            + Tambah
        </button>
    </div>
    <p class="text-xs text-gray-400 mt-1">Ketik nama fasilitas lalu klik Tambah atau tekan Enter. Klik ✕ untuk menghapus.</p>
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
    div.className = 'fasilitas-item flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm font-medium';
    div.style.cssText = 'background:#f0f5f1;color:#3a5c3a;';
    div.innerHTML = `
        <span>${nilai}</span>
        <input type="hidden" name="fasilitas[]" value="${nilai}">
        <button type="button" onclick="hapusFasilitas(this)"
            style="background:none;border:none;cursor:pointer;color:#6C8B6B;font-size:14px;padding:0;margin-left:4px;line-height:1;">
            ✕
        </button>
    `;
    list.appendChild(div);
    input.value = '';
    input.focus();
}

function hapusFasilitas(btn) {
    btn.closest('.fasilitas-item').remove();
}
</script>

            {{-- Foto Utama --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-1">Foto Utama</label>
                @if($kos && $kos->foto_utama)
                <div class="mb-2">
                    <img src="{{ Storage::url($kos->foto_utama) }}" class="h-32 rounded-lg object-cover">
                    <p class="text-xs text-gray-400 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                </div>
                @endif
                <input type="file" name="foto_utama" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm">
                @error('foto_utama')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Foto Galeri --}}
            <div class="mb-6">
                <label class="block text-sm text-gray-500 mb-1">Foto Galeri (bisa lebih dari 1)</label>
                <input type="file" name="foto_galeri[]" accept="image/*" multiple
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm">
                <p class="text-xs text-gray-400 mt-1">Upload multiple foto sekaligus dengan menahan Ctrl/Cmd</p>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                    style="background:#6C8B6B;color:white;padding:10px 28px;border-radius:8px;font-weight:600;border:none;cursor:pointer;">
                    {{ $kos ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.informasi.index') }}"
                    style="background:#f3f4f6;color:#4b5563;padding:10px 28px;border-radius:8px;font-weight:600;text-decoration:none;">
                    Batal
                </a>
            </div>

        </form>
    </div>

</x-admin-layout>
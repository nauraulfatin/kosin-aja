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

            {{-- Alamat & Kota --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Alamat <span class="text-red-400">*</span></label>
                    <textarea name="alamat" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B] resize-none"
                        placeholder="Alamat lengkap kos" required>{{ old('alamat', $kos->alamat ?? '') }}</textarea>
                    @error('alamat')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Kota</label>
                    <input type="text" name="kota" value="{{ old('kota', $kos->kota ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
                        placeholder="Contoh: Banyuwangi">
                </div>
            </div>

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

            {{-- Fasilitas --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-2">Fasilitas</label>
                <div class="grid grid-cols-3 gap-2">
                    @php
                    $fasilitasList = ['WiFi', 'AC', 'KM Dalam', 'Dapur', 'Parkir', 'Laundry', 'CCTV', 'Kolam Renang', 'Gym', 'TV', 'Kulkas', 'Dispenser'];
                    $selected = old('fasilitas', $kos->fasilitas ?? []);
                    @endphp
                    @foreach($fasilitasList as $item)
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="fasilitas[]" value="{{ $item }}"
                            {{ in_array($item, $selected) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-[#6C8B6B]">
                        {{ $item }}
                    </label>
                    @endforeach
                </div>
            </div>

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
<x-admin-layout>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">{{ $kamar ? 'Edit Kamar' : 'Tambah Kamar' }}</h1>
        <span class="text-gray-600 font-medium">Halo, {{ auth()->user()->name }}</span>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-2xl">

        <form method="POST"
            action="{{ $kamar ? route('admin.kamar.update', $kamar->id) : route('admin.kamar.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if($kamar) @method('PUT') @endif

            {{-- Nomor Kamar & Harga --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Nomor Kamar <span class="text-red-400">*</span></label>
                    <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar', $kamar->nomor_kamar ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
                        placeholder="Contoh: 101" required>
                    @error('nomor_kamar')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-500 mb-1">Harga/Bulan (Rp) <span class="text-red-400">*</span></label>
                    <input type="number" name="harga" value="{{ old('harga', $kamar->harga ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]"
                        placeholder="500000" required>
                    @error('harga')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-1">Status <span class="text-red-400">*</span></label>
                <select name="status"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B]">
                    <option value="kosong" {{ old('status', $kamar->status ?? '') == 'kosong' ? 'selected' : '' }}>Kosong</option>
                    <option value="terisi" {{ old('status', $kamar->status ?? '') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>

            {{-- Foto Kamar --}}
<div class="mb-4">
    <label class="block text-sm text-gray-500 mb-1">Foto Kamar (bisa lebih dari 1)</label>
    @if($kamar && $kamar->foto_kamar)
    <div class="grid grid-cols-4 gap-2 mb-2">
        @foreach(json_decode($kamar->foto_kamar, true) ?? [] as $foto)
        <img src="{{ Storage::url($foto) }}" class="h-24 w-full object-cover rounded-lg">
        @endforeach
    </div>
    <p class="text-xs text-gray-400 mb-2">Foto saat ini. Upload baru untuk menambah.</p>
    @endif
    <input type="file" name="foto_kamar[]" accept="image/*" multiple
        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm">
    <p class="text-xs text-gray-400 mt-1">Tahan Ctrl/Cmd untuk pilih beberapa foto sekaligus</p>
</div>

            {{-- Fasilitas Kamar --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-2">Fasilitas Kamar</label>
                <div class="grid grid-cols-3 gap-2">
                    @php
                    $fasilitasList = ['AC', 'WiFi', 'KM Dalam', 'Lemari', 'Kasur', 'Meja Belajar', 'Kursi', 'TV', 'Kulkas', 'Dispenser', 'Jendela', 'Kipas Angin'];
                    $selected = old('fasilitas', $kamar->fasilitas ?? []);
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

            {{-- Keterangan --}}
            <div class="mb-6">
                <label class="block text-sm text-gray-500 mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B] resize-none"
                    placeholder="Keterangan tambahan tentang kamar...">{{ old('keterangan', $kamar->keterangan ?? '') }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                    style="background:#6C8B6B;color:white;padding:10px 28px;border-radius:8px;font-weight:600;border:none;cursor:pointer;">
                    {{ $kamar ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('admin.kamar.index') }}"
                    style="background:#f3f4f6;color:#4b5563;padding:10px 28px;border-radius:8px;font-weight:600;text-decoration:none;">
                    Batal
                </a>
            </div>

        </form>
    </div>

</x-admin-layout>
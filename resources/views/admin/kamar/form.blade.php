<x-admin-layout>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-700">{{ $kamar ? 'Edit Kamar' : 'Tambah Kamar' }}</h1>
            <p class="text-sm text-gray-400 mt-0.5">Lengkapi informasi kamar untuk ditampilkan kepada calon penyewa.</p>
        </div>
        <span class="text-gray-600 font-medium text-sm">Halo, {{ auth()->user()->name }}</span>
    </div>

    <form method="POST" action="{{ $kamar ? route('admin.kamar.update', $kamar->id) : route('admin.kamar.store') }}"
        enctype="multipart/form-data" id="form-kamar">
        @csrf
        @if($kamar) @method('PUT') @endif

        <div class="flex gap-6 items-start">

            {{-- Kolom Kiri: Form Utama --}}
            <div class="flex-1 min-w-0 space-y-6">

                {{-- Nomor Kamar & Harga --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">
                                Nomor / Nama Kamar <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nomor_kamar"
                                value="{{ old('nomor_kamar', $kamar->nomor_kamar ?? '') }}"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B] transition"
                                placeholder="Contoh: 101, A1, Kamar Depan" required>
                            @error('nomor_kamar')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">
                                Harga per Bulan (Rp) <span class="text-red-400">*</span>
                            </label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-500 bg-gray-50 border border-r-0 border-gray-200 rounded-l-lg">Rp</span>
                                <input type="number" name="harga" value="{{ old('harga', $kamar->harga ?? '') }}"
                                    class="flex-1 border border-gray-200 rounded-r-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B] transition"
                                    placeholder="Contoh: 500000" required>
                            </div>
                            @error('harga')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- ========================= --}}
                {{-- REVISI FULL BAGIAN FOTO KAMAR --}}
                {{-- GANTI BAGIAN FOTO KAMAR LAMA DENGAN INI --}}
                {{-- ========================= --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-sm font-medium text-gray-600">
                            Foto Kamar <span class="text-red-400">*</span>
                        </label>
                        <span class="text-xs text-gray-400" id="foto-count">
                            {{ $kamar && !empty($kamar->foto_kamar) ? count($kamar->foto_kamar) : 0 }}/6 foto
                        </span>
                    </div>

                    <p class="text-xs text-gray-400 mb-4">
                        Upload hingga 6 foto. Foto pertama otomatis menjadi foto utama.
                    </p>

                    @php
                    $existingFotos = old(
                    'existing_foto',
                    is_array($kamar->foto_kamar ?? null)
                    ? $kamar->foto_kamar
                    : (json_decode($kamar->foto_kamar ?? '[]', true) ?: [])
                    );
                    @endphp

                    <div id="drop-area" class="grid grid-cols-6 gap-3">

                        {{-- FOTO UTAMA --}}
                        <label for="foto-input" id="foto-utama-label"
                            class="col-span-2 row-span-2 relative flex items-center justify-center border-2 border-dashed border-gray-200 rounded-xl cursor-pointer hover:border-[#6C8B6B] hover:bg-[#f9fbf9] transition text-center min-h-[180px] overflow-hidden">

                            @if(isset($existingFotos[0]))
                            <div class="relative w-full h-full group existing-photo">
                                <img src="{{ asset('storage/' . $existingFotos[0]) }}"
                                    src=class="w-full h-full object-cover rounded-xl">

                                <button type="button" onclick="hapusExistingFoto(this, '{{ $existingFotos[0] }}')"
                                    class="absolute top-2 right-2 z-20 w-7 h-7 rounded-full bg-black/60 text-white flex items-center justify-center text-sm font-semibold hover:bg-red-500 transition">
                                    ✕
                                </button>

                                <input type="hidden" name="existing_foto[]" value="{{ $existingFotos[0] }}">
                            </div>
                            @else
                            <div id="upload-placeholder" class="flex flex-col items-center justify-center p-4">
                                <svg class="w-10 h-10 text-[#6C8B6B] mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <p class="text-sm text-gray-500 font-medium">Klik / Drag foto</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG (max 5MB)</p>
                            </div>
                            @endif
                        </label>

                        <input type="file" name="foto_kamar[]" id="foto-input" accept="image/*" multiple class="hidden">

                        {{-- SLOT TAMBAHAN --}}
                        @for($i = 1; $i <= 5; $i++) <div
                            class="foto-slot relative border border-gray-200 rounded-xl min-h-[80px] flex items-center justify-center overflow-hidden bg-gray-50">
                            @if(isset($existingFotos[$i]))
                            <div class="relative w-full h-full group existing-photo">
                                <img src="{{ asset('storage/' . $existingFotos[$i]) }}"
                                    class="w-full h-full object-cover rounded-xl">

                                <button type="button" onclick="hapusExistingFoto(this, '{{ $existingFotos[$i] }}')"
                                    class="absolute top-2 right-2 z-20 w-6 h-6 rounded-full bg-black/60 text-white flex items-center justify-center text-xs font-semibold hover:bg-red-500 transition">
                                    ✕
                                </button>

                                <input type="hidden" name="existing_foto[]" value="{{ $existingFotos[$i] }}">
                            </div>
                            @else
                            <div class="placeholder text-center text-gray-300">
                                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169" />
                                </svg>
                                <p class="text-[10px]">Kosong</p>
                            </div>
                            @endif
                    </div>
                    @endfor
                </div>
            </div>


            {{-- Fasilitas Kamar --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <label class="block text-sm font-medium text-gray-600 mb-3">Fasilitas Kamar</label>

                <div id="fasilitas-list" class="flex flex-wrap gap-2 mb-3 min-h-[36px]">
                    @php $selected = old('fasilitas', $kamar->fasilitas ?? []); @endphp
                    @foreach($selected as $item)
                    <div
                        class="fasilitas-item inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-[#f0f5f0] text-[#3a5c3a]">
                        <span>{{ $item }}</span>
                        <input type="hidden" name="fasilitas[]" value="{{ $item }}">
                        <button type="button" onclick="hapusFasilitas(this)"
                            class="text-[#6C8B6B] hover:text-red-400 transition leading-none text-base"
                            aria-label="Hapus fasilitas">✕</button>
                    </div>
                    @endforeach
                </div>

                <div class="flex gap-2">
                    <input type="text" id="input-fasilitas"
                        class="flex-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B] transition"
                        placeholder="Contoh: WiFi, AC, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar..."
                        onkeydown="if(event.key==='Enter'){event.preventDefault();tambahFasilitas()}">
                    <button type="button" onclick="tambahFasilitas()"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-lg text-sm font-semibold text-white transition"
                        style="background:#6C8B6B;">
                        <span class="text-base leading-none">+</span> Tambah
                    </button>
                </div>
                <p class="text-xs text-gray-400 mt-2">Ketik fasilitas lalu klik Tambah atau tekan Enter. Klik ✕
                    untuk
                    menghapus.</p>
            </div>

            {{-- Keterangan --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Keterangan Tambahan</label>
                <div class="relative">
                    <textarea name="keterangan" rows="4" maxlength="500" id="keterangan-input"
                        class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B] transition resize-none"
                        placeholder="Contoh: Kamar luas dan nyaman, dekat dapur, akses parkir motor di depan kamar, dll."
                        oninput="updateCharCount(this)">{{ old('keterangan', $kamar->keterangan ?? '') }}</textarea>
                    <p class="text-xs text-gray-400 text-right mt-1" id="char-count">
                        {{ strlen(old('keterangan', $kamar->keterangan ?? '')) }}/500
                    </p>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex gap-3 pb-8">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg text-sm font-semibold text-white transition hover:opacity-90"
                    style="background:#6C8B6B;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ $kamar ? 'Update Kamar' : 'Simpan Kamar' }}
                </button>
                <a href="{{ route('admin.kamar.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
            </div>
        </div>

        {{-- Kolom Kanan: Informasi Lainnya --}}
        <div class="w-72 flex-shrink-0">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 sticky top-6">
                <div class="flex items-center gap-2 mb-5">
                    <svg class="w-4 h-4 text-[#6C8B6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    <h3 class="text-sm font-semibold text-gray-700">Informasi Lainnya</h3>
                </div>

                <div class="space-y-4">
                    {{-- Tipe Kamar --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">
                            Tipe Kamar <span class="text-red-400">*</span>
                        </label>
                        <select name="tipe_kamar"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B] transition bg-white text-gray-700">
                            <option value="">Pilih tipe kamar</option>
                            <option value="standar"
                                {{ old('tipe_kamar', $kamar->tipe_kamar ?? '') == 'standar' ? 'selected' : '' }}>
                                Standar
                            </option>
                            <option value="deluxe"
                                {{ old('tipe_kamar', $kamar->tipe_kamar ?? '') == 'deluxe' ? 'selected' : '' }}>
                                Deluxe
                            </option>
                            <option value="vip"
                                {{ old('tipe_kamar', $kamar->tipe_kamar ?? '') == 'vip' ? 'selected' : '' }}>VIP
                            </option>
                        </select>
                        @error('tipe_kamar')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Kapasitas Penghuni --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">
                            Kapasitas Penghuni <span class="text-red-400">*</span>
                        </label>
                        <select name="kapasitas"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B] transition bg-white text-gray-700">
                            <option value="">Pilih kapasitas</option>
                            <option value="1" {{ old('kapasitas', $kamar->kapasitas ?? '') == '1' ? 'selected' : '' }}>1
                                Orang</option>
                            <option value="2" {{ old('kapasitas', $kamar->kapasitas ?? '') == '2' ? 'selected' : '' }}>2
                                Orang</option>
                            <option value="3" {{ old('kapasitas', $kamar->kapasitas ?? '') == '3' ? 'selected' : '' }}>3
                                Orang</option>
                        </select>
                        @error('kapasitas')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Lantai --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">Lantai</label>
                        <select name="lantai"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B] focus:ring-1 focus:ring-[#6C8B6B] transition bg-white text-gray-700">
                            <option value="">Pilih lantai (opsional)</option>
                            <option value="1" {{ old('lantai', $kamar->lantai ?? '') == '1' ? 'selected' : '' }}>
                                Lantai
                                1</option>
                            <option value="2" {{ old('lantai', $kamar->lantai ?? '') == '2' ? 'selected' : '' }}>
                                Lantai
                                2</option>
                            <option value="3" {{ old('lantai', $kamar->lantai ?? '') == '3' ? 'selected' : '' }}>
                                Lantai
                                3</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </form>

    <script>
    function tambahFasilitas() {
        const input = document.getElementById('input-fasilitas');
        const nilai = input.value.trim();
        if (!nilai) return;

        const list = document.getElementById('fasilitas-list');
        const existing = list.querySelectorAll('input[name="fasilitas[]"]');
        for (let i = 0; i < existing.length; i++) {
            if (existing[i].value.toLowerCase() === nilai.toLowerCase()) {
                input.value = '';
                return;
            }
        }

        const div = document.createElement('div');
        div.className =
            'fasilitas-item inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-[#f0f5f0] text-[#3a5c3a]';
        div.innerHTML = `
        <span>${nilai}</span>
        <input type="hidden" name="fasilitas[]" value="${nilai}">
        <button type="button" onclick="hapusFasilitas(this)"
            class="text-[#6C8B6B] hover:text-red-400 transition leading-none text-base"
            aria-label="Hapus fasilitas">✕</button>
    `;
        list.appendChild(div);
        input.value = '';
        input.focus();
    }

    function hapusFasilitas(btn) {
        btn.closest('.fasilitas-item').remove();
    }

    function updateCharCount(textarea) {
        document.getElementById('char-count').textContent = textarea.value.length + '/500';
    }

    // Preview foto saat dipilih
    const fotoInput = document.getElementById('foto-input');
    const fotoUtama = document.getElementById('foto-utama-label');
    const fotoSlots = document.querySelectorAll('.foto-slot');
    const fotoCount = document.getElementById('foto-count');

    let selectedFiles = [];

    function updateFotoCount() {
        const existing = document.querySelectorAll('input[name="existing_foto[]"]').length;
        fotoCount.textContent = `${selectedFiles.length + existing}/6 foto`;
    }

    function createPreview(file, index) {
        if (file.size > 5 * 1024 * 1024) {
            alert(`File ${file.name} melebihi 5MB`);
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const isUtama = index === 0;
            const target = isUtama ? fotoUtama : fotoSlots[index - 1];
            if (!target) return;

            target.innerHTML = `
            <div class="relative w-full h-full group">
                <img src="${e.target.result}" class="w-full h-full object-cover rounded-xl">
                <button type="button"
                    onclick="hapusPreview(${index})"
                    class="absolute top-2 right-2 z-20 w-7 h-7 rounded-full bg-black/60 text-white flex items-center justify-center text-sm font-semibold hover:bg-red-500 transition">
                    ✕
                </button>
            </div>
        `;
        };
        reader.readAsDataURL(file);
    }

    function refreshPreview() {
        fotoUtama.innerHTML = `
        <div id="upload-placeholder" class="flex flex-col items-center justify-center p-4">
            <svg class="w-10 h-10 text-[#6C8B6B] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
            </svg>
            <p class="text-sm text-gray-500 font-medium">Klik / Drag foto</p>
            <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG (max 5MB)</p>
        </div>
    `;

        fotoSlots.forEach(slot => {
            slot.innerHTML = `
            <div class="placeholder text-center text-gray-300">
                <p class="text-[10px]">Kosong</p>
            </div>
        `;
        });

        selectedFiles.forEach((file, i) => createPreview(file, i));
        updateFotoCount();
    }

    function hapusPreview(index) {
        selectedFiles.splice(index, 1);

        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fotoInput.files = dt.files;

        refreshPreview();
    }

    function hapusExistingFoto(button, path) {
        const wrapper = button.closest('.existing-photo');
        if (!wrapper) return;

        // hapus hidden input existing_foto[] supaya tidak ikut terkirim
        const hiddenInput = wrapper.querySelector('input[name="existing_foto[]"]');
        if (hiddenInput) {
            hiddenInput.remove();
        }

        // cari parent slot
        const parentSlot = wrapper.parentElement;

        // ganti jadi placeholder kosong
        if (parentSlot.id === 'foto-utama-label') {
            parentSlot.innerHTML = `
            <div id="upload-placeholder" class="flex flex-col items-center justify-center p-4">
                <svg class="w-10 h-10 text-[#6C8B6B] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                <p class="text-sm text-gray-500 font-medium">Klik / Drag foto</p>
                <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG (max 5MB)</p>
            </div>
        `;
        } else {
            parentSlot.innerHTML = `
            <div class="placeholder text-center text-gray-300">
                <svg class="w-5 h-5 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23" />
                </svg>
                <p class="text-[10px]">Kosong</p>
            </div>
        `;
        }

        updateFotoCount();
    }

    fotoInput.addEventListener('change', function(e) {
        const newFiles = Array.from(e.target.files);

        if ((selectedFiles.length + newFiles.length) > 6) {
            alert('Maksimal 6 foto');
            return;
        }

        newFiles.forEach(file => {
            if (file.size <= 5 * 1024 * 1024) {
                selectedFiles.push(file);
            } else {
                alert(`File ${file.name} melebihi 5MB`);
            }
        });

        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fotoInput.files = dt.files;

        refreshPreview();
    });

    const dropArea = document.getElementById('drop-area');

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
        const droppedFiles = Array.from(e.dataTransfer.files);

        if ((selectedFiles.length + droppedFiles.length) > 6) {
            alert('Maksimal 6 foto');
            return;
        }

        droppedFiles.forEach(file => {
            if (file.type.startsWith('image/') && file.size <= 5 * 1024 * 1024) {
                selectedFiles.push(file);
            }
        });

        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fotoInput.files = dt.files;

        refreshPreview();
    });

    updateFotoCount();
    </script>
</x-admin-layout>
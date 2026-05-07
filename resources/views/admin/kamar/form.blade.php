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

            {{-- Foto Kamar --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-1">Foto Kamar (bisa lebih dari 1)</label>
                @if($kamar && $kamar->foto_kamar)
                <div class="grid grid-cols-4 gap-2 mb-2">
                    @foreach($kamar->foto_kamar as $foto)
                    <img src="{{ Storage::url($foto) }}" class="h-24 w-full object-cover rounded-lg">
                    @endforeach
                </div>
                <p class="text-xs text-gray-400 mb-2">Foto saat ini. Upload baru untuk menambah.</p>
                @endif
                <input type="file" name="foto_kamar[]" accept="image/*" multiple
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm">
                <p class="text-xs text-gray-400 mt-1">Tahan Ctrl/Cmd untuk pilih beberapa foto sekaligus</p>
            </div>

            {{-- Fasilitas Kamar - Input Manual --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-500 mb-2">Fasilitas Kamar</label>

                <div id="fasilitas-list" class="flex flex-wrap gap-2 mb-3 min-h-[40px]">
                    @php $selected = old('fasilitas', $kamar->fasilitas ?? []); @endphp
                    @foreach($selected as $item)
                    <div class="fasilitas-item flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm font-medium"
                         style="background:#f0f5f1;color:#3a5c3a;">
                        <span>{{ $item }}</span>
                        <input type="hidden" name="fasilitas[]" value="{{ $item }}">
                        <button type="button" onclick="hapusFasilitas(this)"
                            style="background:none;border:none;cursor:pointer;color:#6C8B6B;font-size:14px;padding:0;margin-left:4px;line-height:1;">✕</button>
                    </div>
                    @endforeach
                </div>

                <div class="flex gap-2">
                    <input type="text" id="input-fasilitas"
                        class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#6C8B6B]"
                        placeholder="Contoh: AC, Kasur, Lemari..."
                        onkeydown="if(event.key==='Enter'){event.preventDefault();tambahFasilitas()}">
                    <button type="button" onclick="tambahFasilitas()"
                        style="background:#6C8B6B;color:white;padding:10px 20px;border-radius:8px;font-weight:600;border:none;cursor:pointer;font-size:0.85rem;white-space:nowrap;">
                        + Tambah
                    </button>
                </div>
                <p class="text-xs text-gray-400 mt-1">Ketik fasilitas lalu klik Tambah atau tekan Enter. Klik ✕ untuk menghapus.</p>
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
        div.className = 'fasilitas-item flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm font-medium';
        div.style.cssText = 'background:#f0f5f1;color:#3a5c3a;';
        div.innerHTML = `
            <span>${nilai}</span>
            <input type="hidden" name="fasilitas[]" value="${nilai}">
            <button type="button" onclick="hapusFasilitas(this)"
                style="background:none;border:none;cursor:pointer;color:#6C8B6B;font-size:14px;padding:0;margin-left:4px;line-height:1;">✕</button>
        `;
        list.appendChild(div);
        input.value = '';
        input.focus();
    }

    function hapusFasilitas(btn) {
        btn.closest('.fasilitas-item').remove();
    }
    </script>

</x-admin-layout>
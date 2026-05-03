<x-admin-layout>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">Daftar Kamar</h1>
        <span class="text-gray-600 font-medium">Halo, {{ auth()->user()->name }}</span>
    </div>

    @if(session('success'))
    <div style="background:#dcfce7;color:#16a34a;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:0.9rem;">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-[#0F0937]">Daftar Kamar</h2>
        <a href="{{ route('admin.kamar.create') }}"
            style="display:inline-flex;align-items:center;gap:6px;background:#6C8B6B;color:white;padding:10px 20px;border-radius:8px;font-weight:600;text-decoration:none;font-size:0.9rem;">
            + Tambah Kamar
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">No.</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">No. Kamar</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">Harga/Bulan</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">Status</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">Penghuni</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kamars as $index => $kamar)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-4 px-4 text-center text-gray-500">{{ $index + 1 }}.</td>
                    <td class="py-4 px-4 text-center font-semibold text-[#0F0937]">{{ $kamar->nomor_kamar }}</td>
                    <td class="py-4 px-4 text-center text-gray-600">Rp. {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                    <td class="py-4 px-4 text-center">
                        @if($kamar->status == 'terisi')
                            <span style="display:inline-block;background:#d1fae5;color:#059669;font-size:12px;font-weight:600;padding:4px 14px;border-radius:20px;">
                                Terisi
                            </span>
                        @else
                            <span style="display:inline-block;background:#e0f2fe;color:#0284c7;font-size:12px;font-weight:600;padding:4px 14px;border-radius:20px;">
                                Kosong
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-4 text-center text-gray-600">
                        {{ $kamar->penghuni ? $kamar->penghuni->nama : '-' }}
                    </td>
                    <td class="py-4 px-4 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.kamar.edit', $kamar->id) }}"
                                class="text-gray-400 hover:text-[#6C8B6B] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.kamar.destroy', $kamar->id) }}"
                                onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-gray-400">Belum ada kamar. Klik tombol Tambah Kamar untuk menambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-admin-layout>
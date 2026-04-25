<x-superadmin-layout>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">Riwayat</h1>
        <span class="text-gray-600 font-medium">Halo, {{ auth()->user()->name }}</span>
    </div>

    {{-- Judul + Filter Bulan --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#0F0937]">Riwayat Pengajuan Admin Kos</h2>

        {{-- Filter Bulan --}}
        <form method="GET" action="{{ route('superadmin.riwayat') }}">
            <select name="bulan" onchange="this.form.submit()"
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-600 focus:ring-[#6C8B6B] focus:border-[#6C8B6B]">
                <option value="">Semua Bulan</option>
                <option value="1"  {{ request('bulan') == '1'  ? 'selected' : '' }}>Januari</option>
                <option value="2"  {{ request('bulan') == '2'  ? 'selected' : '' }}>Februari</option>
                <option value="3"  {{ request('bulan') == '3'  ? 'selected' : '' }}>Maret</option>
                <option value="4"  {{ request('bulan') == '4'  ? 'selected' : '' }}>April</option>
                <option value="5"  {{ request('bulan') == '5'  ? 'selected' : '' }}>Mei</option>
                <option value="6"  {{ request('bulan') == '6'  ? 'selected' : '' }}>Juni</option>
                <option value="7"  {{ request('bulan') == '7'  ? 'selected' : '' }}>Juli</option>
                <option value="8"  {{ request('bulan') == '8'  ? 'selected' : '' }}>Agustus</option>
                <option value="9"  {{ request('bulan') == '9'  ? 'selected' : '' }}>September</option>
                <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
            </select>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
   <table class="w-full text-sm border-collapse">
    <thead>
        <tr class="border-b border-gray-200">
            <th class="py-3 px-4 text-center text-gray-500 font-medium">No.</th>
            <th class="py-3 px-4 text-center text-gray-500 font-medium">Nama</th>
            <th class="py-3 px-4 text-center text-gray-500 font-medium">Email</th>
            <th class="py-3 px-4 text-center text-gray-500 font-medium">Tanggal</th>
            <th class="py-3 px-4 text-center text-gray-500 font-medium">Status</th>
            <th class="py-3 px-4 text-center text-gray-500 font-medium">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($riwayat as $index => $admin)
        <tr class="border-b border-gray-100 last:border-0">
            <td class="py-4 px-4 text-center text-gray-500">{{ $index + 1 }}.</td>
            <td class="py-4 px-4 text-center font-semibold text-[#0F0937]">{{ $admin->name }}</td>
            <td class="py-4 px-4 text-center text-gray-500">{{ $admin->email }}</td>
            <td class="py-4 px-4 text-center text-gray-500">{{ $admin->created_at->format('d/m/Y') }}</td>
            <td class="py-4 px-4 text-center">
                @if($admin->status == 'approved')
                    <span style="display:inline-block; background-color:#dcfce7; color:#16a34a; font-size:12px; font-weight:600; padding:4px 14px; border-radius:6px;">
                        Diterima
                    </span>
                @else
                    <span style="display:inline-block; background-color:#fee2e2; color:#ef4444; font-size:12px; font-weight:600; padding:4px 14px; border-radius:6px;">
                        Ditolak
                    </span>
                @endif
            </td>
            <td class="py-4 px-4">
                <div class="flex items-center justify-center gap-3">
                    <a href="{{ route('superadmin.pengajuan.detail', $admin->id) }}"
                        class="text-gray-400 hover:text-[#6C8B6B] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('superadmin.riwayat.hapus', $admin->id) }}"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
            <td colspan="6" class="py-6 text-center text-gray-400">Belum ada riwayat pengajuan</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

</x-superadmin-layout>
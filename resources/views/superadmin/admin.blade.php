<x-superadmin-layout>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">Daftar Admin Kos</h1>
        <span class="text-gray-600 font-medium">Halo, {{ auth()->user()->name }}</span>
    </div>

    <h2 class="text-2xl font-bold text-[#0F0937] mb-6">Daftar Admin Kos</h2>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">No.</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">Nama</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">Nama Kos</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">No. Telepon</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">Tanggal Bergabung</th>
                    <th class="py-3 px-4 text-center text-gray-500 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admins as $index => $admin)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-4 px-4 text-center text-gray-500">{{ $index + 1 }}.</td>
                    <td class="py-4 px-4 text-center font-semibold text-[#0F0937]">{{ $admin->name }}</td>
                    <td class="py-4 px-4 text-center text-gray-500">{{ $admin->nama_kos ?? '-' }}</td>
                    <td class="py-4 px-4 text-center text-gray-500">{{ $admin->phone ?? '-' }}</td>
                    <td class="py-4 px-4 text-center text-gray-500">{{ $admin->created_at->format('d/m/Y') }}</td>
                    <td class="py-4 px-4 text-center">
                        <a href="{{ route('superadmin.pengajuan.detail', $admin->id) }}"
                            style="display:inline-block; background-color:#6C8B6B; color:white; font-size:12px; font-weight:600; padding:6px 16px; border-radius:8px; text-decoration:none;">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-gray-400">Belum ada admin kos yang disetujui</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-superadmin-layout>
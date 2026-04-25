<x-superadmin-layout>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">Daftar Pengajuan</h1>
        <span class="text-gray-600 font-medium">Halo, {{ auth()->user()->name }}</span>
    </div>

    {{-- Judul --}}
    <h2 class="text-2xl font-bold text-[#0F0937] mb-6">Daftar Pengajuan Admin Kos</h2>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <table class="w-full text-sm">
            <tbody>
                @forelse ($pengajuan as $index => $admin)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-3 px-2 text-gray-500 w-8">{{ $index + 1 }}</td>
                    <td class="py-3 px-2 font-semibold text-[#0F0937]">{{ $admin->name }}</td>
                    <td class="py-3 px-2 text-gray-500">{{ $admin->email }}</td>
                    <td class="py-3 px-2 text-gray-500">{{ $admin->created_at->format('d/m/Y') }}</td>
                    <td class="py-3 px-2 text-right">
                        <a href="{{ route('superadmin.pengajuan.detail', $admin->id) }}" 
                           class="bg-[#6C8B6B] hover:bg-[#5a7a59] text-white text-xs px-3 py-1.5 rounded-lg transition">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-6 text-center text-gray-400">Belum ada pengajuan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-superadmin-layout>
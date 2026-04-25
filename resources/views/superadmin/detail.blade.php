<x-superadmin-layout>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">Lihat Detail</h1>
        <span class="text-gray-600 font-medium">Halo, {{ auth()->user()->name }}</span>
    </div>

    <h2 class="text-2xl font-bold text-[#0F0937] mb-6">Daftar Pengajuan Admin Kos</h2>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-2xl">
        <h3 class="text-base font-bold text-[#0F0937] mb-6">Lihat Detail</h3>

        <table class="w-full text-sm">
            <tr>
                <td class="py-2 text-gray-600 w-40">Nama Lengkap</td>
                <td class="py-2 text-gray-400 w-4">:</td>
                <td class="py-2 text-gray-800 font-medium">{{ $admin->name }}</td>
            </tr>
            <tr>
                <td class="py-2 text-gray-600">Nomor Telepon</td>
                <td class="py-2 text-gray-400">:</td>
                <td class="py-2 text-gray-800 font-medium">{{ $admin->phone ?? '-' }}</td>
            </tr>
            <tr>
                <td class="py-2 text-gray-600">Email</td>
                <td class="py-2 text-gray-400">:</td>
                <td class="py-2 text-gray-800 font-medium">{{ $admin->email }}</td>
            </tr>
            <tr>
                <td class="py-2 text-gray-600">Nama Kos</td>
                <td class="py-2 text-gray-400">:</td>
                <td class="py-2 text-gray-800 font-medium">{{ $admin->nama_kos ?? '-' }}</td>
            </tr>
            <tr>
                <td class="py-2 text-gray-600">Alamat Kos</td>
                <td class="py-2 text-gray-400">:</td>
                <td class="py-2 text-gray-800 font-medium">{{ $admin->alamat_kos ?? '-' }}</td>
            </tr>
            <tr>
                <td class="py-2 text-gray-600">Tanggal Pengajuan</td>
                <td class="py-2 text-gray-400">:</td>
                <td class="py-2 text-gray-800 font-medium">{{ $admin->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="py-2 text-gray-600">Status</td>
                <td class="py-2 text-gray-400">:</td>
                <td class="py-2 font-medium">
                    @if($admin->status == 'pending')
                        <span class="text-yellow-600">Pending</span>
                    @elseif($admin->status == 'approved')
                        <span class="text-green-600">Disetujui</span>
                    @else
                        <span class="text-red-600">Ditolak</span>
                    @endif
                </td>
            </tr>
        </table>

        {{-- Tombol Aksi --}}
        @if($admin->status == 'pending')
        <div class="flex justify-end gap-3 mt-8">

            <form method="POST" action="{{ route('superadmin.reject', $admin->id) }}">
                @csrf
                {{-- Tombol Tolak: bg-red-500 agar merah solid --}}
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-2 rounded-lg text-sm transition">
                    Tolak Ajuan
                </button>
            </form>

            <form method="POST" action="{{ route('superadmin.approve', $admin->id) }}">
                @csrf
                <button type="submit" class="bg-[#6C8B6B] hover:bg-[#5a7a59] text-white font-semibold px-5 py-2 rounded-lg text-sm transition">
                    Setujui
                </button>
            </form>

        </div>
        @endif
    </div>

    {{-- MODAL TOLAK --}}
    @if(session('tolak'))
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-gray-400 bg-opacity-40"></div>
        <div class="relative bg-[#FDFAF4] rounded-2xl shadow-xl px-10 py-10 w-80 flex flex-col items-center text-center">
            <div class="bg-red-100 rounded-full p-5 mb-4 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span class="absolute top-1 left-1 text-red-300 text-lg">+</span>
                <span class="absolute bottom-1 right-0 text-red-300 text-lg">✦</span>
            </div>
            <h2 class="text-lg font-bold text-red-500 mb-2">Ditolak</h2>
            <p class="text-sm text-gray-600 mb-6">Pengajuan Berhasil Ditolak!</p>
            <a href="{{ route('superadmin.pengajuan') }}"
                class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-8 py-2 rounded-lg transition duration-200">
                Oke
            </a>
        </div>
    </div>
    @endif

    {{-- MODAL SETUJUI --}}
    @if(session('setujui'))
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="absolute inset-0 bg-gray-400 bg-opacity-40"></div>
        <div class="relative bg-[#FDFAF4] rounded-2xl shadow-xl px-10 py-10 w-80 flex flex-col items-center text-center">
            <div class="bg-[#D6E5D6] rounded-full p-5 mb-4 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#6C8B6B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span class="absolute top-1 left-1 text-[#6C8B6B] text-lg">+</span>
                <span class="absolute bottom-1 right-0 text-[#6C8B6B] text-lg">✦</span>
            </div>
            <h2 class="text-lg font-bold text-[#6C8B6B] mb-2">Disetujui</h2>
            <p class="text-sm text-gray-600 mb-6">Pengajuan Berhasil Disetujui!</p>
            <a href="{{ route('superadmin.pengajuan') }}"
                class="bg-[#6C8B6B] hover:bg-[#5a7a59] text-white text-sm font-semibold px-8 py-2 rounded-lg transition duration-200">
                Oke
            </a>
        </div>
    </div>
    @endif

</x-superadmin-layout>
<x-admin-layout>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">Dashboard</h1>
        <div class="flex items-center gap-2 text-gray-600 font-medium">
            <span>Halo, {{ auth()->user()->name }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-[#0F0937] mb-6">Dashboard Admin</h2>

    {{-- Card Statistik --}}
    <div class="grid grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500 mb-2">Kamar Total</p>
            <p class="text-4xl font-bold text-[#0F0937]">{{ $totalKamar }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500 mb-2">Kamar Kosong</p>
            <p class="text-4xl font-bold text-[#0F0937]">{{ $kamarKosong }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500 mb-2">Kamar Terisi</p>
            <p class="text-4xl font-bold text-[#0F0937]">{{ $kamarTerisi }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500 mb-2">Penghuni</p>
            <p class="text-4xl font-bold text-[#0F0937]">{{ $totalPenghuni }}</p>
        </div>
    </div>

    {{-- Baris Bawah --}}
    <div class="grid grid-cols-2 gap-6">

        {{-- Riwayat Terakhir --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-[#0F0937] mb-4">Riwayat Terakhir</h3>
            @forelse($riwayatTerakhir as $penghuni)
            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                <div>
                    <p class="font-semibold text-sm text-[#0F0937]">{{ $penghuni->nama }}</p>
                    <p class="text-xs text-gray-400">{{ $penghuni->created_at->format('F Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-[#0F0937]">Rp {{ number_format($penghuni->kamar->harga ?? 0, 0, ',', '.') }}</p>
                    <span style="display:inline-block;background:#fef9c3;color:#ca8a04;font-size:11px;font-weight:600;padding:2px 10px;border-radius:6px;">
                        Aktif
                    </span>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">Belum ada penghuni</p>
            @endforelse
            @if($riwayatTerakhir->count() > 0)
            <div class="text-center mt-4">
                <a href="{{ route('admin.penghuni.index') }}" class="text-sm text-[#6C8B6B] hover:underline">Lihat Semua</a>
            </div>
            @endif
        </div>

        {{-- Aduan Terbaru --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-[#0F0937] mb-4">Aduan Terbaru</h3>
            <p class="text-sm text-gray-400 text-center py-4">Belum ada aduan</p>
            <div class="text-center mt-4">
                <a href="{{ route('admin.aduan.index') }}" class="text-sm text-[#6C8B6B] hover:underline">Lihat Semua</a>
            </div>
        </div>

    </div>

</x-admin-layout>
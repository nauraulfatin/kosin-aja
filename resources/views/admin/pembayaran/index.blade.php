<x-admin-layout>

{{-- Header --}}
<div class="mb-6">

    <h1 class="text-2xl font-bold text-[#0F0937]">
        Pembayaran
    </h1>

    <p class="text-gray-500 mt-1">
        Kelola tagihan dan pembayaran penghuni
    </p>

</div>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    {{-- Sudah Lunas --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

        <p class="text-gray-500 text-sm">
            Sudah Lunas
        </p>

        <h2 class="text-3xl font-bold text-green-600 mt-3">

            {{ $sudahLunas }}

        </h2>

    </div>

    {{-- Menunggu --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

        <p class="text-gray-500 text-sm">
            Menunggu Verifikasi
        </p>

        <h2 class="text-3xl font-bold text-yellow-500 mt-3">

            {{ $menungguVerifikasi }}

        </h2>

    </div>

    {{-- Belum Bayar --}}
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

        <p class="text-gray-500 text-sm">
            Belum Bayar
        </p>

        <h2 class="text-3xl font-bold text-red-500 mt-3">

            {{ $belumBayar }}

        </h2>

    </div>

</div>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-[#F8F5F0]">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        No
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Penghuni
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Kamar
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Belum Bayar
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Menunggu Verifikasi
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($penghunis as $item)

                    <tr class="border-b border-gray-100">

                        {{-- NO --}}
                        <td class="px-6 py-4">

                            {{ $loop->iteration }}

                        </td>

                        {{-- PENGHUNI --}}
                        <td class="px-6 py-4 font-semibold text-[#0F0937]">

                            {{ $item->nama }}

                        </td>

                        {{-- KAMAR --}}
                        <td class="px-6 py-4">

                            Kamar
                            {{ $item->kamar->nomor_kamar }}

                        </td>

                        {{-- BELUM BAYAR --}}
                        <td class="px-6 py-4">

                            <span class="bg-red-100 text-red-700
                                         px-3 py-1 rounded-full text-xs font-medium">

                                {{ $item->tagihans
                                    ->where('status', 'belum_bayar')
                                    ->count() }}

                                Tagihan

                            </span>

                        </td>

                        {{-- MENUNGGU --}}
                        <td class="px-6 py-4">

                            <span class="bg-yellow-100 text-yellow-700
                                         px-3 py-1 rounded-full text-xs font-medium">

                                {{ $item->tagihans
                                    ->where('status', 'menunggu_verifikasi')
                                    ->count() }}

                                Tagihan

                            </span>

                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4">

                            <a href="{{ route('admin.pembayaran.show', $item->id) }}"
                               class="bg-[#6C8B6B]
                                      hover:bg-[#587357]
                                      text-white px-4 py-2 rounded-lg text-sm transition">

                                Detail

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-10 text-gray-400">

                            Belum ada data pembayaran

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-admin-layout>
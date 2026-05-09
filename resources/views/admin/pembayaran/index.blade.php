<x-admin-layout>
{{-- Header --}}
<div class="mb-6">

    <h1 class="text-2xl font-bold text-[#0F0937]">
        Pembayaran
    </h1>

    <p class="text-gray-500 mt-1">
        Kelola pembayaran dan verifikasi penghuni
    </p>

</div>

{{-- Statistik --}}
<div class="grid grid-cols-3 gap-6 mb-6">

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
                        Bulan
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Tagihan
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Tanggal Bayar
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pembayarans as $item)

                    <tr class="border-b border-gray-100">

                        {{-- No --}}
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Penghuni --}}
                        <td class="px-6 py-4 font-semibold text-[#0F0937]">

                            {{ $item->penghuni->nama }}

                        </td>

                        {{-- Kamar --}}
                        <td class="px-6 py-4">

                            Kamar
                            {{ $item->penghuni->kamar->nomor_kamar }}

                        </td>

                        {{-- Bulan --}}
                        <td class="px-6 py-4">

                            {{ $item->bulan }}
                            {{ $item->tahun }}

                        </td>

                        {{-- Tagihan --}}
                        <td class="px-6 py-4 font-semibold">

                            Rp {{ number_format($item->jumlah_tagihan, 0, ',', '.') }}

                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4">

                            @if($item->status == 'lunas')

                                <span class="bg-green-100 text-green-700
                                             px-3 py-1 rounded-full text-xs font-medium">

                                    Lunas

                                </span>

                            @elseif($item->status == 'menunggu_verifikasi')

                                <span class="bg-yellow-100 text-yellow-700
                                             px-3 py-1 rounded-full text-xs font-medium">

                                    Menunggu

                                </span>

                            @elseif($item->status == 'ditolak')

                                <span class="bg-gray-200 text-gray-700
                                             px-3 py-1 rounded-full text-xs font-medium">

                                    Ditolak

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700
                                             px-3 py-1 rounded-full text-xs font-medium">

                                    Belum Bayar

                                </span>

                            @endif

                        </td>

                        {{-- Tanggal Bayar --}}
                        <td class="px-6 py-4 text-gray-600">

                            @if($item->tanggal_bayar)

                                {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') }}

                            @else

                                -

                            @endif

                        </td>

                        {{-- Aksi --}}
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

                        <td colspan="8"
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
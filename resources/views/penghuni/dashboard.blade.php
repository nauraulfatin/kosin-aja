@extends('layouts.penghuni')

@section('content')

{{-- HEADER --}}
<div class="mb-8">

    <h1 class="text-3xl font-bold text-[#1F2937]">
        Halo, {{ $penghuni->nama }} 👋
    </h1>

    <p class="text-gray-500 mt-2">
        Selamat datang kembali di dashboard penghuni
    </p>

</div>

{{-- CARD --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    {{-- KAMAR --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <div class="flex justify-between items-start">

            <div>

                <p class="text-gray-500 text-sm">
                    Informasi Kamar
                </p>

                <h2 class="text-2xl font-bold text-[#284535] mt-2">
                    {{ $penghuni->kamar->nomor_kamar }}
                </h2>

            </div>

            <div class="bg-[#EEF5F0] p-3 rounded-2xl">

                <i data-lucide="bed-single"
                   class="w-6 h-6 text-[#284535]"></i>

            </div>

        </div>

        <div class="mt-5 space-y-2 text-sm">

            <p class="text-gray-600">
                Nama Kos:
                <span class="font-semibold text-[#1F2937]">
                    {{ optional($penghuni->kamar->informasiKos)->nama_kos ?? '-' }}
                </span>
            </p>

            <p class="text-gray-600">
                Tanggal Masuk:
                <span class="font-semibold text-[#1F2937]">
                    {{ \Carbon\Carbon::parse($penghuni->tanggal_masuk)->translatedFormat('d F Y') }}
                </span>
            </p>

            <p class="text-gray-600">
                Harga:
                <span class="font-semibold text-[#1F2937]">
                    Rp {{ number_format($penghuni->kamar->harga,0,',','.') }}
                </span>
            </p>

        </div>

    </div>

    {{-- TAGIHAN --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <div class="flex justify-between items-start">

            <div>

                <p class="text-gray-500 text-sm">
                    Tagihan Aktif
                </p>

                <h2 class="text-2xl font-bold text-red-500 mt-2">
                    {{ $jumlahTagihan }}
                </h2>

            </div>

            <div class="bg-red-50 p-3 rounded-2xl">

                <i data-lucide="wallet"
                   class="w-6 h-6 text-red-500"></i>

            </div>

        </div>

        <p class="mt-5 text-sm text-gray-600">
            Masih ada tagihan yang perlu dibayar
        </p>

    </div>

    {{-- TUNGGAKAN --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <div class="flex justify-between items-start">

            <div>

                <p class="text-gray-500 text-sm">
                    Total Tunggakan
                </p>

                <h2 class="text-2xl font-bold text-[#284535] mt-2">
                    Rp {{ number_format($totalTunggakan,0,',','.') }}
                </h2>

            </div>

            <div class="bg-[#EEF5F0] p-3 rounded-2xl">

                <i data-lucide="badge-alert"
                   class="w-6 h-6 text-[#284535]"></i>

            </div>

        </div>

        <p class="mt-5 text-sm text-gray-600">
            Total tagihan belum lunas
        </p>

    </div>

    {{-- STATUS --}}
    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <div class="flex justify-between items-start">

            <div>

                <p class="text-gray-500 text-sm">
                    Status Kamar
                </p>

                <h2 class="text-2xl font-bold text-green-600 mt-2">
                    Aktif
                </h2>

            </div>

            <div class="bg-green-50 p-3 rounded-2xl">

                <i data-lucide="badge-check"
                   class="w-6 h-6 text-green-600"></i>

            </div>

        </div>

        <p class="mt-5 text-sm text-gray-600">
            Anda masih menjadi penghuni aktif
        </p>

    </div>

</div>

{{-- TAGIHAN AKTIF --}}
<div class="bg-white rounded-3xl shadow-sm p-6 mt-8">

    <div class="mb-6">

        <h2 class="text-xl font-bold text-[#1F2937]">
            Tagihan Aktif
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Tagihan yang belum dibayar
        </p>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-4 text-gray-500 font-medium">
                        Bulan
                    </th>

                    <th class="text-left py-4 text-gray-500 font-medium">
                        Nominal
                    </th>

                    <th class="text-left py-4 text-gray-500 font-medium">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($tagihanAktif as $item)

                    <tr class="border-b">

                        <td class="py-5">

                            {{ $item->bulan }}
                            {{ $item->tahun }}

                        </td>

                        <td>

                            Rp {{ number_format($item->nominal,0,',','.') }}

                        </td>

                        <td>

                            @if($item->status == 'menunggu_verifikasi')

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">

                                    Menunggu Verifikasi

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">

                                    Belum Bayar

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3"
                            class="text-center py-10 text-gray-400">

                            Tidak ada tagihan aktif

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- RIWAYAT PEMBAYARAN --}}
<div class="bg-white rounded-3xl shadow-sm p-6 mt-8">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-xl font-bold text-[#1F2937]">
                Pembayaran Terbaru
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Riwayat pembayaran terbaru anda
            </p>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-4 text-gray-500 font-medium">
                        Bulan Dibayar
                    </th>

                    <th class="text-left py-4 text-gray-500 font-medium">
                        Total
                    </th>

                    <th class="text-left py-4 text-gray-500 font-medium">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pembayaranTerbaru as $item)

                <tr class="border-b">

                    {{-- BULAN --}}
                    <td class="py-5">

                        <div class="flex flex-wrap gap-2">

                            @foreach($item->details as $detail)

                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">

                                    {{ $detail->tagihan->bulan }}
                                    {{ $detail->tagihan->tahun }}

                                </span>

                            @endforeach

                        </div>

                    </td>

                    {{-- TOTAL --}}
                    <td>

                        Rp {{ number_format($item->total_bayar,0,',','.') }}

                    </td>

                    {{-- STATUS --}}
                    <td>

                        @if($item->status == 'lunas')

                            <span class="bg-green-100 text-green-700 text-sm px-4 py-2 rounded-full">
                                Lunas
                            </span>

                        @elseif($item->status == 'menunggu_verifikasi')

                            <span class="bg-yellow-100 text-yellow-700 text-sm px-4 py-2 rounded-full">
                                Menunggu Verifikasi
                            </span>

                        @elseif($item->status == 'ditolak')

                            <span class="bg-red-100 text-red-700 text-sm px-4 py-2 rounded-full">
                                Ditolak
                            </span>

                        @else

                            <span class="bg-blue-100 text-blue-700 text-sm px-4 py-2 rounded-full">
                                Belum Bayar
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3"
                        class="text-center py-10 text-gray-400">

                        Belum ada data pembayaran

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
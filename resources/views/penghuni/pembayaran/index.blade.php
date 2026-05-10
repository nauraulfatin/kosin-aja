@extends('layouts.penghuni')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold text-[#1F2937]">
            Pembayaran
        </h1>

        <p class="text-gray-500 mt-2">
            Kelola pembayaran kos anda
        </p>

    </div>

    <a href="{{ route('penghuni.pembayaran.create') }}"
       class="bg-[#6C8B6B] hover:bg-[#587357]
              text-white px-6 py-3 rounded-2xl">

        + Bayar Sekarang

    </a>

</div>

{{-- TAGIHAN --}}
<div class="bg-white rounded-3xl shadow-sm p-6 mb-8">

    <div class="mb-6">

        <h2 class="text-xl font-bold text-[#1F2937]">
            Tagihan Aktif
        </h2>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-4">
                        Bulan
                    </th>

                    <th class="text-left py-4">
                        Nominal
                    </th>

                    <th class="text-left py-4">
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

{{-- RIWAYAT --}}
<div class="bg-white rounded-3xl shadow-sm p-6">

    <div class="mb-6">

        <h2 class="text-xl font-bold text-[#1F2937]">
            Riwayat Pembayaran
        </h2>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b">

                    <th class="text-left py-4">
                        Bulan Dibayar
                    </th>

                    <th class="text-left py-4">
                        Total
                    </th>

                    <th class="text-left py-4">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pembayarans as $item)

                    <tr class="border-b">

                        <td class="py-5">

                            <div class="flex flex-wrap gap-2">

                                @foreach($item->details as $detail)

                                    <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">

                                        {{ $detail->tagihan->bulan }}

                                    </span>

                                @endforeach

                            </div>

                        </td>

                        <td>

                            Rp {{ number_format($item->total_bayar,0,',','.') }}

                        </td>

                        <td>

                            @if($item->status == 'lunas')

                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">

                                    Lunas

                                </span>

                            @elseif($item->status == 'menunggu_verifikasi')

                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">

                                    Menunggu

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">

                                    Ditolak

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="3"
                            class="text-center py-10 text-gray-400">

                            Belum ada riwayat pembayaran

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
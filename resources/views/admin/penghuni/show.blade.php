<x-admin-layout>

```
{{-- Header --}}
<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-2xl font-bold text-[#0F0937]">
            Detail Penghuni
        </h1>

        <p class="text-gray-500 mt-1">
            Informasi lengkap penghuni dan histori pembayaran
        </p>

    </div>

    <a href="{{ route('admin.penghuni.index') }}"
       class="bg-gray-100 hover:bg-gray-200
              text-gray-700 px-5 py-3 rounded-xl transition">

        Kembali

    </a>

</div>

{{-- DETAIL PENGHUNI --}}
<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-6">

    <div class="flex items-center justify-between mb-8">

        <h2 class="text-xl font-bold text-[#0F0937]">
            Informasi Penghuni
        </h2>

        @if($penghuni->status == 'aktif')

            <span class="bg-green-100 text-green-700
                         px-4 py-2 rounded-full text-sm font-medium">

                Aktif

            </span>

        @else

            <span class="bg-red-100 text-red-700
                         px-4 py-2 rounded-full text-sm font-medium">

                Nonaktif

            </span>

        @endif

    </div>

    <div class="grid grid-cols-2 gap-y-5 gap-x-10">

        <div class="flex">
            <span class="w-40 text-gray-500">Nama</span>
            <span class="font-semibold text-[#0F0937]">
                : {{ $penghuni->nama }}
            </span>
        </div>

        <div class="flex">
            <span class="w-40 text-gray-500">Email</span>
            <span class="font-semibold text-[#0F0937]">
                : {{ $penghuni->email }}
            </span>
        </div>

        <div class="flex">
            <span class="w-40 text-gray-500">Nomor Kamar</span>
            <span class="font-semibold text-[#0F0937]">
                : Kamar {{ $penghuni->kamar->nomor_kamar }}
            </span>
        </div>

        <div class="flex">
            <span class="w-40 text-gray-500">Nomor Telepon</span>
            <span class="font-semibold text-[#0F0937]">
                : {{ $penghuni->no_hp }}
            </span>
        </div>

        <div class="flex">
            <span class="w-40 text-gray-500">NIK</span>
            <span class="font-semibold text-[#0F0937]">
                : {{ $penghuni->nik }}
            </span>
        </div>

        <div class="flex">
            <span class="w-40 text-gray-500">Tanggal Masuk</span>
            <span class="font-semibold text-[#0F0937]">
                : {{ \Carbon\Carbon::parse($penghuni->tanggal_masuk)->format('d M Y') }}
            </span>
        </div>

        <div class="flex col-span-2">
            <span class="w-40 text-gray-500">Alamat</span>
            <span class="font-semibold text-[#0F0937]">
                : {{ $penghuni->alamat }}
            </span>
        </div>

    </div>

</div>

{{-- HISTORI PEMBAYARAN --}}
<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">

    <div class="mb-6">

        <h2 class="text-xl font-bold text-[#0F0937]">
            Histori Pembayaran
        </h2>

        <p class="text-gray-500 mt-1">
            Riwayat tagihan dan pembayaran penghuni
        </p>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-[#F8F5F0]">

                <tr>

                    <th class="text-left px-4 py-4 text-sm font-semibold text-gray-600">
                        Bulan
                    </th>

                    <th class="text-left px-4 py-4 text-sm font-semibold text-gray-600">
                        Tagihan
                    </th>

                    <th class="text-left px-4 py-4 text-sm font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="text-left px-4 py-4 text-sm font-semibold text-gray-600">
                        Tanggal Bayar
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($penghuni->pembayarans as $bayar)

                    <tr class="border-b border-gray-100">

                        {{-- Bulan --}}
                        <td class="px-4 py-4 text-gray-700">

                            {{ $bayar->bulan }}
                            {{ $bayar->tahun }}

                        </td>

                        {{-- Tagihan --}}
                        <td class="px-4 py-4 font-semibold text-[#0F0937]">

                            Rp {{ number_format($bayar->jumlah_tagihan, 0, ',', '.') }}

                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-4">

                            @if($bayar->status == 'lunas')

                                <span class="bg-green-100 text-green-700
                                             px-3 py-1 rounded-full text-xs font-medium">

                                    Lunas

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700
                                             px-3 py-1 rounded-full text-xs font-medium">

                                    Belum Lunas

                                </span>

                            @endif

                        </td>

                        {{-- Tanggal Bayar --}}
                        <td class="px-4 py-4 text-gray-600">

                            @if($bayar->tanggal_bayar)

                                {{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y') }}

                            @else

                                Belum Dibayar

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center py-10 text-gray-400">

                            Belum ada histori pembayaran

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
</x-admin-layout>
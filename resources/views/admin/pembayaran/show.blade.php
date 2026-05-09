<x-admin-layout>
{{-- Header --}}
<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-2xl font-bold text-[#0F0937]">
            Detail Pembayaran
        </h1>

        <p class="text-gray-500 mt-1">
            Detail pembayaran penghuni
        </p>

    </div>

    <a href="{{ route('admin.pembayaran.index') }}"
       class="bg-gray-100 hover:bg-gray-200
              text-gray-700 px-5 py-3 rounded-xl transition">

        Kembali

    </a>

</div>

{{-- Card --}}
<div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">

    <div class="grid grid-cols-2 gap-6">

        <div>

            <p class="text-gray-500 text-sm">
                Nama Penghuni
            </p>

            <h2 class="font-semibold text-lg text-[#0F0937] mt-1">

                {{ $pembayaran->penghuni->nama }}

            </h2>

        </div>

        <div>

            <p class="text-gray-500 text-sm">
                Nomor Kamar
            </p>

            <h2 class="font-semibold text-lg text-[#0F0937] mt-1">

                Kamar {{ $pembayaran->penghuni->kamar->nomor_kamar }}

            </h2>

        </div>

        <div>

            <p class="text-gray-500 text-sm">
                Bulan Tagihan
            </p>

            <h2 class="font-semibold text-lg text-[#0F0937] mt-1">

                {{ $pembayaran->bulan }}
                {{ $pembayaran->tahun }}

            </h2>

        </div>

        <div>

            <p class="text-gray-500 text-sm">
                Jumlah Tagihan
            </p>

            <h2 class="font-semibold text-lg text-[#0F0937] mt-1">

                Rp {{ number_format($pembayaran->jumlah_tagihan, 0, ',', '.') }}

            </h2>

        </div>

    </div>

    {{-- Bukti --}}
    <div class="mt-8">

        <p class="text-gray-500 text-sm mb-3">
            Bukti Pembayaran
        </p>

        @if($pembayaran->bukti_pembayaran)

            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                 class="w-80 rounded-xl border border-gray-200">

        @else

            <div class="bg-gray-100 rounded-xl p-8 text-gray-400">

                Belum upload bukti pembayaran

            </div>

        @endif

    </div>

    {{-- Button --}}
    @if($pembayaran->status == 'menunggu_verifikasi')

        <div class="flex items-center gap-4 mt-8">

            {{-- Verifikasi --}}
            <form method="POST"
                  action="{{ route('admin.pembayaran.verifikasi', $pembayaran->id) }}">

                @csrf

                <button type="submit"
                        class="bg-[#6C8B6B]
                               hover:bg-[#587357]
                               text-white px-6 py-3 rounded-xl transition">

                    Verifikasi Pembayaran

                </button>

            </form>

            {{-- Tolak --}}
            <form method="POST"
                  action="{{ route('admin.pembayaran.tolak', $pembayaran->id) }}">

                @csrf

                <button type="submit"
                        class="bg-red-500 hover:bg-red-600
                               text-white px-6 py-3 rounded-xl transition">

                    Tolak Pembayaran

                </button>

            </form>

        </div>

    @endif

</div>
</x-admin-layout>

<x-admin-layout>

{{-- Header --}}
<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-2xl font-bold text-[#0F0937]">
            Detail Pembayaran
        </h1>

        <p class="text-gray-500 mt-1">
            Riwayat pembayaran penghuni
        </p>

    </div>

    <a href="{{ route('admin.pembayaran.index') }}"
       class="bg-gray-100 hover:bg-gray-200
              text-gray-700 px-5 py-3 rounded-xl transition">

        Kembali

    </a>

</div>

{{-- INFO PENGHUNI --}}
<div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">

    <div class="grid grid-cols-2 gap-6">

        {{-- NAMA --}}
        <div>

            <p class="text-gray-500 text-sm">
                Nama Penghuni
            </p>

            <h2 class="font-semibold text-lg text-[#0F0937] mt-1">

                {{ $penghuni->nama }}

            </h2>

        </div>

        {{-- KAMAR --}}
        <div>

            <p class="text-gray-500 text-sm">
                Nomor Kamar
            </p>

            <h2 class="font-semibold text-lg text-[#0F0937] mt-1">

                Kamar {{ $penghuni->kamar->nomor_kamar }}

            </h2>

        </div>

    </div>

</div>

{{-- LIST PEMBAYARAN --}}
<div class="space-y-6">

    @forelse($penghuni->pembayarans as $pembayaran)

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">

            {{-- HEADER --}}
            <div class="flex items-start justify-between mb-6">

                <div>

                    <h2 class="text-lg font-bold text-[#0F0937]">

                        Pembayaran #{{ $pembayaran->id }}

                    </h2>

                    <p class="text-sm text-gray-500 mt-1">

                        {{ $pembayaran->created_at->format('d F Y H:i') }}

                    </p>

                </div>

                {{-- STATUS --}}
                <div>

                    @if($pembayaran->status == 'lunas')

                        <span class="bg-green-100 text-green-700
                                     px-4 py-2 rounded-full text-sm font-medium">

                            Lunas

                        </span>

                    @elseif($pembayaran->status == 'menunggu_verifikasi')

                        <span class="bg-yellow-100 text-yellow-700
                                     px-4 py-2 rounded-full text-sm font-medium">

                            Menunggu Verifikasi

                        </span>

                    @elseif($pembayaran->status == 'ditolak')

                        <span class="bg-red-100 text-red-700
                                     px-4 py-2 rounded-full text-sm font-medium">

                            Ditolak

                        </span>

                    @else

                        <span class="bg-gray-100 text-gray-700
                                     px-4 py-2 rounded-full text-sm font-medium">

                            Belum Bayar

                        </span>

                    @endif

                </div>

            </div>

            {{-- DETAIL --}}
            <div class="grid grid-cols-2 gap-6 mb-6">

                {{-- BULAN --}}
                <div>

                    <p class="text-gray-500 text-sm mb-3">
                        Bulan Dibayar
                    </p>

                    <div class="flex flex-wrap gap-2">

                        @foreach($pembayaran->details as $detail)

                            <span class="bg-[#F8F5F0]
                                         text-[#0F0937]
                                         px-3 py-2 rounded-xl text-sm">

                                {{ $detail->tagihan->bulan }}
                                {{ $detail->tagihan->tahun }}

                            </span>

                        @endforeach

                    </div>

                </div>

                {{-- TOTAL --}}
                <div>

                    <p class="text-gray-500 text-sm">
                        Total Pembayaran
                    </p>

                    <h2 class="font-bold text-2xl text-[#0F0937] mt-2">

                        Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}

                    </h2>

                </div>

            </div>

            {{-- BUKTI --}}
            <div class="mb-6">

                <p class="text-gray-500 text-sm mb-3">
                    Bukti Pembayaran
                </p>

                @if($pembayaran->bukti_pembayaran)

                    <button
                        type="button"
                        onclick="openModal('{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}')"
                        class="text-blue-600 hover:underline">

                        Lihat Bukti Pembayaran

                    </button>

                @else

                    <span class="text-gray-400">

                        Belum upload bukti

                    </span>

                @endif

            </div>

            {{-- AKSI --}}
            @if($pembayaran->status == 'menunggu_verifikasi')

                <div class="flex items-center gap-3">

                    {{-- VERIFIKASI --}}
                    <form method="POST"
                          action="{{ route('admin.pembayaran.verifikasi', $pembayaran->id) }}">

                        @csrf

                        <button type="submit"
                                class="bg-[#6C8B6B]
                                       hover:bg-[#587357]
                                       text-white px-5 py-3 rounded-xl transition">

                            Verifikasi Pembayaran

                        </button>

                    </form>

                    {{-- TOLAK --}}
                    <form method="POST"
                          action="{{ route('admin.pembayaran.tolak', $pembayaran->id) }}">

                        @csrf

                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600
                                       text-white px-5 py-3 rounded-xl transition">

                            Tolak Pembayaran

                        </button>

                    </form>

                </div>

            @endif

        </div>

    @empty

        <div class="bg-white rounded-2xl p-10
                    shadow-sm border border-gray-100
                    text-center text-gray-400">

            Belum ada pembayaran

        </div>

    @endforelse

</div>

{{-- MODAL PREVIEW --}}
<div id="imageModal"
     class="fixed inset-0 bg-black/70 hidden
            items-center justify-center z-50">

    <div class="relative">

        {{-- CLOSE --}}
        <button onclick="closeModal()"
                class="absolute -top-4 -right-4
                       bg-white rounded-full
                       w-10 h-10 shadow-lg">

            ✕

        </button>

        {{-- IMAGE --}}
        <img id="modalImage"
             src=""
             class="max-w-[90vw] max-h-[90vh]
                    rounded-2xl shadow-2xl">

    </div>

</div>

<script>

    function openModal(src)
    {
        document.getElementById('modalImage').src = src;

        document.getElementById('imageModal')
                .classList
                .remove('hidden');

        document.getElementById('imageModal')
                .classList
                .add('flex');
    }

    function closeModal()
    {
        document.getElementById('imageModal')
                .classList
                .add('hidden');

        document.getElementById('imageModal')
                .classList
                .remove('flex');
    }

</script>

</x-admin-layout>
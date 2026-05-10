@extends('layouts.penghuni')

@section('content')

<div class="max-w-4xl">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-[#1F2937]">
            Pembayaran Kos
        </h1>

        <p class="text-gray-500 mt-2">
            Pilih tagihan yang ingin dibayar
        </p>

    </div>

    {{-- FORM --}}
    <div class="bg-white rounded-3xl shadow-sm p-8">

        <form method="POST"
              action="{{ route('penghuni.pembayaran.store') }}"
              enctype="multipart/form-data">

            @csrf

            <div class="space-y-8">

                {{-- TAGIHAN --}}
                <div>

                    <label class="font-semibold text-[#1F2937]">
                        Pilih Tagihan
                    </label>

                    <div class="grid md:grid-cols-2 gap-4 mt-4">

                        @forelse($tagihans as $item)

                            <label class="border rounded-2xl p-5 flex items-start gap-4 hover:border-[#6C8B6B] transition cursor-pointer">

                                <input type="checkbox"
                                       name="tagihan_id[]"
                                       value="{{ $item->id }}"
                                       data-nominal="{{ $item->nominal }}"
                                       class="tagihan-checkbox mt-1">

                                <div>

                                    <h3 class="font-semibold text-[#1F2937]">

                                        {{ $item->bulan }}
                                        {{ $item->tahun }}

                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">

                                        Rp {{ number_format($item->nominal,0,',','.') }}

                                    </p>

                                </div>

                            </label>

                        @empty

                            <div class="col-span-2 bg-gray-50 rounded-2xl p-6 text-center text-gray-400">

                                Tidak ada tagihan aktif

                            </div>

                        @endforelse

                    </div>

                </div>

                {{-- TOTAL --}}
                <div>

                    <label class="font-semibold text-[#1F2937]">
                        Total Pembayaran
                    </label>

                    <input type="text"
                           id="total"
                           readonly
                           value="Rp 0"
                           class="w-full border rounded-2xl p-4 mt-3 bg-gray-100 font-semibold text-lg">

                </div>

                {{-- TANGGAL --}}
                <div>

                    <label class="font-semibold text-[#1F2937]">
                        Tanggal Pembayaran
                    </label>

                    <input type="date"
                           name="tanggal_bayar"
                           required
                           class="w-full border rounded-2xl p-4 mt-3">

                </div>

                {{-- METODE --}}
                <div>

                    <label class="font-semibold text-[#1F2937]">
                        Metode Pembayaran
                    </label>

                    <select name="metode_pembayaran"
                            class="w-full border rounded-2xl p-4 mt-3">

                        <option value="Transfer Bank">
                            Transfer Bank
                        </option>

                        <option value="E-Wallet">
                            E-Wallet
                        </option>

                        <option value="Cash">
                            Cash
                        </option>

                    </select>

                </div>

                {{-- BUKTI --}}
                <div>

                    <label class="font-semibold text-[#1F2937]">
                        Upload Bukti Pembayaran
                    </label>

                    <input type="file"
                           name="bukti_pembayaran"
                           required
                           class="w-full border rounded-2xl p-4 mt-3">

                </div>

                {{-- BUTTON --}}
                <button type="submit"
                        class="bg-[#6C8B6B]
                               hover:bg-[#587357]
                               text-white px-8 py-4 rounded-2xl transition">

                    Kirim Pembayaran

                </button>

            </div>

        </form>

    </div>

</div>

{{-- SCRIPT --}}
<script>

    const checkboxes =
        document.querySelectorAll('.tagihan-checkbox');

    const totalInput =
        document.getElementById('total');

    function hitungTotal()
    {
        let total = 0;

        checkboxes.forEach(item => {

            if(item.checked)
            {
                total += parseInt(
                    item.dataset.nominal
                );
            }

        });

        totalInput.value =
            'Rp ' + total.toLocaleString('id-ID');
    }

    checkboxes.forEach(item => {

        item.addEventListener(
            'change',
            hitungTotal
        );

    });

</script>

@endsection
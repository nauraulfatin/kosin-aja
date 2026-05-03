<x-admin-layout>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-700">Informasi Kos</h1>
        <span class="text-gray-600 font-medium">Halo, {{ auth()->user()->name }}</span>
    </div>

    @if(session('success'))
    <div style="background:#dcfce7;color:#16a34a;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:0.9rem;">
        {{ session('success') }}
    </div>
    @endif

    @if(!$kos)
        {{-- Belum ada data --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <h3 class="text-lg font-bold text-gray-600 mb-2">Belum ada informasi kos</h3>
            <p class="text-sm text-gray-400 mb-6">Tambahkan informasi kos Anda agar tampil di katalog</p>
            <a href="{{ route('admin.informasi.create') }}"
                style="display:inline-block;background:#6C8B6B;color:white;padding:10px 28px;border-radius:8px;font-weight:600;text-decoration:none;">
                + Tambah Informasi Kos
            </a>
        </div>
    @else
        {{-- Sudah ada data --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

            {{-- Foto Utama --}}
            @if($kos->foto_utama)
            <div class="mb-6">
                <img src="{{ Storage::url($kos->foto_utama) }}" alt="Foto Kos"
                     class="w-full max-h-64 object-cover rounded-xl">
            </div>
            @endif

            {{-- Info --}}
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-[#0F0937]">{{ $kos->nama_kos }}</h2>
                    <p class="text-gray-500 text-sm mt-1">{{ $kos->alamat }}{{ $kos->kota ? ', '.$kos->kota : '' }}</p>
                </div>
                <a href="{{ route('admin.informasi.edit') }}"
                    style="display:inline-block;background:#6C8B6B;color:white;padding:8px 20px;border-radius:8px;font-weight:600;text-decoration:none;font-size:0.85rem;">
                    Edit Informasi
                </a>
            </div>

            <table class="w-full text-sm mb-6">
                <tr>
                    <td class="py-2 text-gray-500 w-36">Tipe Kos</td>
                    <td class="py-2 text-gray-400 w-4">:</td>
                    <td class="py-2 text-gray-800 font-medium capitalize">{{ $kos->tipe_kos }}</td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-500">No. Telepon</td>
                    <td class="py-2 text-gray-400">:</td>
                    <td class="py-2 text-gray-800 font-medium">{{ $kos->no_telepon ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-500">Harga Mulai</td>
                    <td class="py-2 text-gray-400">:</td>
                    <td class="py-2 text-gray-800 font-medium">
                        {{ $kos->harga_mulai ? 'Rp '.number_format($kos->harga_mulai, 0, ',', '.') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-500">Deskripsi</td>
                    <td class="py-2 text-gray-400">:</td>
                    <td class="py-2 text-gray-800">{{ $kos->deskripsi ?? '-' }}</td>
                </tr>
            </table>

            {{-- Fasilitas --}}
            @if($kos->fasilitas && count($kos->fasilitas) > 0)
            <div class="mb-6">
                <h4 class="font-bold text-[#0F0937] mb-3">Fasilitas</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($kos->fasilitas as $fasilitas)
                    <span style="background:#f0f5f1;color:#4a5e4c;padding:4px 12px;border-radius:6px;font-size:0.8rem;font-weight:500;">
                        {{ $fasilitas }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Foto Galeri --}}
            @if($kos->foto_galeri && count($kos->foto_galeri) > 0)
            <div>
                <h4 class="font-bold text-[#0F0937] mb-3">Foto Galeri</h4>
                <div class="grid grid-cols-4 gap-3">
                    @foreach($kos->foto_galeri as $foto)
                    <div class="relative group">
                        <img src="{{ Storage::url($foto) }}" class="w-full h-24 object-cover rounded-lg">
                        <form method="POST" action="{{ route('admin.informasi.hapusFoto') }}"
                            class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition">
                            @csrf
                            <input type="hidden" name="foto" value="{{ $foto }}">
                            <button type="submit"
                                style="background:rgba(239,68,68,0.9);color:white;border:none;border-radius:50%;width:22px;height:22px;font-size:12px;cursor:pointer;">
                                ✕
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    @endif

</x-admin-layout>
<x-admin-layout>

```
{{-- Header --}}
<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-2xl font-bold text-[#0F0937]">
            Data Penghuni
        </h1>

        <p class="text-gray-500 mt-1">
            Kelola seluruh data penghuni kos
        </p>

    </div>

    <a href="{{ route('admin.penghuni.create') }}"
       class="bg-[#6C8B6B]
              hover:bg-[#587357]
              text-white px-5 py-3 rounded-xl
              transition duration-200">

        + Tambah Penghuni

    </a>

</div>

{{-- Alert --}}
@if(session('success'))

    <div class="mb-6 bg-green-100 border border-green-200
                text-green-700 px-4 py-3 rounded-xl">

        {{ session('success') }}

    </div>

@endif

{{-- Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            {{-- Header --}}
            <thead class="bg-[#F8F5F0]">

                <tr>

                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-600">
                        No
                    </th>

                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-600">
                        Nama
                    </th>

                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-600">
                        Email
                    </th>

                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-600">
                        No HP
                    </th>

                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-600">
                        Kamar
                    </th>

                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="text-center px-6 py-4 text-sm font-semibold text-gray-600">
                        Aksi
                    </th>

                </tr>

            </thead>

            {{-- Body --}}
            <tbody>

                @forelse($penghunis as $penghuni)

                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        {{-- No --}}
                        <td class="px-6 py-5 text-center text-sm text-gray-600">

                            {{ $loop->iteration }}

                        </td>

                        {{-- Nama --}}
                        <td class="px-6 py-5 text-center">

                            <div class="font-semibold text-[#0F0937]">

                                {{ $penghuni->nama }}

                            </div>

                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-5 text-center text-sm text-gray-600">

                            {{ $penghuni->email }}

                        </td>

                        {{-- No HP --}}
                        <td class="px-6 py-5 text-center text-sm text-gray-600">

                            {{ $penghuni->no_hp }}

                        </td>

                        {{-- Kamar --}}
                        <td class="px-6 py-5 text-center text-sm text-gray-600">

                            Kamar {{ $penghuni->kamar->nomor_kamar }}

                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-5 text-center">

                            @if($penghuni->status == 'aktif')

                                <span class="bg-green-100 text-green-700
                                             px-3 py-1 rounded-full text-xs font-medium">

                                    Aktif

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700
                                             px-3 py-1 rounded-full text-xs font-medium">

                                    Nonaktif

                                </span>

                            @endif

                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-5 text-center">

                            <div class="flex items-center justify-center gap-4">

                                {{-- Detail --}}
                                <a href="{{ route('admin.penghuni.show', $penghuni->id) }}"
                                   class="text-[#6C8B6B] hover:text-[#587357] transition">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5
                                                 12 5c4.478 0 8.268 2.943
                                                 9.542 7-1.274 4.057-5.064 7
                                                 -9.542 7-4.477 0-8.268-2.943
                                                 -9.542-7z" />

                                    </svg>

                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('admin.penghuni.edit', $penghuni->id) }}"
                                   class="text-gray-400 hover:text-blue-500 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M11 5h2m-1-1v2m-7.586
                                                 9.586a2 2 0 000 2.828
                                                 l1.172 1.172a2 2 0
                                                 002.828 0L19 10.828
                                                 l-4-4L4.414 17.414z" />

                                    </svg>

                                </a>

                                {{-- Delete --}}
                                <form method="POST"
                                      action="{{ route('admin.penghuni.destroy', $penghuni->id) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus penghuni ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-gray-400 hover:text-red-500 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-5 h-5"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 7l-.867 12.142
                                                     A2 2 0 0116.138 21
                                                     H7.862a2 2 0
                                                     01-1.995-1.858L5 7
                                                     m5 4v6m4-6v6M9 7V4
                                                     a1 1 0 011-1h4
                                                     a1 1 0 011 1v3m-7 0h8" />

                                        </svg>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-10 text-gray-400">

                            Belum ada data penghuni

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
```

</x-admin-layout>
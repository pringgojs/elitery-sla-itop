<div>
    <div class="max-w-5xl mx-auto  p-5 rounded-md bg-orange-50 shadow mb-5">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-orange-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-orange-800">Pentunjuk</h3>
                <div class="mt-2 text-sm text-orange-700">
                    <p>Anda diizinkan untuk merubah data barang yang diminta oleh pegawai. Sesuaikan jumlah dan daftar
                        barang yang disetujui.</p>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ data: @js($dailyTransaction->details) }" class="max-w-5xl mx-auto bg-white p-5 rounded shadow-lg">
        <h1 class="text-xl font-bold text-center mb-5 border-b-2 pb-3">FORM VERIFIKASI PENGELUARAN BARANG / BAHAN GUDANG
            UMUM</h1>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="font-semibold">Diminta Oleh</label>
                <div class="block w-full mt-1">{{ $dailyTransaction->creator->name ?? '' }}</div>
            </div>
            <div>
                <label class="font-semibold">Sie/Subbag/Unit Kerja</label>
                <div class="block w-full mt-1">
                    {{ ucwords(strtolower($dailyTransaction->creator->department->name ?? '')) }} -
                    {{ $dailyTransaction->creator->department->departmentDetail->location ?? '' }}</div>
            </div>
            <div>
                <label class="font-semibold">Tanggal</label>
                <div class="block w-full mt-1">{{ $dailyTransaction->created_at }}</div>
            </div>
        </div>

        <table class="min-w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-2 py-1 text-left font-semibold">No. Kode</th>
                    <th class="border px-2 py-1 text-left font-semibold">Nama Barang/Spesifikasi</th>
                    <th class="border px-2 py-1 text-left font-semibold">Satuan</th>
                    <th class="border px-2 py-1 text-left font-semibold">Jumlah</th>
                    <th class="border px-2 py-1 text-left font-semibold">Stok</th>
                    <th class="border px-2 py-1 text-left font-semibold">Keterangan</th>
                    <th class="border px-2 py-1 text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($dailyTransaction->details as $item)
                    @php
                        $good = $item->good;
                    @endphp --}}
                <template x-for="(item, index) in data">
                    <tr>
                        <td class="border px-2 py-1" x-html="item.good.code"></td>
                        <td class="border px-2 py-1" x-html="item.good.name"></td>
                        <td class="border px-2 py-1" x-html="item.unit_name"></td>
                        <td class="border px-2 py-1"><input type="text" x-model="item.total"
                                class="block w-full mt-1 border-gray-300 rounded shadow-sm" /></td>
                        <td class="border px-2 py-1" x-html="item.good.total_stock"></td>
                        <td class="border px-2 py-1"><input type="text" x-model="item.note"
                                class="block w-full mt-1 border-gray-300 rounded shadow-sm" /></td>
                        <td class="border px-2 py-1"><a @click="data.splice(index, 1);"
                                class="inline-flex rounded-lg p-2 bg-red-50 text-red-700 ring-4 ring-white cursor-pointer">
                                <x-heroicon-o-trash class="h-5 w-5" />
                            </a>
                        </td>
                    </tr>
                </template>
                {{-- @endforeach --}}
            </tbody>
        </table>

        <div class="grid grid-cols-1 gap-4 mt-5">
            <div class="text-center items-center">
                <p class="font-semibold">Dikeluarkan Oleh</p>
                <div class="mt-2">{{ auth()->user()->name }}</div>
            </div>
            {{-- <div class="text-center">
                <p class="font-semibold">Diterima Oleh</p>
                <div class="mt-2">{{ $dailyTransaction->creator->name }}</div>
            </div> --}}
            <div class="item-center text-center">
                <button @click="data=@js($dailyTransaction->details); "
                    class="rounded  items-center bg-gray-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Batalkan perubahan</button>
                <button onclick="document.getElementById('modalConfirm')._x_dataStack[0].show = true"
                    class="rounded  items-center bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Verifikasi
                    Data Pengeluaran</button>
            </div>
        </div>

        <x-modal id="modalConfirm" maxWidth="md" wire:model="modalConfirm">
            {{-- <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"> --}}
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Konfirmasi</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Anda yakin data sudah benar ? Data yang sudah
                                difinalisasi tidak dapat diedit kembali.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button wire:click="verification(data)" type="button" wire:loading.attr="disabled"
                    wire:target='verification'
                    class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Ya,
                    Finalisasi sekarang</button>
                <div class="justify-end flex-initial ml-5 -mt-5" wire:loading wire:target='verification'>
                    @livewire('utils.loading')
                </div>
            </div>
            {{-- </div> --}}
        </x-modal>
    </div>
</div>

<div>
    @livewire('pages.daily-transaction.section.filter')
    @foreach ($transactions as $item)
        <div class="space-y-4 mb-3">
            <!-- Card 1 -->
            <div class="bg-white p-4 rounded-lg shadow grid grid-cols-12 items-center gap-4">
                <!-- Left Section -->
                <div class="col-span-6">
                    <h3 class="text-md font-bold text-gray-900">{{ $item->code }}
                        @if (!$item->approved_by)
                            <span class="bg-yellow-100 text-yellow-600 text-sm px-2 py-1 rounded">menunggu
                                diproses</span>
                        @else
                            <span class="bg-green-100 text-green-600 text-sm px-2 py-1 rounded">selesai</span>
                        @endif
                    </h3>
                    <p class="text-gray-500 text-sm">{{ $item->created_at }} | {{ $item->creator->name }}
                        {{ ucwords(strtolower($item->creator->department->name ?? '')) }}
                    </p>
                    @if ($item->approver)
                        <div class="flex space-x-2 text-sm mt-2">
                            <span data-tooltip-target="tooltip-approver-default-{{ $item->id }}"
                                class="flex items-center bg-gray-100 text-gray-600 text-sm px-2 py-1 rounded">
                                <x-heroicon-o-user class="h-4 w-4 rounded-full mr-2" />
                                {{ $item->approver->name ?? '' }}
                            </span>
                            <div id="tooltip-approver-default-{{ $item->id }}" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ $item->approver->name ?? '' }} - {{ $item->approved_at }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    @endif
                </div>


                <!-- Middle Section -->
                <div class="col-span-3 flex items-center justify-center text-sm">
                    <span class="text-gray-600 mr-2">Item:</span>
                    <div class="flex -space-x-3">
                        @foreach ($item->details->take(3) as $detail)
                            <span data-tooltip-target="tooltip-default-{{ $detail->id }}"
                                class="inline-flex h-8 w-8 cursor-pointer border-white font-bold text-sm text-gray-500 border-2 items-center justify-center rounded-full bg-gray-200">{{ initials($detail->good->name) }}</span>
                            </span>
                            <div id="tooltip-default-{{ $detail->id }}" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ $detail->good->name }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        @endforeach
                        @if ($item->details->count() > 3)
                            <div
                                class="w-8 h-8 rounded-full border-2 border-white bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-600">+{{ $item->details->count() - 3 }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Section -->
                <div class="col-span-3 flex items-center justify-end space-x-1">
                    @if (!$item->approved_by)
                        @can('transaksi.harian.process')
                            <a href="{{ route('daily-transaction.preview', ['id' => $item->id]) }}" wire:navigate
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">Proses
                                Pengajuan</a>
                        @endcan
                    @endif
                    <button type="button" wire:click="printout('{{ $item->id }}')"
                        class="flex shrink-0 justify-center items-center gap-2 size-[38px] text-sm font-medium rounded-lg bg-white p-2 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                        </svg>
                    </button>
                    <a href="{{ route('daily-transaction.print', ['id' => $item->id]) }}" wire:navigate
                        class="flex shrink-0 justify-center items-center gap-2 size-[38px] text-sm font-medium rounded-lg bg-white p-2 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <x-heroicon-s-eye class="shrink-0 size-4" />
                    </a>
                    <div class="relative inline-block text-left">
                        <button type="button"
                            class="relative inline-flex items-center rounded-md bg-white p-2 text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                            id="btn-more-{{ $item->id }}"
                            data-dropdown-toggle="dropdown-more-{{ $item->id }}">
                            <span class="absolute -inset-1"></span>
                            <span class="sr-only">Open options menu</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown-more-{{ $item->id }}"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="btn-more-{{ $item->id }}">
                                <li>
                                    <a wire:click="download('{{ $item->id }}')" wire:navigate
                                        class="cursor-pointer group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem" tabindex="-1" id="menu-item-0">
                                        <x-bytesize-download
                                            class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" />

                                        Download
                                    </a>
                                </li>
                                {{-- secara default, ketika approved by terisi maka tidak boleh diedit atau dihapus --}}
                                @if (!$item->approved_by)
                                    @can('transaksi.harian.edit')
                                        <li>
                                            <a href="{{ route('daily-transaction.edit', ['id' => $item->id]) }}"
                                                wire:navigate
                                                class="cursor-pointer group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem" tabindex="-1" id="menu-item-0">
                                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                    <path
                                                        d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                </svg>
                                                Edit
                                            </a>
                                        </li>
                                    @endcan
                                    @can('transaksi.harian.delete')
                                        <li>
                                            <a data-dropdown-toggle="dropdown-delete-{{ $item->id }}"
                                                class="cursor-pointer group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem" tabindex="-1" id="menu-item-0">
                                                <x-heroicon-o-trash
                                                    class="h-5 w-5 mr-3  text-gray-400 group-hover:text-gray-500" />
                                                Hapus
                                            </a>

                                            <div id="dropdown-delete-{{ $item->id }}"
                                                class="z-10 hidden  mr-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-64 dark:bg-gray-700">
                                                <div
                                                    class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                                    <p class="mb-3 font-normal text-sm text-gray-500 dark:text-gray-400">
                                                        Apakah
                                                        kamu ingin menghapus <b>{{ $item->code }}</b>?</p>
                                                    <a wire:key="item-{{ $item->id }}"
                                                        wire:click="delete('{{ $item->id }}')"
                                                        class="cursor-pointer item-right rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-900 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">
                                                        Ya, hapus!
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endcan
                                @endif
                            </ul>
                        </div>
                    </div>
                    {{-- <button class="text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 12l6 6m0 0l6-6m-6 6V6" />
                        </svg>
                    </button> --}}
                </div>
            </div>
        </div>
    @endforeach
    {{ $transactions->links() }}

    @if ($transactions->count() == 0)
        <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>

                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Tidak ada data yang bisa ditampilkan.
                        <a href="{{ route('daily-transaction.create') }}" wire:navigate
                            class="font-medium text-yellow-700 underline hover:text-yellow-600">Silahkan
                            tambahkan data baru atau cari data lain.</a>
                    </p>
                </div>
            </div>
        </div>
    @endif

    @script
        <script>
            Livewire.on('printing', (printContent) => {
                console.log('abs');
                const printWindow = window.open('', '_blank');
                printWindow.document.write(printContent);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            });
        </script>
    @endscript
</div>

@script
    <script>
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            initFlowbite();

        })
    </script>
@endscript

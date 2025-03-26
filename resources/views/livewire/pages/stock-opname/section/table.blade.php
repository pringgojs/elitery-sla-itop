<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @livewire('pages.stock-opname.section.filter')

    <div class="border rounded shadow-sm p-6 bg-white dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle ">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <caption
                                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                Daftar Barang Opnam di Gudang BBGP Jatim -
                                {{ $period }}
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Kode Barang</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Nama Barang</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Spesifikasi Barang</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Satuan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Stok Sekarang</th>
                                    {{-- <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Jumlah Barang Tersedia</th> --}}
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Jumlah Barang Keluar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($goods as $item)
                                    @php
                                        $total = $this->totalItem($item->id);
                                    @endphp
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->code }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->specification }}
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->unit->name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->total_stock }}
                                        </td>
                                        {{-- <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $total['stock'] }}
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            {{ $total['out'] }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $goods->links() }}
            </div>
        </div>
    </div>
</div>

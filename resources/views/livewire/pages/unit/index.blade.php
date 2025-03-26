<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Satuan Barang</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            @can('satuan.barang.create')
                <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-unit' })" type="button"
                    class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buat
                    Baru</a>
            @endcan
        </div>
    </div>
    <div class="bg-white shadow px-5 py-5">
        {{-- Care about people's approval and you will be their prisoner. --}}
        <div class="grid xl:grid-span-2 lg:grid-span-2 md:grid-span-5 sm:grid-span-6 gap-4">
            <div class="col-end-7 col-span-2">
                <div class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-bi-search class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                        </div>
                        <input type="text" wire:model.live="search" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cari berdasarkan nama... " required>
                    </div>
                </div>
            </div>
        </div>
        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($units as $item)
                <li wire:key="village-{{ $item->id }}" class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex gap-x-4">
                            <span class="inline-flex h-10 w-10 rounded-full items-center justify-center bg-gray-100">
                                <span class="font-medium leading-none text-gray-800">{{ initials($item->name) }}</span>
                            </span>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a href="#" class="">{{ ucwords($item->name) }}</a>
                                </p>
                                <p class="flex text-xs leading-5 text-gray-500">
                                    <a class="truncate">Jumlah barang: {{ $item->goods->count() ?? 0 }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-none items-center gap-x-2">
                        @can('satuan.barang.edit')
                            <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-unit', arguments: {id: '{{ $item->id }}'} })"
                                class="inline-flex rounded-lg p-2 bg-purple-50 text-purple-700 ring-4 ring-white">
                                <x-heroicon-o-pencil class="h-5 w-5" />
                            </a>
                        @endcan
                        @can('satuan.barang.delete')
                            <a id="dropdownDefaultButton-{{ $item->id }}"
                                data-dropdown-toggle="dropdown-{{ $item->id }}"
                                class="inline-flex rounded-lg p-2 bg-red-50 text-red-700 ring-4 ring-white cursor-pointer">
                                <x-heroicon-o-trash class="h-5 w-5" />
                            </a>

                            <div id="dropdown-{{ $item->id }}"
                                class="z-10 hidden  mr-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-64 dark:bg-gray-700">
                                <div
                                    class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                                    <p class="mb-3 font-normal text-sm text-gray-500 dark:text-gray-400">Anda yakin ingin
                                        menghapus <b>{{ ucwords(strtolower($item->name)) }}</b>?</p>
                                    <a wire:key="item-{{ $item->id }}" wire:click="delete('{{ $item->id }}')"
                                        class="cursor-pointer item-right rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-900 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">
                                        Ya, hapus!
                                    </a>
                                </div>
                            </div>
                        @endcan
                    </div>
                </li>
            @endforeach

        </ul>

        {{ $units->links() }}
    </div>

</div>

@script
    <script>
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            initFlowbite()
        })
    </script>
@endscript

<div>
    <div class="bg-white shadow px-5 py-5">
        {{-- Care about people's approval and you will be their prisoner. --}}

        @livewire('pages.village.section.filter')
        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($villages as $item)
                <li wire:key="village-{{ $item->id }}"
                    class="flex items-center justify-between gap-x-6 py-5 hover:bg-gray-50">
                    <div class="min-w-0">
                        <div class="flex gap-x-4">
                            <span class="inline-flex h-10 w-10 rounded-full items-center justify-center bg-gray-100">
                                <span class="font-medium leading-none text-gray-800">{{ initials($item->name) }}</span>
                            </span>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <a href="#" class="">{{ ucwords(strtolower($item->name)) }}
                                        {!! $item->labelType() !!}</a>
                                </p>
                                <p class="flex text-xs leading-5 text-gray-500">
                                    <a class="truncate">{{ $item->address }}</a>
                                </p>
                                <p class="flex text-xs leading-5 text-gray-500">
                                    <a class="truncate">{{ $item->district->name ?? '' }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-none items-center gap-x-2">
                        <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-village', arguments: {id: '{{ $item->id }}'} })"
                            class="inline-flex rounded-lg p-2 bg-purple-50 text-purple-700 ring-4 ring-white">
                            <x-heroicon-o-pencil class="h-5 w-5" />
                        </a>
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
                    </div>
                </li>
            @endforeach

        </ul>

        {{ $villages->links() }}
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

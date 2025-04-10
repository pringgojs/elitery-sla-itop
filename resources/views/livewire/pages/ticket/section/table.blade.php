<div>
    <span class=" bg-teal-500 "></span>
    <span class="bg-yellow-500"></span>
    <x-table :headers="['Action', 'Created At', 'Organization', 'Title', 'Agent L1', 'Agent L2']" title="Ticket">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($this->items as $index => $item)
                <tr>
                    <td>
                        <div class="m-5">

                            @php
                                $menuItems = [
                                    [
                                        'type' => 'link',
                                        'label' => 'Detail',
                                        'url' => '',
                                        'color' => 'text-gray-800',
                                        'navigate' => true,
                                        'permission' => 'kegiatan.penanaman.pohon.edit',
                                    ],
                                    [
                                        'type' => 'link',
                                        'label' => 'Recalculate',
                                        'url' => '',
                                        'color' => 'text-gray-800',
                                        'navigate' => false,
                                        'permission' => 'kegiatan.penanaman.pohon.edit',
                                    ],
                                    [
                                        'type' => 'delete',
                                        'label' => 'Delete',
                                        'color' => 'text-red-600',
                                        'permission' => 'kegiatan.penanaman.pohon.delete',
                                    ],
                                ];
                            @endphp

                            <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems"
                                modalName="modalConfirmDelete" />
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ date_format_human($item->start_date) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->organization->name ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                        <b>{{ $item->ref }} {!! $item->status() !!}</b> <br>
                        {{ $item->title }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        Name: {{ $item->agent_l1_name ?? '-' }} <br>
                        Response Time:
                        {{ $item->agent_l1_response_time ? convert_seconds($item->agent_l1_response_time) : 0 }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        Name: {{ $item->agent_l2_name ?? '-' }} <br>
                        Response Time:
                        {{ $item->agent_l2_response_time ? convert_seconds($item->agent_l2_response_time) : 0 }} <br>
                        Resolution Time:
                        {{ $item->agent_l2_resolution_time ? convert_seconds($item->agent_l2_resolution_time) : 0 }}
                    </td>
                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{ $this->items->links() }}
        </x-slot:footer>
    </x-table>

    {{-- modal confirm --}}
    <x-utils.modal-delete desc="Anda yakin ingin menghapus data ini ? data yang sudah dihapus tidak dapat dikembalikan!"
        id="modalConfirmDelete" wire:ignore />
</div>


@script
    <script>
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            initFlowbite();
            window.HSStaticMethods.autoInit(['dropdown']);
        })
    </script>
@endscript

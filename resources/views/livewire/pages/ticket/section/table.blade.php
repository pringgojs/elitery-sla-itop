<div>
    <x-table :headers="['Action', 'Created At', 'Organization', 'Title', 'Agent L1', 'Agent L2']" title="Ticket">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($this->items as $index => $item)
                @php
                    $slaService = new \App\Services\SlaService($item);
                @endphp
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
                        @php
                            $agentL1 = $slaService->getAgentL1();
                        @endphp
                        Name: {{ $agentL1['agent'] ?? '-' }} <br>
                        Response Time: {{ $agentL1['response_time_formated'] ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        @php
                            $agentL2 = $slaService->getAgentL2();
                        @endphp
                        Name: {{ $agentL2['agent'] ?? '-' }} <br>
                        Response Time: {{ $agentL2['response_time_formated'] ?? '-' }} <br>
                        Resolution Time: {{ $agentL2['resolution_time_formated'] ?? '-' }}
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

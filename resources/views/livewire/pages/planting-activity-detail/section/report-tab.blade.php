<div>
    <x-table :headers="['Aksi', 'No Laporan', 'Tanggal Laporan', 'Catatan']" title="Laporan Kehidupan Bibit">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($this->items as $index => $item)
                @php
                    $plantingActivity = $item->plantingActivity;
                @endphp
                <tr>
                    <td>
                        <div class="m-5">

                            {{-- <a @click="$dispatch('set-open-detail', true); $wire.detail('{{ $item->id }}')"
                                    class="inline-flex rounded-lg p-2 bg-green-50 text-green-700 ring-4 ring-white cursor-pointer">
                                    <x-heroicon-o-document-text class="h-5 w-5" />
                                </a> --}}
                            @php
                                $menuItems = [];
                            @endphp
                            {{-- @if (!in_array($item->dataStatus->key, $arr)) --}}
                            @php
                                $menuItems = [
                                    [
                                        'type' => 'link',
                                        'label' => 'Kegiatan Penanaman',
                                        'url' => route('planting-activity-detail.index', [
                                            'id' => $plantingActivity->id,
                                        ]),
                                        'color' => 'text-gray-800',
                                        'navigate' => true,
                                        'permission' => 'kegiatan.penanaman.pohon.edit',
                                    ],
                                    [
                                        'type' => 'wireModal',
                                        'component' => 'modals.form-planting-activity-report',
                                        'argument' =>
                                            "{plantingActivityId: '" .
                                            $plantingActivity->id .
                                            "', id: '" .
                                            $item->id .
                                            "'}",
                                        'label' => 'Edit',
                                        'id' => $item->id,
                                        'color' => 'text-gray-800',
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
                            {{-- @endif --}}

                            <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems"
                                modalName="modalConfirmDelete" />
                            {{-- Livewire.dispatch('openModal', { component: 'modals.form-planting-activity-report',
                            arguments: {plantingActivityId: '9e6d3523-d1dd-429c-b31b-eeba2cc9eef3'}, {id:
                            '9e6d359b-f277-4315-bc65-966c6c20c7d3'} }) --}}
                            {{-- onclick="Livewire.dispatch('openModal', { component: 'modals.form-seed', arguments: {id: '{{ $item->id }}'} })" --}}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->number }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ date_format_human($plantingActivity->date_of_activity) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->note }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-left text-gray-800 dark:text-neutral-200">
                        @foreach ($item->details as $detail)
                            <p>{{ $detail->seed->name }} (mati: {{ $detail->dead_amount }}, hidup:
                                {{ $detail->alive_amount }})</p>
                        @endforeach
                        <br>
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

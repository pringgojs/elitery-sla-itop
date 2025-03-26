<div>
    <x-table :headers="['Aksi', 'Tanggal', 'Jenis Kegiatan', 'Pelaksana Kegiatan', 'Petugas', 'Wilayah', 'Bibit']" title="Data Kegiatan Gerakan Penanaman Pohon">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($this->items as $index => $item)
                @php
                    $histories = $item->histories;
                @endphp
                <tr>
                    <td>
                        <div class="m-5">

                            {{-- <a @click="$dispatch('set-open-detail', true); $wire.detail('{{ $item->id }}')"
                                    class="inline-flex rounded-lg p-2 bg-green-50 text-green-700 ring-4 ring-white cursor-pointer">
                                    <x-heroicon-o-document-text class="h-5 w-5" />
                                </a> --}}
                            @php
                                $arr = ['diajukan', 'final'];
                                $menuItems = [];
                            @endphp
                            {{-- @if (!in_array($item->dataStatus->key, $arr)) --}}
                            @php
                                $menuItems = [
                                    [
                                        'type' => 'wireModal',
                                        'component' => 'modals.form-planting-activity-report',
                                        'argument' => "{plantingActivityId: '" . $item->id . "'}",
                                        'label' => 'Tambah Laporan',
                                        'id' => $item->id,
                                        'color' => 'text-gray-800 font-bold',
                                        'permission' => 'kegiatan.penanaman.pohon.create',
                                    ],
                                    [
                                        'type' => 'link',
                                        'label' => 'Detail',
                                        'url' => route('planting-activity-detail.index', [
                                            'id' => $item->id,
                                        ]),
                                        'color' => 'text-gray-800',
                                        'navigate' => true,
                                        'permission' => 'kegiatan.penanaman.pohon.edit',
                                    ],
                                    [
                                        'type' => 'link',
                                        'label' => 'Edit',
                                        'url' => route('planting-activity.form', [
                                            'id' => $item->id,
                                        ]),
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
                            {{-- @endif --}}

                            <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems"
                                modalName="modalConfirmDelete" />
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ date_format_human($item->date_of_activity) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->activityType->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->activity_organizer }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->creator->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->village->name }} - {{ $item->district->name }} - ({{ $item->regency->name }})</td>


                    <td class="px-6 py-4 whitespace-nowrap text-sm text-left text-gray-800 dark:text-neutral-200">
                        @foreach ($item->seeds as $seedItem)
                            <p>{{ $seedItem->seed->name }} ({{ $seedItem->amount }} bibit)</p>
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

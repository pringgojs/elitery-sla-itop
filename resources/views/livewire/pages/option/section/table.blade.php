<div>

    <x-table :headers="$this->headers" :title="$this->title">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($items as $index => $item)
                <tr>
                    <td>
                        <div class="m-5">
                            @php
                                $menuItems = [
                                    [
                                        'type' => 'link',
                                        'label' => 'Edit',
                                        'url' => route('option.form', ['id' => $item->id]),
                                        'color' => 'text-gray-800',
                                    ],
                                    [
                                        'type' => 'delete',
                                        'label' => 'Delete',
                                        'color' => 'text-red-600',
                                    ],
                                ];
                            @endphp
                            {{-- @endif --}}

                            <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems"
                                modalName="modalConfirmDelete" />
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->name }}
                    </td>

                    @if ($item->type == 'activity_type')
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            {{ $item->getColor() }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{-- {{ $items->links() }} --}}
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

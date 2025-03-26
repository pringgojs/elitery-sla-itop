<!-- resources/views/components/dropdown.blade.php -->
<div>
    <button id="toggle-menu-action-{{ $id }}" data-dropdown-toggle="dropdown-menu-action-{{ $id }}"
        type="button"
        class="py-1.5 px-2 inline-flex justify-center items-center gap-2 rounded-lg text-gray-700 align-middle disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-green-600 transition-all text-sm dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="1" />
            <circle cx="19" cy="12" r="1" />
            <circle cx="5" cy="12" r="1" />
        </svg>
    </button>

    <!-- Dropdown Items -->
    <div id="dropdown-menu-action-{{ $id }}" aria-labelledby="toggle-menu-action-{{ $id }}"
        class="hidden divide-y divide-gray-200 min-w-40 z-20 bg-white shadow-2xl rounded-lg p-2 mt-2 dark:divide-neutral-700 dark:bg-neutral-800 dark:border dark:border-neutral-700">
        <!-- Title -->
        <div class="py-2 first:pt-0 last:pb-0">
            <span class="block py-2 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-600">
                Actions
            </span>
        </div>

        <!-- Dynamically Generated Menu Items -->
        @foreach ($items as $item)
            @can($item['permission'])
                <a class="flex cursor-pointer items-center gap-x-3 py-2 px-3 rounded-lg border-none text-sm {{ $item['color'] ?? 'text-gray-800' }} hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                    @if ($item['type'] == 'click') wire:click="{{ $item['action'] }}('{{ $item['param'] }}')" @endif
                    @if ($item['type'] == 'link') href="{{ $item['url'] }}" @if (isset($item['navigate']))  @else wire:navigate @endif
                    @endif
                    @if ($item['type'] == 'delete') onclick="document.getElementById('modalConfirmDelete')._x_dataStack[0].show = true;document.getElementById('{{ $modalName }}')._x_dataStack[0].id = '{{ $id }}';" @endif
                    @if ($item['type'] == 'wireModal') onclick="Livewire.dispatch('openModal', { component: '{{ $item['component'] }}', arguments: {!! $item['argument'] !!} })" @endif
                    @if ($item['type'] == 'modal') onclick="document.getElementById('{{ $item['modalName'] }}')._x_dataStack[0].show = true;document.getElementById('{{ $item['modalName'] }}')._x_dataStack[0].id = '{{ $id }}';" @endif>
                    {{ $item['label'] }}
                </a>
            @endcan
        @endforeach
    </div>
</div>

@script
    <script>
        initFlowbite();
    </script>
@endscript

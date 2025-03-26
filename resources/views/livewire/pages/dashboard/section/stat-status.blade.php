<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <h3 class="text-base mt-5 font-semibold leading-6 text-gray-900">Total Perangkat 6 Bulan Menjelang Pensiun</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">
        @foreach ($stats as $i => $value)
            <a wire:key="stats-staff-{{ $i }}"
                class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="wrap-text text-sm font-medium text-gray-500">{{ $i }}</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $value }}
                </dd>
            </a>
        @endforeach
    </dl>

    <h3 class="text-base mt-5 font-semibold leading-6 text-gray-900">Total Perangkat Berdasarkan Status Data</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">
        @foreach ($status_data as $i => $item)
            <a wire:key="status-data-{{ $i }}"
                class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="wrap-text text-sm font-medium text-gray-500">{{ $item->name }}</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                    {{ $item->villageStaffStatusData->count() }}
                </dd>
            </a>
        @endforeach
    </dl>
</div>

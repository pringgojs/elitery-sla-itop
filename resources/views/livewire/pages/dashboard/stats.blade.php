<div>
    <h3 class="text-base font-semibold leading-6 text-gray-900">Transaksi Harian</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        {{-- @foreach ($options as $item) --}}
        <a wire:navigate class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_daily'] }}
            </dd>
        </a>
        <a wire:navigate class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Menunggu Persetujuan</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_daily_pending'] }}
            </dd>
        </a>
        <a wire:navigate class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Selesai</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_daily_done'] }}
            </dd>
        </a>
        {{-- @endforeach --}}
    </dl>
    <h3 class="text-base font-semibold leading-6 text-gray-900 mt-5">Transaksi Permohonan Pengadaan Barang</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        {{-- @foreach ($options as $item) --}}
        <a wire:navigate class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_semester'] }}
            </dd>
        </a>
        <a wire:navigate class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Menunggu Persetujuan</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_semester_pending'] }}
            </dd>
        </a>
        <a wire:navigate class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Selesai</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_semester_done'] }}
            </dd>
        </a>
        {{-- @endforeach --}}
    </dl>
</div>

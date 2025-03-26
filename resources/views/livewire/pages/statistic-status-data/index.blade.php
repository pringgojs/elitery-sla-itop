<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="flex items-center mb-5 mt-5">
        <div class="flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Statistik Status Data</h1>
        </div>
    </div>
    <div class="flex items-center mt-5">
        <div class="flex-auto bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tabel di sebelah kiri -->
                @livewire('pages.statistic-status-data.section.table')
                <!-- Chart di sebelah kanan -->

                <livewire:bar-chart-component :series="$series" :categories="$legend" :$title />
            </div>
        </div>
    </div>
</div>

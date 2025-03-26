<div>
    {{-- The whole world belongs to you. --}}
    <div class="flex items-center mb-5">
        <div class="flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Statistik PD akan Pensiun</h1>
        </div>
    </div>

    <div class="flex items-center">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tabel di sebelah kiri -->
                @livewire('pages.statistic.section.table')
                <!-- Chart di sebelah kanan -->
                @php
                    // $legend = ['Category A', 'Category B', 'Category C', 'Category D'];
                    // $series = [
                    //     [
                    //         'name' => 'Series 1',
                    //         'data' => [10, 20, 15, 25],
                    //     ],
                    //     [
                    //         'name' => 'Series 2',
                    //         'data' => [12, 18, 22, 30],
                    //     ],
                    // ];
                @endphp

                {{-- <livewire:utils.bar-chart :$legend :$series :$title id="jumlah-berdasarkan-jenis" /> --}}
                <livewire:bar-chart-component :series="$series" :categories="$legend" :$title />
            </div>
        </div>
    </div>
</div>

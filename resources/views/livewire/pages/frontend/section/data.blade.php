<div>

    {{-- In work, do what you enjoy. --}}
    {{-- map --}}
    @livewire('utils.maps', ['markers' => $this->markers, 'useOnClickMarker' => false])

    @php
        $counter = $this->counter;
        $barChartPlantingActivityByType = $this->barChartPlantingActivityByType;
        $barChartPlantingActivityByUser = $this->barChartPlantingActivityByUser;
        $pieChartPlantingActivityBySeed = $this->pieChartPlantingActivityBySeed;
        $pieChartPlantingActivityByRegency = $this->pieChartPlantingActivityByRegency;

    @endphp



    <div class="mt-5">
        <h3 class="text-base font-semibold text-gray-900">Data Penanaman Pohon</h3>

        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-green-500 p-3">
                        <x-jam-activity class="size-6 text-white" />
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Penanaman</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $counter['total_activity'] }}</p>
                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-green-600 hover:text-green-500">View all<span
                                    class="sr-only"> Total Subscribers stats</span></a>
                        </div>
                    </div>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-green-500 p-3">
                        <x-entypo-area-graph class="size-6 text-white" />
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Luas Lahan</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $counter['total_land_area'] }}</p>
                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-green-600 hover:text-green-500">View all<span
                                    class="sr-only"> Avg. Open Rate stats</span></a>
                        </div>
                    </div>
                </dd>
            </div>
            <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-green-500 p-3">
                        <x-fas-seedling class="size-6 text-white" />
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Jumlah Bibit</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ $counter['total_seed'] }}</p>
                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-green-600 hover:text-green-500">View all<span
                                    class="sr-only"> Avg. Click Rate stats</span></a>
                        </div>
                    </div>
                </dd>
            </div>
        </dl>
    </div>

    {{-- table --}}
    <div class="mt-5">
        <x-table :headers="['No.', 'Jenis Kegiatan', 'Total Jumlah Bibit (Batang)', 'Total Luas (Ha)']" title="Data Kegiatan Gerakan Penanaman Pohon">
            <!-- Table Content -->
            <x-slot:table>
                @foreach ($this->dataPerActivity as $index => $item)
                    @php
                        $totalSeed = \App\Models\PlantingActivity::getTotalSeedParams($item->id, $params);
                        $totalLandArea = \App\Models\PlantingActivity::getTotalLandAreaParams($item->id, $params);
                        // $total_seed += $totalSeed;
                        // $total_land_area += $totalLandArea;
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            {{ ++$index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            {{ $totalLandArea }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                            {{ $totalSeed }}
                        </td>
                    </tr>
                @endforeach
            </x-slot:table>

            <!-- Footer for Pagination -->
            <x-slot:footer>
                {{-- {{ $this->items->links() }} --}}
            </x-slot:footer>
        </x-table>
    </div>

    <div class="mt-5 shadow-sm bg-white p-5" wire:ignore>
        @livewire('utils.bar-chart', ['listener' => 'on-update-activity-by-type', 'id' => 'bar-chart-activity-by-type', 'title' => $barChartPlantingActivityByType['title'], 'legend' => $barChartPlantingActivityByType['legend'], 'series' => $barChartPlantingActivityByType['series']])
    </div>

    <div class="mt-5 shadow-sm bg-white p-5 w-full" wire:ignore>
        @livewire('utils.bar-chart', ['listener' => 'on-update-activity-by-user', 'id' => 'bar-chart-activity-by-user', 'title' => $barChartPlantingActivityByUser['title'], 'legend' => $barChartPlantingActivityByUser['legend'], 'series' => $barChartPlantingActivityByUser['series']])
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5" wire:ignore>
        <div class="p-4 bg-white rounded-md">
            @livewire('utils.pie-chart', ['listener' => 'on-update-activity-by-seed', 'id' => 'pie-chart-activity-by-seed', 'title' => $pieChartPlantingActivityBySeed['title'], 'legend' => $pieChartPlantingActivityBySeed['legend'], 'series' => $pieChartPlantingActivityBySeed['series']])
        </div>
        <div class="p-4 bg-white rounded-md">
            @livewire('utils.pie-chart', ['listener' => 'on-update-activity-by-regency', 'id' => 'pie-chart-activity-by-regency', 'title' => $pieChartPlantingActivityByRegency['title'], 'legend' => $pieChartPlantingActivityByRegency['legend'], 'series' => $pieChartPlantingActivityByRegency['series']])
        </div>
    </div>
</div>

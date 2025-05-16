<div>

    <div x-data="barChart()" x-init="initBarChart({
        id: '{{ $id }}',
        series: @js($series),
        legend: @js($legend),
        title: @js($title),
        listener: '{{ $listener }}'
    })"
        x-on:bar-chart-update-title-{{ $id }}.window="updateTitle($event.detail)" class="p-2">
        <!-- Header -->
        <div class="flex justify-between items-center mb-2">
            <!-- Title Section -->
            <div class=" px-6 py-4 w-full mr-2">
                <h1 class="text-base font-semibold leading-6 text-gray-900" x-html="chartTitle"></h1>
            </div>

            <!-- Loading Circle -->
            <div wire:loading class="flex-shrink-0 flex items-center justify-center">
                @livewire('utils.loading', key(\Illuminate\Support\Str::random(10)))
            </div>
        </div>
        <!-- Content Area -->
        <div class="text-center text-lg font-medium h-96">
            <canvas id="bar-chart-{{ $id }}"></canvas>
        </div>
    </div>

</div>

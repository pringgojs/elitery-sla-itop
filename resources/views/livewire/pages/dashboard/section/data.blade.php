<div>
    {{-- In work, do what you enjoy. --}}
    <h3 class="text-base mt-5 font-semibold leading-6 text-gray-900">Counter</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">
        @foreach ($this->counter as $item)
            <a href="" wire:navigate wire:key="status-data-{{ $item['id'] }}"
                class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="wrap-text text-sm font-medium text-gray-500">{{ $item['name'] }}</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                    {{ $item['count'] }}
                </dd>
            </a>
        @endforeach
    </dl>

    @php
        $barChartHandlingRequestPerDept = $this->barChartHandlingRequestPerDept();
    @endphp
    <div class="mt-5 shadow-sm bg-white p-5" wire:ignore>
        @livewire('utils.bar-chart', ['listener' => 'on-update-handling-request-per-dept', 'id' => 'bar-chart-handling-request-per-dept', 'title' => $barChartHandlingRequestPerDept['title'], 'legend' => $barChartHandlingRequestPerDept['legend'], 'series' => $barChartHandlingRequestPerDept['series']])
    </div>
</div>

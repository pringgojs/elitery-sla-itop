<div>
    {{-- In work, do what you enjoy. --}}
    <h3 class="text-base mt-5 font-semibold leading-6 text-gray-900">Counter</h3>
    <dl x-data="{
        counters: @js($counter),
        updateCounter(data) {
            // Konversi data menjadi array biasa
            const plainData = JSON.parse(JSON.stringify(data[0])); // Ambil elemen pertama dari array bersarang
            this.counters = plainData; // Perbarui counters dengan array biasa
        }
    }" x-on:on-update-counter.window="updateCounter(event.detail)" x-effect="counters"
        class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">

        <template x-for="item in counters" :key="item.id">
            <a href="" wire:navigate class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="wrap-text text-sm font-medium text-gray-500" x-text="item.name"></dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900" x-text="item.count"></dd>
            </a>
        </template>
    </dl>

    <div class="mt-5 shadow-sm bg-white p-5" wire:ignore>
        @livewire('utils.bar-chart', ['listener' => 'on-update-handling-request-per-dept', 'id' => 'bar-chart-handling-request-per-dept', 'title' => $barChartHandlingRequest['title'], 'legend' => $barChartHandlingRequest['legend'], 'series' => $barChartHandlingRequest['series']])
    </div>

    <div class="mt-5 shadow-sm bg-white p-5" wire:ignore>
        @livewire('utils.bar-chart', ['listener' => 'on-update-ticket-per-month', 'id' => 'bar-chart-ticket-per-month', 'title' => $barChartTotalTicketPerMonth['title'], 'legend' => $barChartTotalTicketPerMonth['legend'], 'series' => $barChartTotalTicketPerMonth['series']])
    </div>
</div>

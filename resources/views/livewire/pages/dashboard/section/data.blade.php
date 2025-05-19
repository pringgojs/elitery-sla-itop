<div>
    {{-- In work, do what you enjoy. --}}
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h3 class="mt-5 text-base font-semibold leading-6 text-gray-900">Counter</h3>
        </div>
        <div wire:loading class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            @livewire('utils.loading', key(\Illuminate\Support\Str::random(10)))
        </div>
    </div>

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
            <a href="#" wire:navigate class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="wrap-text text-sm font-medium text-gray-500" x-text="item.name"></dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900" x-text="item.count"></dd>
            </a>
        </template>
    </dl>


    @php
        $treemapSource = $this->treemapChartTicketPerDept;
    @endphp
    <div>
        <livewire:utils.treemap-chart lazy listener="on-update-handling-request-per-dept"
            id="treemap-chart-handling-request-per-dept" :title="$treemapSource['title']" :label="$treemapSource['label']" :series="$treemapSource['series']" />
    </div>

    <div class="mt-5 shadow-sm bg-white p-5" wire:ignore>
        <livewire:utils.bar-chart lazy listener="on-update-ticket-per-month" id="bar-chart-ticket-per-month"
            :title="$barChartTotalTicketPerMonth['title']" :legend="$barChartTotalTicketPerMonth['legend']" :series="$barChartTotalTicketPerMonth['series']" />
    </div>

    <div class="mt-5">
        <livewire:pages.dashboard.section.table lazy :params="$params" />
    </div>
</div>

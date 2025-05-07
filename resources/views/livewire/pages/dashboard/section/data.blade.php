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

    <div class="mt-5 shadow-sm bg-white p-5" wire:ignore>
        @livewire('utils.bar-chart', ['listener' => 'on-update-handling-request-per-dept', 'id' => 'bar-chart-handling-request-per-dept', 'title' => $barChartHandlingRequest['title'], 'legend' => $barChartHandlingRequest['legend'], 'series' => $barChartHandlingRequest['series']])
    </div>

    <div class="mt-5 shadow-sm bg-white p-5" wire:ignore>
        @livewire('utils.bar-chart', ['listener' => 'on-update-ticket-per-month', 'id' => 'bar-chart-ticket-per-month', 'title' => $barChartTotalTicketPerMonth['title'], 'legend' => $barChartTotalTicketPerMonth['legend'], 'series' => $barChartTotalTicketPerMonth['series']])
    </div>

    {{-- sla --}}
    <!-- Slider -->
    <div data-hs-carousel='{
    "loadingClasses": "opacity-0",
    "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500",
    "isAutoPlay": false
  }'
        class="relative mt-5">
        <div class="hs-carousel relative overflow-hidden w-full min-h-96 bg-white rounded-lg" style="height:700px">
            <div wire:ignore
                class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
                @foreach ($barChartSlaPerAgent as $i => $item)
                    <div class="hs-carousel-slide bg-white p-5">
                        @livewire('utils.bar-chart', ['listener' => 'on-update-sla-per-agent-' . $i, 'id' => 'bar-chart-sla-per-agent-' . $i, 'title' => $item['title'], 'legend' => $item['legend'], 'series' => $item['series']], key('wire-bar-chart-sla-per-agent-' . $i))
                    </div>
                @endforeach
            </div>
        </div>

        <button type="button"
            class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <span class="text-2xl" aria-hidden="true">
                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
            </span>
            <span class="sr-only">Previous</span>
        </button>
        <button type="button"
            class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-11.5 h-full text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <span class="sr-only">Next</span>
            <span class="text-2xl" aria-hidden="true">
                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </span>
        </button>

        <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0  gap-x-2"></div>
    </div>
    <!-- End Slider -->
</div>

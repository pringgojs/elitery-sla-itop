<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="mt-5 bg-white p-5 shadow-md rounded-md">
        <livewire:bar-chart-component :series="$dailySeries" :categories="$dailyLegend" :title="$dailyTitle"
            key="graph-daily-transaction" />
    </div>

    <div class="mt-5 bg-white p-5 shadow-md rounded-md">
        <livewire:bar-chart-component :series="$semesterSeries" :categories="$semesterLegend" :title="$semesterTitle"
            key="graph-semester-transaction" />
    </div>
</div>

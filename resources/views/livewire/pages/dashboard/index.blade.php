<div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Dashboard</h1>
        </div>
    </div>

    {{-- default filter: dateType = bulan ini, type: [UserRequest]  --}}
    <livewire:utils.filter lazy table="pages.dashboard.section.data" date-type="this-month" require-type="true"
        :type="['id' => 'UserRequest', 'name' => 'User Request']" use-type="true" use-status="false" use-date="true" use-search="false" use-download="true"
        use-organization="true" use-caller="false" use-team="false" use-agent="false" use-date-today="false"
        use-date-this-month="true" use-date-other-month="true" use-date-other-year="false" use-date-range="false" />
    <livewire:pages.dashboard.section.data />
</div>

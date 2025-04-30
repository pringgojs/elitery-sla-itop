<div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Dashboard</h1>
        </div>
    </div>

    @livewire('utils.filter', ['table' => 'pages.dashboard.section.data', 'useType' => true, 'useStatus' => false, 'useDate' => true, 'useSearch' => false, 'useDownload' => true, 'useOrganization' => true, 'useCaller' => false, 'useTeam' => false, 'useAgent' => false, 'useDateToday' => false, 'useDateThisMonth' => true, 'useDateOtherMonth' => true, 'useDateOtherYear' => false, 'useDateRange' => false])
    @livewire('pages.dashboard.section.data')
</div>

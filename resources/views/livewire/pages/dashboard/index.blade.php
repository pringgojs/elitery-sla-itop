<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Dashboard</h1>
        </div>
    </div>

    @livewire('utils.filter', ['table' => 'pages.ticket.section.table', 'useType' => true, 'useStatus' => true, 'useDate' => true, 'useSearch' => false, 'useDownload' => true, 'useOrganization' => true, 'useCaller' => false, 'useTeam' => false, 'useAgent' => true, 'useDateToday' => true, 'useDateThisMonth' => true, 'useDateOtherMonth' => true, 'useDateOtherYear' => true, 'useDateRange' => true])
    {{-- @livewire('pages.ticket.section.table') --}}
</div>

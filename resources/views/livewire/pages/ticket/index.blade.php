<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Ticket</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
    </div>

    @livewire('utils.filter', ['table' => 'pages.ticket.section.table', 'useType' => true, 'useStatus' => true, 'useDate' => true, 'useSearch' => true, 'useDownload' => true, 'useOrganization' => true, 'useCaller' => true, 'useTeam' => true, 'useAgent' => true, 'useDateToday' => true, 'useDateThisMonth' => true, 'useDateOtherMonth' => true, 'useDateOtherYear' => true, 'useDateRange' => true])
    @livewire('pages.ticket.section.table')
</div>

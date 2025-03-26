<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ $this->title }}</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ url('option/form?type=' . $key) }}" type="button"
                class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buat
                Baru</a>
        </div>
    </div>
    <div class="bg-red-200 text-red-500"></div>
    <div class="bg-blue-200 text-blue-500"></div>
    <div class="bg-green-200 text-green-500"></div>

    {{-- panggil component table.staff --}}
    {{-- <x-staff.table :$staffs :$staff /> --}}
    {{-- @livewire('utils.filter', ['table' => 'pages.planting-activity.section.table', 'useDate' => true, 'useArea' => true, 'useActivityType' => true, 'useBudgetSource' => true, 'useSeedSource' => true, 'useSeedType' => true, 'useDateToday' => true, 'useDateThisMonth' => true, 'useDateOtherMonth' => true, 'useDateRange' => true]) --}}
    @livewire('pages.option.section.table', ['key' => request()->get('type')])
</div>

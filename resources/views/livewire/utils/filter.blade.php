<div>
    {{-- In work, do what you enjoy. --}}
    <div x-data="filter()">
        <div class="flex flex-wrap items-center space-x-1 mb-2">
            <div class="relative flex items-center space-x-1">
                <div class="hs-dropdown  z-auto relative inline-flex [--auto-close:inside]">
                    <button id="hs-dropdown-with-title" type="button"
                        class="hs-dropdown-toggle py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-md border border-gray-300 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        Filter
                        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-title">
                        <div class="p-1 space-y-0.5">
                            <span
                                class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                                Category
                            </span>
                            <div class="max-h-auto space-y-0.5">
                                @php

                                    $categories = [
                                        [
                                            'type' => 'organization',
                                            'condition' => $useOrganization,
                                            'label' => 'Organization',
                                        ],
                                        ['type' => 'caller', 'condition' => $useCaller, 'label' => 'Caller'],
                                        ['type' => 'team', 'condition' => $useTeam, 'label' => 'Team'],
                                        ['type' => 'agent', 'condition' => $useAgent, 'label' => 'Agent L1'],
                                        ['type' => 'agent_l2', 'condition' => $useAgent, 'label' => 'Agent L2'],
                                        ['type' => 'type', 'condition' => $useType, 'label' => 'Type'],
                                        ['type' => 'status', 'condition' => $useStatus, 'label' => 'Status'],
                                    ];
                                @endphp
                                @foreach ($categories as $filter)
                                    @if ($filter['condition'])
                                        <div
                                            class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                                            <div id="hs-dropdown-{{ $filter['type'] }}"
                                                class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                :class="selected.{{ $filter['type'] }}.length > 0 ? 'bg-green-100' : ''">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1-1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                                </svg>
                                                {{ $filter['label'] }}
                                            </div>
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                                                role="menu" aria-orientation="vertical"
                                                aria-labelledby="hs-dropdown-{{ $filter['type'] }}">
                                                <div class="p-1 space-y-1">
                                                    <div class="max-w-sm">
                                                        <div class="relative">
                                                            <input type="text"
                                                                x-model="searchFields.{{ $filter['type'] }}"
                                                                class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                                placeholder="Search...">
                                                            <div
                                                                class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="overflow-y-scroll max-h-48 space-y-0.5">
                                                        <template
                                                            x-for="item in getFilteredData('{{ $filter['type'] }}')">
                                                            <a @click="toggleSelection('{{ $filter['type'] }}', item)"
                                                                class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                                                :class="isSelected('{{ $filter['type'] }}', item.id) ?
                                                                    'bg-green-100' : ''"
                                                                href="#" x-text="item.name">
                                                            </a>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        @if ($useDate)
                            <div class="p-1 space-y-0.5">
                                <span
                                    class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                                    Date
                                </span>
                                <div class="overflow-y-scroll max-h-32 space-y-0.5 ">
                                    @if ($useDateToday)
                                        <a @click="dateType == 'today' ? dateType = '' : dateType='today';doFilter()"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="dateType == 'today' ? 'bg-green-100' : ''" href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>

                                            Today
                                        </a>
                                    @endif
                                    @if ($useDateThisMonth)
                                        <a @click="dateType == 'this-month' ? dateType = '' : dateType='this-month';doFilter()"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="dateType == 'this-month' ? 'bg-green-100' : ''" href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>

                                            This Month
                                        </a>
                                    @endif
                                    @if ($useDateOtherMonth)
                                        {{-- bulan tertentu --}}
                                        <div x-data="{ showOptionMonth: false }">
                                            <a x-ref="btnOtherMonth" @click="showOptionMonth=!showOptionMonth;"
                                                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                :class="dateType == 'other-month' ? 'bg-green-100' : ''" href="#">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                                Other Month
                                            </a>
                                            {{-- select bulan --}}
                                            <div x-show='showOptionMonth' x-anchor.right-end="$refs.btnOtherMonth"
                                                x-cloak x-transition @click.away="showOptionMonth= !showOptionMonth"
                                                class="inline-flex z-10 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                role="menu" aria-orientation="vertical"
                                                aria-labelledby="menu-button" tabindex="-1">
                                                <div class="py-1 capitalize" role="none">
                                                    <div class="block p-4 text-sm text-gray-700" role="menuitem"
                                                        tabindex="-1" id="menu-item-1">
                                                        <x-label for=""
                                                            class="text-xs font-medium text-gray-700 dark:text-gray-200">
                                                            Month
                                                        </x-label>
                                                        <select name='month' x-model="month"
                                                            class="bg-gray-50 border px-4 capitalize border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                                            required>
                                                            <option value="" selected disabled>Choose
                                                            </option>
                                                            @foreach (months() as $month)
                                                                <option value="{{ $month['value'] }}">
                                                                    {{ $month['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <x-label for=""
                                                            class="mt-4 text-xs text-gray-700 dark:text-gray-200">
                                                            Year
                                                        </x-label>
                                                        <x-input x-mask="9999" x-model="year" type="text"
                                                            class="w-full py-2.5" name='year' placeholder="Tahun"
                                                            required />
                                                        <x-button class="w-full mt-3 text-sm"
                                                            @click="dateType='other-month';doFilter()"><span
                                                                class="mx-auto">Simpan</span></x-button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    @if ($useDateOtherYear)
                                        {{-- bulan tertentu --}}
                                        <div x-data="{ showOptionYear: false }">
                                            <a x-ref="btnOtherYear" @click="showOptionYear=!showOptionYear;"
                                                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                :class="dateType == 'other-year' ? 'bg-green-100' : ''" href="#">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                                Other Year
                                            </a>
                                            {{-- select bulan --}}
                                            <div x-show='showOptionYear' x-anchor.right-end="$refs.btnOtherYear"
                                                x-cloak x-transition @click.away="showOptionYear= !showOptionYear"
                                                class="inline-flex z-10 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                role="menu" aria-orientation="vertical"
                                                aria-labelledby="menu-button" tabindex="-1">
                                                <div class="py-1 capitalize" role="none">
                                                    <div class="block p-4 text-sm text-gray-700" role="menuitem"
                                                        tabindex="-1" id="menu-item-1">
                                                        <x-label for=""
                                                            class="mt-4 text-xs text-gray-700 dark:text-gray-200">
                                                            Year
                                                        </x-label>
                                                        <x-input x-mask="9999" x-model="year" type="text"
                                                            class="w-full py-2.5" name='year' placeholder="Tahun"
                                                            required />
                                                        <x-button class="w-full mt-3 text-sm"
                                                            @click="dateType='other-year';doFilter()"><span
                                                                class="mx-auto">Save</span></x-button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($useDateRange)
                                        {{-- date range --}}
                                        <div x-data="{ showOptionDaterange: false }">
                                            <a x-ref="btnDateRange" @click="showOptionDaterange=!showOptionDaterange;"
                                                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                :class="dateType == 'date-range' ? 'bg-green-100' : ''" href="#">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                                Date Range
                                            </a>
                                            {{-- date range --}}
                                            <div x-show='showOptionDaterange'
                                                x-anchor.right-start="$refs.btnDateRange" x-cloak x-transition
                                                @click.away="showOptionDaterange= !showOptionDaterange"
                                                class="inline-flex z-10 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                role="menu" aria-orientation="vertical"
                                                aria-labelledby="menu-button" tabindex="-1">
                                                <div class="py-1 capitalize" date-rangepicker role="none">
                                                    <div class="block p-4 text-sm text-gray-700" role="menuitem"
                                                        tabindex="-1" id="menu-item-1">
                                                        <x-label for=""
                                                            class="text-xs mb-2 font-medium text-gray-700 dark:text-gray-200">
                                                            Start date
                                                        </x-label>
                                                        <x-input class="w-full py-2 focus:border-green-500"
                                                            x-model="dateStart" id="datepicker-range-start"
                                                            name="start" type="date" />
                                                        <x-label for=""
                                                            class="mt-4 text-xs mb-2 text-gray-700 dark:text-gray-200">
                                                            End date
                                                        </x-label>
                                                        <x-input class="w-full py-2 focus:border-green-500"
                                                            x-model="dateEnd" id="datepicker-range-end"
                                                            name="end" type="date" />

                                                        <x-button class="w-full mt-3 text-sm"
                                                            @click="dateType='date-range';doFilter()"><span
                                                                class="mx-auto">Save</span></x-button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($useSearch)
                    <div class="relative flex items-center space-x-1">
                        <div class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <x-bi-search class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                                </div>
                                <input type="text" x-model="search" id="simple-search" @change="doFilter()"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    placeholder="Search ... " required>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="relative flex items-center space-x-1">
                    <div wire:loading class="-mt-6">
                        @livewire('utils.loading', key(\Illuminate\Support\Str::random(10)))
                    </div>
                </div>
                <div class="flex-grow"></div>

                @if ($useDownload)
                    <div class="flex flex-wrap items-center content-center space-x-1">
                        {{-- <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Button text</button> --}}
                        <div class="relative flex items-center">
                            @can('ticket.export')
                                <button wire:click="$dispatchTo('{{ $table }}','export')"
                                    class="flex
                            items-center rounded-md bg-white py-2.5 px-4 text-sm font-semibold text-gray-900 shadow-sm
                            ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    <x-bytesize-download class="h-5 w-5 mr-2" />
                                    Download
                                </button>
                            @endcan
                        </div>
                    </div>
                @endif
                <div class="relative flex items-center space-x-1">
                    <button class="hidden" x-ref="btnFilter" @click.debounce.6000ms="gas()"></button>
                    <button class="hidden" x-ref="btnGas"
                        wire:click="$dispatchTo('{{ $table }}', 'filter', {
                        search,
                        selected,
                        dateType,
                        month,
                        year,
                        dateStart,
                        dateEnd
                    })">
                    </button>
                </div>
            </div>
        </div>
        <div class="flex mb-5">
            {{-- Filter --}}

            <template x-for="(items, type) in selected" :key="type">
                <template x-for="item in items" :key="item.id">
                    <span
                        class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                        <p x-html="item.name"></p>
                        <button type="button" @click="toggleSelection(type, item)"
                            class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                            <span class="sr-only">Remove badge</span>
                            <x-ionicon-close-outline class="shrink-0 size-3" />
                        </button>
                    </span>
                </template>
            </template>

            {{-- date --}}
            <template x-if="dateType">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    Date: <div
                        x-html="dateType =='today' ? 'hari ini': dateType == 'this-month' ? 'bulan ini' : dateType == 'other-month' ? '' : ''">
                    </div>
                    <div
                        x-html="dateType == 'other-month' ? month +'/'+ year : dateType == 'date-range' ? dateStart +' - '+ dateEnd : ''">
                    </div>
                    <button @click="dateType = '';doFilter()" type="button"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>
        </div>

        <script>
            function filter() {
                return {
                    search: '',
                    area: '',
                    data: {
                        callers: @js($callers),
                        organizations: @js($organizations),
                        teams: @js($teams),
                        agents: @js($agents),
                        agent_l2s: @js($agents),
                        // statuses: @js($statuses),
                        statuses: [],
                        types: @js($types),
                    },
                    statusTicket: {
                        UserRequest: @js($statusTicketRequest),
                        NormalChange: @js($statusTicketChange),
                        RoutineChange: @js($statusTicketChange),
                        EmergencyChange: @js($statusTicketChange),
                        Incident: @js($statusTicketIncident),
                        Problem: @js($statusTicketProblem),
                    },
                    searchFields: {
                        organization: '',
                        caller: '',
                        team: '',
                        agent: '',
                        agent_l2: '',
                        type: '',
                        status: '',
                    },
                    selected: {
                        organization: [],
                        caller: [],
                        team: [],
                        agent: [],
                        agent_l2: [],
                        type: @js($type) ? [@js($type)] : [],
                        status: [],
                    },
                    dateType: @js($dateType),
                    month: '',
                    year: '',
                    dateStart: '',
                    dateEnd: '',
                    init() {
                        console.log('Filter initialized', @js('type'));
                        // Initialization logic if needed
                    },
                    getFilteredData(type) {
                        const searchValue = this.searchFields[type].toLowerCase();
                        const data = type == 'status' ? this.data[type + 'es'] : this.data[type +
                            's']; // Dynamically access data (e.g., callers, organizations)
                        if (!searchValue) return data.slice(0, 10); // Return top 10 if no search value
                        return data.filter(item => item.name.toLowerCase().includes(searchValue));
                    },
                    toggleSelection(type, item) {
                        if (type === 'type') {
                            @if ($requireType)
                                // Cek apakah pengguna mencoba menghapus filter 'type' terakhir
                                if (this.selected[type].length === 1 && this.selected[type][0].id === item.id) {
                                    // alert('You should at least select one of Type.');
                                    notification({
                                        type: 'error',
                                        title: 'Error',
                                        description: 'You should at least select one of Type',
                                        position: 'top-right'
                                    })
                                    return; // Batalkan aksi penghapusan
                                }
                            @endif
                            // Batasi pilihan hanya satu untuk filter 'type'
                            this.selected[type] = [item]; // Hanya simpan item yang baru dipilih
                            // Perbarui data 'statuses' berdasarkan 'type' yang dipilih
                            this.data.statuses = this.statusTicket[item.id] || [];
                            // Reset filter status yang sudah dipilih
                            this.selected.status = [];
                        } else {
                            const selectedList = this.selected[type];
                            const index = selectedList.findIndex(selected => selected.id === item.id);
                            if (index !== -1) {
                                selectedList.splice(index, 1);
                            } else {
                                selectedList.push(item);
                            }
                        }

                        console.log('Selected items:', this.selected[type]);
                        this.doFilter();
                    },
                    isSelected(type, id) {
                        return this.selected[type].some(item => item.id === id);
                    },
                    doFilter() {
                        console.log('Filtering...');
                        this.$refs.btnFilter.click();
                    },
                    gas() {
                        console.log('Applying filter...');
                        this.$refs.btnGas.click();
                    }
                };
            }
        </script>

        @script
            <script>
                window.HSStaticMethods.autoInit();
                initFlowbite()
            </script>
        @endscript
    </div>
</div>

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
                            <div class="max-h-auto space-y-0.5 ">
                                @if ($useOrganization)
                                    <div
                                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                                        <div id="hs-dropdown-organization"
                                            class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="selectedOrganizationName.length > 0 ? 'bg-green-100' : ''"
                                            href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                            </svg>

                                            Organization
                                        </div>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                                            role="menu" aria-orientation="vertical"
                                            aria-labelledby="hs-dropdown-organization">
                                            <div class="p-1 space-y-1">
                                                <div class="max-w-sm">
                                                    <div class="relative">
                                                        <input type="text" x-model="searchOrganization"
                                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Cari...">
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
                                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                                    <template x-for="item in filteredOrganizations">
                                                        <a @click="addSelectedOrganization(item);doFilter()"
                                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                                            :class="checkInSelectedOrganization(item.id) ? 'bg-green-100' : ''"
                                                            href="#" x-text="item.name">
                                                        </a>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($useCaller)
                                    <div
                                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                                        <div id="hs-dropdown-caller"
                                            class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="selectedCallerName.length > 0 ? 'bg-green-100' : ''" href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                            </svg>

                                            Caller
                                        </div>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                                            role="menu" aria-orientation="vertical"
                                            aria-labelledby="hs-dropdown-caller">
                                            <div class="p-1 space-y-1">
                                                <div class="max-w-sm">
                                                    <div class="relative">
                                                        <input type="text" x-model="searchCaller"
                                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Cari...">
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
                                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                                    <template x-for="item in filteredCallers">
                                                        <a @click="addSelectedCaller(item);doFilter()"
                                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                                            :class="checkInSelectedCaller(item.id) ? 'bg-green-100' : ''"
                                                            href="#" x-text="item.name">
                                                        </a>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($useTeam)
                                    <div
                                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                                        <div id="hs-dropdown-team"
                                            class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="selectedTeamName.length > 0 ? 'bg-green-100' : ''" href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                            </svg>

                                            Team
                                        </div>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                                            role="menu" aria-orientation="vertical"
                                            aria-labelledby="hs-dropdown-team">
                                            <div class="p-1 space-y-1">
                                                <div class="max-w-sm">
                                                    <div class="relative">
                                                        <input type="text" x-model="searchTeam"
                                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Cari...">
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
                                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                                    <template x-for="item in filteredTeams">
                                                        <a @click="addSelectedTeam(item);doFilter()"
                                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                                            :class="checkInSelectedTeam(item.id) ? 'bg-green-100' : ''"
                                                            href="#" x-text="item.name">
                                                        </a>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($useAgent)
                                    <div
                                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                                        <div id="hs-dropdown-agent"
                                            class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="selectedAgentName.length > 0 ? 'bg-green-100' : ''" href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                            </svg>

                                            Agent
                                        </div>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                                            role="menu" aria-orientation="vertical"
                                            aria-labelledby="hs-dropdown-agent">
                                            <div class="p-1 space-y-1">
                                                <div class="max-w-sm">
                                                    <div class="relative">
                                                        <input type="text" x-model="searchAgent"
                                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                            placeholder="Cari...">
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
                                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                                    <template x-for="item in filteredAgent">
                                                        <a @click="addSelectedAgent(item);doFilter()"
                                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                                            :class="checkInSelectedAgent(item.id) ? 'bg-green-100' : ''"
                                                            href="#" x-text="item.name">
                                                        </a>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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

                                            Totday
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

                                            This month
                                        </a>
                                    @endif
                                    @if ($useDateOtherMonth)
                                        {{-- bulan tertentu --}}
                                        <div x-data="{ showOptionMonth: false }">
                                            <a x-ref="btnOtherMonth" @click="showOptionMonth=!showOptionMonth;"
                                                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                :class="dateType == 'other-month' ? 'bg-green-100' : ''"
                                                href="#">
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
                                                :class="dateType == 'other-year' ? 'bg-green-100' : ''"
                                                href="#">
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
                                                :class="dateType == 'date-range' ? 'bg-green-100' : ''"
                                                href="#">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                                Date range
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
                                    placeholder="Cari ... " required>
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
                            {{-- @can('transaksi.pengeluaran.barang.export transaction') --}}
                            <button wire:click="$dispatchTo('{{ $table }}','export')"
                                class="flex
                            items-center rounded-md bg-white py-2.5 px-4 text-sm font-semibold text-gray-900 shadow-sm
                            ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                <x-bytesize-download class="h-5 w-5 mr-2" />
                                Download
                            </button>
                            {{-- @endcan --}}
                            {{-- @can('transaksi.pengeluaran.barang.export transaction detail') --}}
                            {{-- <button wire:click="exportDetail"
                            class="flex items-center rounded-md ml-1 bg-white  py-2.5 px-4 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <x-bytesize-download class="h-5 w-5 mr-2" />
                            Detail Transaksi
                        </button> --}}
                            {{-- @endcan --}}
                        </div>
                    </div>
                @endif
                <div class="relative flex items-center space-x-1">
                    <button class="hidden" x-ref="btnFilter" @click.debounce.6000ms="gas()"></button>
                    <button class="hidden" x-ref="btnGas"
                        wire:click="$dispatchTo('{{ $table }}', 'filter', {
                        search,
                        selectedOrganization,
                        selectedCaller,
                        selectedAgent,
                        selectedTeam,
                        dateType,
                        month,
                        year,
                        dateStart,
                        dateEnd
                    })">
                        {{-- @click="$wire.filter(area, search, positionType, selectedDistrict, selectedVillage, positionStatus, isParkir, isNullPerson, statusData)"></button> --}}

                    </button>
                </div>
            </div>
        </div>
        <div class="flex mb-5">
            {{-- Filter: --}}

            {{-- activity type --}}
            <template x-for="item in selectedOrganizationName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="item.name"></p>
                    <button type="button" @click="addSelectedOrganization(item);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>

            {{-- seed type --}}
            <template x-for="item in selectedCallerName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="item.name"></p>
                    <button type="button" @click="addSelectedCaller(item);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>

            {{-- budget source --}}
            <template x-for="item in selectedTeamName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="item.name"></p>
                    <button type="button" @click="addSelectedTeam(item);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>

            {{-- seed source --}}
            <template x-for="item in selectedAgentName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="item.name"></p>
                    <button type="button" @click="addSelectedAgent(item);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>

            {{-- date --}}
            <template x-if="dateType">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    Tanggal: <div
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

                    callers: @js($callers),
                    organizations: @js($organizations),
                    teams: @js($teams),
                    agents: @js($agents),

                    searchOrganization: '',
                    searchCaller: '',
                    searchAgent: '',
                    searchTeam: '',

                    selectedOrganization: [],
                    selectedOrganizationName: [],
                    selectedCaller: [],
                    selectedCallerName: [],
                    selectedAgent: [],
                    selectedAgentName: [],
                    selectedTeam: [],
                    selectedTeamName: [],

                    /* date */
                    dateType: @entangle('dateType'),
                    showSelectMonth: false,
                    month: '',
                    year: '',
                    dateStart: '',
                    dateEnd: '',
                    init() {
                        // Livewire.hook('morph.updating', () => this.loading = true);
                        // Livewire.hook('morph.updated', () => this.loading = false);
                    },
                    topTenOrganizations() {
                        return this.organizations.slice(0, 10);
                    },
                    /* filtered activity type */
                    get filteredOrganizations() {
                        if (this.searchOrganization === "") {
                            return this.topTenOrganizations(); // Jika input kosong, tampilkan semua data
                        }

                        let filtered = this.organizations.filter((item) =>
                            item.name
                            .toLowerCase()
                            .includes(this.searchOrganization.toLowerCase()));

                        return filtered;
                    },
                    addSelectedOrganization(i) {
                        let index = this.selectedOrganization.findIndex(item =>
                            item == i.id
                        );

                        if (index !== -1) {
                            this.selectedOrganization.splice(index, 1);
                            this.selectedOrganizationName.splice(index, 1);
                        } else {
                            this.selectedOrganization.push(i.id)
                            this.selectedOrganizationName.push(i)
                        }
                    },
                    checkInSelectedOrganization(value) {
                        let index = this.selectedOrganization.findIndex(item =>
                            item == value
                        );

                        if (index !== -1) {
                            return true;
                        }

                        return false;
                    },

                    /* filtered seed type */
                    topTenCallers() {
                        return this.callers.slice(0, 10);
                    },
                    get filteredCallers() {
                        if (this.searchCaller === "") {
                            return this.topTenCallers(); // Jika input kosong, tampilkan semua data
                        }

                        let filtered = this.callers.filter((item) =>
                            item.name
                            .toLowerCase()
                            .includes(this.searchCaller.toLowerCase())
                        );

                        return filtered;
                    },
                    addSelectedCaller(i) {
                        let index = this.selectedCaller.findIndex(item =>
                            item == i.id
                        );

                        if (index !== -1) {
                            this.selectedCaller.splice(index, 1);
                            this.selectedCallerName.splice(index, 1);
                        } else {
                            this.selectedCaller.push(i.id)
                            this.selectedCallerName.push(i)
                        }
                    },
                    checkInSelectedCaller(value) {
                        let index = this.selectedCaller.findIndex(item =>
                            item == value
                        );

                        if (index !== -1) {
                            return true;
                        }

                        return false;
                    },

                    /* filtered team */
                    topTenTeams() {
                        return this.teams.slice(0, 10);
                    },
                    get filteredTeams() {
                        if (this.searchTeam === "") {
                            return this.topTenTeams(); // Jika input kosong, tampilkan semua data
                        }

                        let filtered = this.teams.filter((item) =>
                            item.name
                            .toLowerCase()
                            .includes(this.searchTeam.toLowerCase())
                        );

                        return filtered;
                    },
                    addSelectedTeam(i) {
                        let index = this.selectedTeam.findIndex(item =>
                            item == i.id
                        );

                        if (index !== -1) {
                            this.selectedTeam.splice(index, 1);
                            this.selectedTeamName.splice(index, 1);
                        } else {
                            this.selectedTeam.push(i.id)
                            this.selectedTeamName.push(i)
                        }
                    },
                    checkInSelectedTeam(value) {
                        let index = this.selectedTeam.findIndex(item =>
                            item == value
                        );

                        if (index !== -1) {
                            return true;
                        }

                        return false;
                    },

                    /* filtered agents */
                    topTenAgents() {
                        return this.agents.slice(0, 10);
                    },
                    get filteredAgent() {
                        if (this.searchAgent === "") {
                            return this.topTenAgents(); // Jika input kosong, tampilkan semua data
                        }

                        let filtered = this.agents.filter((item) =>
                            item.name
                            .toLowerCase()
                            .includes(this.searchAgent.toLowerCase())
                        );

                        return filtered;
                    },
                    addSelectedAgent(i) {
                        let index = this.selectedAgent.findIndex(item =>
                            item == i.id
                        );

                        if (index !== -1) {
                            this.selectedAgent.splice(index, 1);
                            this.selectedAgentName.splice(index, 1);
                        } else {
                            this.selectedAgent.push(i.id)
                            this.selectedAgentName.push(i)
                        }
                    },
                    checkInSelectedAgent(value) {
                        let index = this.selectedAgent.findIndex(item =>
                            item == value
                        );

                        if (index !== -1) {
                            return true;
                        }

                        return false;
                    },

                    doFilter() {
                        // return;
                        console.log('do filter');
                        this.$refs.btnFilter.click();
                    },

                    gas() {
                        console.log('gass');
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

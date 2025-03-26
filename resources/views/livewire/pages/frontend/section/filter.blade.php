<div>
    <nav x-data="filter()" class="">
        <div class="min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-title">
            @if ($useArea)
                <div class="p-1 space-y-0.5">
                    <span class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                        Wilayah
                    </span>
                    {{-- kecamatan --}}
                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                        <div @click="area='regency';" id="hs-dropdown-regency"
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            :class="area == 'regency' ? 'bg-green-100' : ''" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>

                            Kabupaten
                        </div>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-regency">
                            <div class="p-1 space-y-1">
                                <div class="max-w-sm">
                                    <div class="relative">
                                        <input type="text" x-model="searchRegency"
                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Cari...">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                    <template x-for="item in filteredRegencies">
                                        <a @click="addSelectedRegency(item);doFilter()"
                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                            :class="checkInSelectedRegency(item.id) ? 'bg-green-100' : ''"
                                            href="#" x-text="item.name">
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- kecamatan --}}
                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                        <div @click="area='district';" id="hs-header-base-dropdown-sub"
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            :class="area == 'district' ? 'bg-green-100' : ''" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>

                            Kecamatan
                        </div>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-header-base-dropdown-sub">
                            <div class="p-1 space-y-1">
                                <div class="max-w-sm">
                                    <div class="relative">
                                        <input type="text" x-model="searchDistrict"
                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Cari...">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                    <template x-for="item in filteredDistricts">
                                        <a @click="addSelectedDistrict(item);doFilter()"
                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                            :class="checkInSelectedDistrict(item.id) ? 'bg-green-100' : ''"
                                            href="#" x-text="item.name">
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- desa --}}
                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">

                        <div @click="area='village';" id="hs-header-base-dropdown-sub-village"
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            :class="area == 'village' ? 'bg-green-100' : ''" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                            Desa
                        </div>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                            role="menu" aria-orientation="vertical"
                            aria-labelledby="hs-header-base-dropdown-sub-village">
                            <div class="p-1 space-y-1">
                                <div class="max-w-sm">
                                    <div class="relative">
                                        <input type="text" x-model="searchVillage"
                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Cari...">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                    <template x-for="item in filteredVillages">
                                        <div>
                                            <a @click="addSelectedVillage(item);doFilter()"
                                                class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                                :class="checkInSelectedVillage(item.id) ? 'bg-green-100' : ''"
                                                href="#" x-html="item.name +'<br>('+ item.district.name+')'">
                                            </a>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="p-1 space-y-0.5">
                <span class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                    Kategori
                </span>
                {{-- <div class="overflow-y-scroll max-h-32 space-y-0.5 "> --}}
                @if ($useActivityType)
                    {{-- jenis kegiatan --}}
                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                        <div id="hs-dropdown-activity-type"
                            class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            :class="selectedActivityTypeName.length > 0 ? 'bg-green-100' : ''" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>

                            Jenis Kegiatan
                        </div>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-activity-type">
                            <div class="p-1 space-y-1">
                                <div class="max-w-sm">
                                    <div class="relative">
                                        <input type="text" x-model="searchActivityType"
                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Cari...">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                    <template x-for="item in filteredActivityTypes">
                                        <a @click="addSelectedActivityType(item);doFilter()"
                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                            :class="checkInSelectedActivityType(item.id) ? 'bg-green-100' : ''"
                                            href="#" x-text="item.name">
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($useSeedType)
                    {{-- Jenis bibit --}}
                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                        <div id="hs-dropdown-seed-types"
                            class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            :class="selectedSeedTypeName.length > 0 ? 'bg-green-100' : ''" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>

                            Jenis Bibit
                        </div>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-seed-types">
                            <div class="p-1 space-y-1">
                                <div class="max-w-sm">
                                    <div class="relative">
                                        <input type="text" x-model="searchSeedType"
                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Cari...">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                    <template x-for="item in filteredSeedTypes">
                                        <a @click="addSelectedSeedType(item);doFilter()"
                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                            :class="checkInSelectedSeedType(item.id) ? 'bg-green-100' : ''"
                                            href="#" x-text="item.name">
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($useBudgetSource)
                    {{-- sumber dana --}}
                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                        <div id="hs-dropdown-budger-sources"
                            class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            :class="selectedBudgetSourceName.length > 0 ? 'bg-green-100' : ''" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>

                            Sumber Dana
                        </div>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-budger-sources">
                            <div class="p-1 space-y-1">
                                <div class="max-w-sm">
                                    <div class="relative">
                                        <input type="text" x-model="searchBudgetSource"
                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Cari...">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                    <template x-for="item in filteredBudgetSources">
                                        <a @click="addSelectedBudgetSource(item);doFilter()"
                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                            :class="checkInSelectedBudgetSource(item.id) ? 'bg-green-100' : ''"
                                            href="#" x-text="item.name">
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($useSeedSource)
                    {{-- sumber bibit --}}
                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                        <div id="hs-dropdown-seed-sources"
                            class="flex items-center cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            :class="selectedSeedSourceName.length > 0 ? 'bg-green-100' : ''" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>

                            Sumber Bibit
                        </div>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-seed-sources">
                            <div class="p-1 space-y-1">
                                <div class="max-w-sm">
                                    <div class="relative">
                                        <input type="text" x-model="searchSeedSource"
                                            class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Cari...">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                    <template x-for="item in filteredSeedSources">
                                        <a @click="addSelectedSeedSource(item);doFilter()"
                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                            :class="checkInSelectedSeedSource(item.id) ? 'bg-green-100' : ''"
                                            href="#" x-text="item.name">
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- </div> --}}
            </div>

            @if ($useDate)
                <div class="p-1 space-y-0.5">
                    <span
                        class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                        Tanggal
                    </span>
                    <div class="overflow-y-scroll max-h-screen space-y-0.5 ">
                        @if ($useDateToday)
                            <a @click="dateType == 'today' ? dateType = '' : dateType='today';doFilter()"
                                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                :class="dateType == 'today' ? 'bg-green-100' : ''" href="#">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>

                                Hari ini
                            </a>
                        @endif
                        @if ($useDateThisMonth)
                            <a @click="dateType == 'this-month' ? dateType = '' : dateType='this-month';doFilter()"
                                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                :class="dateType == 'this-month' ? 'bg-green-100' : ''" href="#">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>

                                Bulan ini
                            </a>
                        @endif
                        @if ($useDateOtherMonth)
                            {{-- bulan tertentu --}}
                            <div x-data="{ showOptionMonth: false }">
                                <a x-ref="btnOtherMonth" @click="showOptionMonth=!showOptionMonth;"
                                    class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                    :class="dateType == 'other-month' ? 'bg-green-100' : ''" href="#">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                    </svg>
                                    Bulan Tertentu
                                </a>
                                {{-- select bulan --}}
                                <div x-show='showOptionMonth' x-anchor.right-end="$refs.btnOtherMonth" x-cloak
                                    x-transition @click.away="showOptionMonth= !showOptionMonth"
                                    class="inline-flex z-10 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                    tabindex="-1">
                                    <div class="py-1 capitalize" role="none">
                                        <div class="block p-4 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                            id="menu-item-1">
                                            <x-label for=""
                                                class="text-xs font-medium text-gray-700 dark:text-gray-200">
                                                bulan
                                            </x-label>
                                            <select name='month' x-model="month"
                                                class="bg-gray-50 border px-4 capitalize border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                                required>
                                                <option value="" selected disabled>pilih bulan
                                                </option>
                                                @foreach (months() as $month)
                                                    <option value="{{ $month['value'] }}">
                                                        {{ $month['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-label for=""
                                                class="mt-4 text-xs text-gray-700 dark:text-gray-200">
                                                tahun
                                            </x-label>
                                            <x-input x-mask="9999" x-model="year" type="text"
                                                class="w-full py-2.5" name='year' placeholder="Tahun" required />
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
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                    </svg>
                                    Tahun Tertentu
                                </a>
                                {{-- select bulan --}}
                                <div x-show='showOptionYear' x-anchor.right-end="$refs.btnOtherYear" x-cloak
                                    x-transition @click.away="showOptionYear= !showOptionYear"
                                    class="inline-flex z-10 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                    tabindex="-1">
                                    <div class="py-1 capitalize" role="none">
                                        <div class="block p-4 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                            id="menu-item-1">
                                            <x-label for=""
                                                class="mt-4 text-xs text-gray-700 dark:text-gray-200">
                                                tahun
                                            </x-label>
                                            <x-input x-mask="9999" x-model="year" type="text"
                                                class="w-full py-2.5" name='year' placeholder="Tahun" required />
                                            <x-button class="w-full mt-3 text-sm"
                                                @click="dateType='other-year';doFilter()"><span
                                                    class="mx-auto">Simpan</span></x-button>
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
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                    </svg>
                                    Range tanggal
                                </a>
                                {{-- date range --}}
                                <div x-show='showOptionDaterange' x-anchor.right-start="$refs.btnDateRange" x-cloak
                                    x-transition @click.away="showOptionDaterange= !showOptionDaterange"
                                    class="inline-flex z-10 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                    tabindex="-1">
                                    <div class="py-1 capitalize" date-rangepicker role="none">
                                        <div class="block p-4 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                            id="menu-item-1">
                                            <x-label for=""
                                                class="text-xs mb-2 font-medium text-gray-700 dark:text-gray-200">
                                                Tanggal awalnya
                                            </x-label>
                                            <x-input class="w-full py-2 focus:border-green-500" x-model="dateStart"
                                                id="datepicker-range-start" name="start" type="date" />
                                            <x-label for=""
                                                class="mt-4 text-xs mb-2 text-gray-700 dark:text-gray-200">
                                                Tanggal akhir
                                            </x-label>
                                            <x-input class="w-full py-2 focus:border-green-500" x-model="dateEnd"
                                                id="datepicker-range-end" name="end" type="date" />

                                            <x-button class="w-full mt-3 text-sm"
                                                @click="dateType='date-range';doFilter()"><span
                                                    class="mx-auto">Simpan</span></x-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <button class="hidden" x-ref="btnFilter" @click.debounce.5000ms="gas()"></button>
        <button class="hidden" x-ref="btnGas"
            wire:click="$dispatchTo('{{ $table }}', 'filter', {
                        area,
                        search,
                        selectedDistrict,
                        selectedVillage,
                        selectedRegency,
                        selectedActivityType,
                        selectedSeedType,
                        selectedBudgetSource,
                        selectedSeedSource,
                        dateType,
                        month,
                        year,
                        dateStart,
                        dateEnd
                    })">
            {{-- @click="$wire.filter(area, search, positionType, selectedDistrict, selectedVillage, positionStatus, isParkir, isNullPerson, statusData)"></button> --}}

        </button>
    </nav>
    <script>
        function filter() {
            return {
                search: '',
                area: '',

                regencies: @js($regencies),
                districts: @js($districts),
                villages: @js($villages),
                activityTypes: @js($activityTypes),
                budgetSources: @js($budgetSources),
                seedSources: @js($seedSources),
                seedTypes: @js($seedTypes),

                searchRegency: '',
                searchDistrict: '',
                searchVillage: '',
                searchActivityType: '',
                searchSeedType: '',
                searchSeedSource: '',
                searchBudgetSource: '',

                selectedRegency: [],
                selectedRegencyName: [],
                selectedDistrict: [],
                selectedDistrictName: [],
                selectedVillage: [],
                selectedVillageName: [],
                selectedActivityType: [],
                selectedActivityTypeName: [],
                selectedSeedType: [],
                selectedSeedTypeName: [],
                selectedBudgetSource: [],
                selectedBudgetSourceName: [],
                selectedSeedSource: [],
                selectedSeedSourceName: [],

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

                /* filtered regency */
                get filteredRegencies() {
                    if (this.searchRegency === "") {
                        return this.regencies; // Jika input kosong, tampilkan semua data
                    }

                    let filtered = this.regencies.filter((item) =>
                        item.name
                        .toLowerCase()
                        .includes(this.searchRegency.toLowerCase())
                    );

                    return filtered;
                },
                addSelectedRegency(regency) {
                    /* hapus semua filter area */
                    this.selectedDistrict = [];
                    this.selectedVillage = [];
                    this.selectedDistrictName = [];
                    this.selectedVillageName = [];

                    let index = this.selectedRegency.findIndex(item =>
                        item == regency.id
                    );

                    if (index !== -1) {
                        this.selectedRegency.splice(index, 1);
                        this.selectedRegencyName.splice(index, 1);
                    } else {
                        this.selectedRegency.push(regency.id)
                        this.selectedRegencyName.push(regency)
                    }
                },
                checkInSelectedRegency(value) {
                    let index = this.selectedRegency.findIndex(item =>
                        item == value
                    );

                    if (index !== -1) {
                        return true;
                    }

                    return false;
                },

                /* filtered district */
                get filteredDistricts() {
                    if (this.searchDistrict === "") {
                        return this.districts; // Jika input kosong, tampilkan semua data
                    }

                    let filtered = this.districts.filter((item) =>
                        item.name
                        .toLowerCase()
                        .includes(this.searchDistrict.toLowerCase())
                    );

                    return filtered;
                },
                addSelectedDistrict(district) {
                    /* hapus data village */
                    this.selectedRegency = [];
                    this.selectedVillage = [];
                    this.selectedRegencyName = [];
                    this.selectedVillageName = [];

                    let index = this.selectedDistrict.findIndex(item =>
                        item == district.id
                    );

                    if (index !== -1) {
                        this.selectedDistrict.splice(index, 1);
                        this.selectedDistrictName.splice(index, 1);
                    } else {
                        this.selectedDistrict.push(district.id)
                        this.selectedDistrictName.push(district)
                    }
                    console.log(this.selectedDistrict);
                },
                checkInSelectedDistrict(value) {
                    let index = this.selectedDistrict.findIndex(item =>
                        item == value
                    );

                    if (index !== -1) {
                        return true;
                    }

                    return false;
                },

                /* filtered village */
                get filteredVillages() {
                    if (this.searchVillage === "") {
                        return this.villages; // Jika input kosong, tampilkan semua data
                    }

                    let filtered = this.villages.filter((item) =>
                        item.name
                        .toLowerCase()
                        .includes(this.searchVillage.toLowerCase())
                    );

                    return filtered;
                },
                addSelectedVillage(village) {
                    /* hapus data district */
                    this.selectedRegency = [];
                    this.selectedDistrict = [];
                    this.selectedRegencyName = [];
                    this.selectedDistrictName = [];

                    let index = this.selectedVillage.findIndex(item =>
                        item == village.id
                    );

                    if (index !== -1) {
                        this.selectedVillage.splice(index, 1);
                        this.selectedVillageName.splice(index, 1);
                    } else {
                        this.selectedVillage.push(village.id)
                        this.selectedVillageName.push(village)
                    }
                    console.log('index', this.selectedVillage)
                },
                checkInSelectedVillage(value) {
                    let index = this.selectedVillage.findIndex(item =>
                        item == value
                    );

                    if (index !== -1) {
                        return true;
                    }

                    return false;
                },

                /* filtered activity type */
                get filteredActivityTypes() {
                    if (this.searchActivityType === "") {
                        return this.activityTypes; // Jika input kosong, tampilkan semua data
                    }

                    let filtered = this.activityTypes.filter((item) =>
                        item.name
                        .toLowerCase()
                        .includes(this.searchActivityType.toLowerCase())
                    );

                    return filtered;
                },
                addSelectedActivityType(selectedActivity) {
                    let index = this.selectedActivityType.findIndex(item =>
                        item == selectedActivity.id
                    );

                    if (index !== -1) {
                        this.selectedActivityType.splice(index, 1);
                        this.selectedActivityTypeName.splice(index, 1);
                    } else {
                        this.selectedActivityType.push(selectedActivity.id)
                        this.selectedActivityTypeName.push(selectedActivity)
                    }
                },
                checkInSelectedActivityType(value) {
                    let index = this.selectedActivityType.findIndex(item =>
                        item == value
                    );

                    if (index !== -1) {
                        return true;
                    }

                    return false;
                },

                /* filtered seed type */
                get filteredSeedTypes() {
                    if (this.searchSeedType === "") {
                        return this.seedTypes; // Jika input kosong, tampilkan semua data
                    }

                    let filtered = this.seedTypes.filter((item) =>
                        item.name
                        .toLowerCase()
                        .includes(this.searchSeedType.toLowerCase())
                    );

                    return filtered;
                },
                addSelectedSeedType(selectedSeedType) {
                    let index = this.selectedSeedType.findIndex(item =>
                        item == selectedSeedType.id
                    );

                    if (index !== -1) {
                        this.selectedSeedType.splice(index, 1);
                        this.selectedSeedTypeName.splice(index, 1);
                    } else {
                        this.selectedSeedType.push(selectedSeedType.id)
                        this.selectedSeedTypeName.push(selectedSeedType)
                    }
                },
                checkInSelectedSeedType(value) {
                    let index = this.selectedSeedType.findIndex(item =>
                        item == value
                    );

                    if (index !== -1) {
                        return true;
                    }

                    return false;
                },

                /* filtered budget source */
                get filteredBudgetSources() {
                    if (this.searchSeedType === "") {
                        return this.budgetSources; // Jika input kosong, tampilkan semua data
                    }

                    let filtered = this.budgetSources.filter((item) =>
                        item.name
                        .toLowerCase()
                        .includes(this.searchSeedType.toLowerCase())
                    );

                    return filtered;
                },
                addSelectedBudgetSource(selectedBudgetSource) {
                    let index = this.selectedBudgetSource.findIndex(item =>
                        item == selectedBudgetSource.id
                    );

                    if (index !== -1) {
                        this.selectedBudgetSource.splice(index, 1);
                        this.selectedBudgetSourceName.splice(index, 1);
                    } else {
                        this.selectedBudgetSource.push(selectedBudgetSource.id)
                        this.selectedBudgetSourceName.push(selectedBudgetSource)
                    }
                },
                checkInSelectedBudgetSource(value) {
                    let index = this.selectedBudgetSource.findIndex(item =>
                        item == value
                    );

                    if (index !== -1) {
                        return true;
                    }

                    return false;
                },

                /* filtered seed source */
                get filteredSeedSources() {
                    if (this.searchSeedType === "") {
                        return this.seedSources; // Jika input kosong, tampilkan semua data
                    }

                    let filtered = this.seedSources.filter((item) =>
                        item.name
                        .toLowerCase()
                        .includes(this.searchSeedType.toLowerCase())
                    );

                    return filtered;
                },
                addSelectedSeedSource(selectedSeedSource) {
                    let index = this.selectedSeedSource.findIndex(item =>
                        item == selectedSeedSource.id
                    );

                    if (index !== -1) {
                        this.selectedSeedSource.splice(index, 1);
                        this.selectedSeedSourceName.splice(index, 1);
                    } else {
                        this.selectedSeedSource.push(selectedSeedSource.id)
                        this.selectedSeedSourceName.push(selectedSeedSource)
                    }
                },
                checkInSelectedSeedSource(value) {
                    let index = this.selectedSeedSource.findIndex(item =>
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

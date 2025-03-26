<div>
    {{-- In work, do what you enjoy. --}}
    <div x-data="filter()" class="flex flex-wrap items-center space-x-1 mb-5">
        <div class="relative flex items-center space-x-1">
            <div class="hs-dropdown relative inline-flex [--auto-close:inside]">
                <button id="hs-dropdown-with-title" type="button"
                    class="hs-dropdown-toggle py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-md border border-gray-300 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Filter
                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-title">

                    <div class="p-1 space-y-0.5">
                        <span
                            class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                            Periode
                        </span>
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

                        <a @click="dateType == 'other-month' ? dateType = '' : dateType='other-month';showSelectMonth=true;"
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                            :class="dateType == 'other-month' ? 'bg-green-100' : ''" href="#">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            Bulan Tertentu
                        </a>
                    </div>
                </div>

                {{-- select bulan --}}
                <div x-show='showSelectMonth' x-cloak x-transition @click.away="showSelectMonth=false"
                    class="absolute inline-flex z-10 w-48 mt-48 ml-40 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1 capitalize" role="none">
                        <div class="block p-4 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-1">
                            <x-label for="" class="text-xs font-medium text-gray-700 dark:text-gray-200">
                                bulan
                            </x-label>
                            <select name='month' x-model="month"
                                class="bg-gray-50 border px-4 capitalize border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="" selected disabled>pilih bulan</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month['value'] }}">{{ $month['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <x-label for="" class="mt-4 text-xs text-gray-700 dark:text-gray-200">
                                tahun
                            </x-label>
                            <x-input x-mask="9999" x-model="year" type="text" class="w-full py-2.5" name='year'
                                placeholder="Tahun" required />
                            <x-button class="w-full mt-3 text-sm" @click="doFilter()"><span
                                    class="mx-auto">Simpan</span></x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex items-center space-x-1">
            <div wire:loading class="-mt-6">
                @livewire('utils.loading', key(\Illuminate\Support\Str::random(10)))
            </div>
        </div>
        <div class="flex-grow">
        </div>
        <div class="flex flex-wrap items-center content-center space-x-1">
            {{-- <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Button text</button> --}}
            <div class="relative flex items-center">
                @can('laporan.opname.barang.view')
                    <button wire:click="export"
                        class="flex items-center rounded-md bg-white  py-2.5 px-4 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <x-bytesize-download class="h-5 w-5 mr-2" />
                        Unduh Laporan
                    </button>
                @endcan
            </div>
        </div>
        <div class="relative flex items-center space-x-1">
            <button class="hidden" x-ref="btnFilter"
                @click="$wire.filter(status, dateType, search, month, year)"></button>
        </div>
    </div>

    <script>
        function filter() {
            return {
                status: [],
                dateType: '',
                search: '',
                showSelectMonth: false,
                month: '',
                year: '',
                init() {},

                filterStatus(value) {
                    let index = this.status.findIndex(item =>
                        item == value
                    );

                    console.log(index);

                    if (index !== -1) {
                        this.status.splice(index, 1);
                    } else {
                        this.status.push(value)
                    }

                    console.log(this.status);
                },

                checkInStatus(value) {
                    let index = this.status.findIndex(item =>
                        item == value
                    );

                    if (index !== -1) {
                        return true;
                    }

                    return false;
                },

                doFilter() {
                    this.$refs.btnFilter.click();
                }
            };
        }
    </script>

    <script>
        window.HSStaticMethods.autoInit();
    </script>
</div>

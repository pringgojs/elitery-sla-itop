<div>
    <div x-cloak x-data="{ kecamatan: '', desa: '', jenisPerangkat: '', statusData: '', search: '', isDropdownOpen: '' }" class="flex flex-wrap items-center space-x-1 mb-5">
        @if (!$isOperator)
            <!-- Filter Kecamatan -->
            <div class="relative flex items-center space-x-1">
                <button title="Kecamatan" @click="isDropdownOpen = isDropdownOpen === 'kecamatan' ? '' : 'kecamatan'"
                    class="flex items-center  text-gray-700 text-sm px-2 py-1 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
                    :class="kecamatan ? 'bg-gray-200 text-sm font-semibold leading-6 text-gray-900' : 'bg-white'">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>

                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg> --}}
                    <span x-text="kecamatan || ''"></span>
                </button>
                <div x-show="isDropdownOpen === 'kecamatan'" @click.outside="isDropdownOpen = ''"
                    class="absolute z-10 mt-2 w-40 max-h-56 overflow-y-scroll overflow-x-hidden bg-white shadow-lg rounded-md ">
                    <ul class="text-sm">
                        @foreach ($districts as $item)
                            <li @click="kecamatan = '{{ $item->name }}'; isDropdownOpen = ''; $wire.getVillages('{{ $item->id }}')"
                                class="px-4 py-2 hover:bg-gray-200 cursor-pointer">{{ $item->name }}</li>
                        @endforeach
                        {{-- <li @click="kecamatan = 'Kecamatan B'; isDropdownOpen = ''"
                        class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Kecamatan B</li>
                    <li @click="kecamatan = 'Kecamatan C'; isDropdownOpen = ''"
                        class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Kecamatan C</li> --}}
                    </ul>
                </div>
            </div>

            <span class="text-gray-300">|</span> <!-- Garis pemisah sederhana -->

            <!-- Filter Desa -->
            <div class="relative flex items-center space-x-1">
                <button title="Desa" @click="isDropdownOpen = isDropdownOpen === 'desa' ? '' : 'desa'"
                    class="flex items-center text-gray-700 text-sm px-2 py-1 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
                    :class="desa ? 'bg-gray-200 text-sm font-semibold leading-6 text-gray-900' : 'bg-white'">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>

                    <span x-text="desa || ''"></span>
                </button>
                <div x-show="isDropdownOpen === 'desa'" @click.outside="isDropdownOpen = ''"
                    class="absolute z-10 mt-2 w-40 max-h-56 overflow-y-scroll overflow-x-hidden bg-white shadow-lg rounded-md">
                    <ul class="text-sm">
                        @foreach ($villages as $item)
                            <li @click="desa = '{{ $item->name }}'; isDropdownOpen = ''; $wire.setVillageId('{{ $item->id }}')"
                                class="px-4 py-2 hover:bg-gray-200 cursor-pointer">{{ $item->name }}</li>
                        @endforeach
                        {{-- <li @click="desa = 'Desa B'; isDropdownOpen = ''"
                        class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Desa B</li>
                    <li @click="desa = 'Desa C'; isDropdownOpen = ''"
                        class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Desa C</li> --}}
                    </ul>
                </div>
            </div>

            <span class="text-gray-300">|</span>
        @endif
        <!-- Filter Jenis Perangkat -->
        <div class="relative flex items-center space-x-1">
            <button title="Jenis Perangkat"
                @click="isDropdownOpen = isDropdownOpen === 'jenisPerangkat' ? '' : 'jenisPerangkat'"
                class="flex items-center text-gray-700 text-sm px-2 py-1 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
                :class="jenisPerangkat ? 'bg-gray-200 text-sm font-semibold leading-6 text-gray-900' : 'bg-white'">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg> --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
                </svg>

                <span x-text="jenisPerangkat || ''"></span>
            </button>
            <div x-show="isDropdownOpen === 'jenisPerangkat'" @click.outside="isDropdownOpen = ''"
                class="absolute z-10 mt-2 w-40 bg-white shadow-lg rounded-md">
                <ul class="text-sm">
                    @foreach ($position_types as $item)
                        <li @click="jenisPerangkat = '{{ $item->name }}'; isDropdownOpen = ''; $wire.setPositionTypeId('{{ $item->id }}')"
                            class="px-4 py-2 hover:bg-gray-200 cursor-pointer">{{ $item->name }}</li>
                    @endforeach
                    {{-- <li @click="jenisPerangkat = 'Perangkat B'; isDropdownOpen = ''"
                        class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Perangkat B</li>
                    <li @click="jenisPerangkat = 'Perangkat C'; isDropdownOpen = ''"
                        class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Perangkat C</li> --}}
                </ul>
            </div>
        </div>

        <span class="text-gray-300">|</span>

        <!-- Filter Status Data -->
        <div class="relative flex items-center space-x-1">
            <button title="Status Data" @click="isDropdownOpen = isDropdownOpen === 'statusData' ? '' : 'statusData'"
                class="flex items-center text-gray-700 text-sm px-2 py-1 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
                :class="statusData ? 'bg-gray-200 text-sm font-semibold leading-6 text-gray-900' : 'bg-white'">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg> --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>

                <span x-text="statusData || ''"></span>
            </button>
            <div x-show="isDropdownOpen === 'statusData'" @click.outside="isDropdownOpen = ''"
                class="absolute z-10 mt-2 w-40 bg-white shadow-lg rounded-md">
                <ul class="text-sm">
                    @foreach ($status_data as $item)
                        <li @click="statusData = '{{ $item->name }}'; isDropdownOpen = ''; $wire.setStatusDataId('{{ $item->id }}')"
                            class="px-4 py-2 hover:bg-gray-200 cursor-pointer">{{ $item->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <span class="text-gray-300">|</span>

        <!-- Kolom Pencarian -->
        <div class="flex-grow">
            <div class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-bi-search class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                    </div>
                    <input x-model="search" type="text" placeholder="Cari..." wire:model="search"
                        wire:change="filter"
                        class="bg-white text-sm px-10 py-1 border-none border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-200 focus:bg-gray-200 hover:bg-gray-200 w-full md:w-auto">
                    {{-- <input type="text" wire:model.live="search" id="simple-search"
                        class="bg-white w-full md:w-auto px-2 py-1 border-none text-sm rounded focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cari ... " required> --}}
                </div>
            </div>
            {{-- <input x-model="search" type="text" placeholder="Cari..."
                class="bg-white text-sm px-2 py-1 border-none border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:bg-gray-200 hover:bg-gray-200 w-full md:w-auto"> --}}
        </div>

        <!-- Tombol Export -->
        <div class="flex flex-wrap items-center content-center space-x-1 mb-5 mt-2">
            {{-- <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Button text</button> --}}
            <div class="relative flex items-center">
                <button wire:click="export"
                    class="flex items-center rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <x-bytesize-download class="h-5 w-5 mr-2" />
                    Unduh data Excel
                </button>
            </div>
            <div wire:loading class="relative flex items-center -mt-6">
                @livewire('utils.loading', key(\Illuminate\Support\Str::random(10)))

            </div>
        </div>
    </div>

</div>

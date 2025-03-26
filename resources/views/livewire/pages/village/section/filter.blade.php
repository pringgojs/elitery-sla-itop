<div>
    <div x-cloak x-data="{ kecamatan: '', desa: '', jenisPerangkat: '', villageType: '', search: '', isDropdownOpen: '' }" class="flex flex-wrap items-center space-x-1 mb-5">
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
                        <li @click="kecamatan = '{{ $item->name }}'; isDropdownOpen = ''; $wire.setDistrict('{{ $item->id }}')"
                            class="px-4 py-2 hover:bg-gray-200 cursor-pointer">{{ $item->name }}</li>
                    @endforeach
                    {{-- <li @click="kecamatan = 'Kecamatan B'; isDropdownOpen = ''"
                        class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Kecamatan B</li>
                    <li @click="kecamatan = 'Kecamatan C'; isDropdownOpen = ''"
                        class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Kecamatan C</li> --}}
                </ul>
            </div>
        </div>
        <span class="text-gray-300">|</span>

        <!-- Filter Status Data -->
        <div class="relative flex items-center space-x-1">
            <button title="Jenis Desa" @click="isDropdownOpen = isDropdownOpen === 'villageType' ? '' : 'villageType'"
                class="flex items-center text-gray-700 text-sm px-2 py-1 rounded-md hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
                :class="villageType ? 'bg-gray-200 text-sm font-semibold leading-6 text-gray-900' : 'bg-white'">
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

                <span x-text="villageType || ''"></span>
            </button>
            <div x-show="isDropdownOpen === 'villageType'" @click.outside="isDropdownOpen = ''"
                class="absolute z-10 mt-2 w-40 bg-white shadow-lg rounded-md">
                <ul class="text-sm">
                    @foreach ($village_types as $item)
                        <li @click="villageType = '{{ $item->name }}'; isDropdownOpen = ''; $wire.setType('{{ $item->id }}')"
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

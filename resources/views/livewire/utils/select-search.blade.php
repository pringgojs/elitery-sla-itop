<div>
    <div x-data="{
        search: @entangle('search'),
        value: @entangle('value'),
        options: @js($options),
        filteredOptions: [],
        isReadonly: @entangle('isReadonly'),
        isDropdownVisible: false,
    
        // Inisialisasi dan filterisasi
        init() {
            this.filteredOptions = this.options;
        },
    
        // Fungsi untuk memfilter options berdasarkan pencarian
        filterOptions() {
            this.filteredOptions = this.options.filter(option =>
                option.name.toLowerCase().includes(this.search.toLowerCase())
            );
        },
        onSelected(v) {
            console.log(v);
            this.$dispatch('{{ $callback }}', v);
        }
    }" x-init="search = value;
    filterOptions()" class="relative" @click.away="isDropdownVisible = false"
        @reset-value.window="value = '';search='';console.log('sampai sini gak')">
        <!-- Kotak Pencarian -->
        <input type="text" x-model="search" :readonly="isReadonly ? true : false" @focus="isDropdownVisible = true"
            @input="filterOptions()" @change="value = search"
            class="bg-white border  pe-11 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
            placeholder="Cari..." />

        <!-- Dropdown List -->
        <div class="absolute z-20 top-full left-0 w-full mt-1 pb-1 bg-white border border-gray-300 rounded-md shadow-lg text-sm"
            x-show="isDropdownVisible" x-cloak style="display: none;">
            <ul class="overflow-y-scroll max-h-48 space-y-0.5">
                <template x-for="option in filteredOptions" :key="option.id">
                    <li @click="search = option.name; value = option.id; isDropdownVisible = false;onSelected(option.id)"
                        class="p-2 md:px-3 cursor-pointer hover:bg-gray-100" x-text="option.name"></li>
                </template>

                <template x-if="filteredOptions.length === 0">
                    <li class="p-2 md:px-3  text-gray-500">Tidak ada hasil ditemukan</li>
                </template>
            </ul>
        </div>
    </div>

</div>

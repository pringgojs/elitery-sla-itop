<div>
    <!-- Card Section -->
    <div x-data="{
        listSeeds: @js($this->getSeeds),
        error: false,
        seedId: '',
        amount: '',
        store() {
            if (!this.seedId) return;
    
            if (!this.checkIfExist()) {
                let seed = this.getSeedById();
                $store.form.seeds.push({ 'id': this.seedId, 'name': seed.name, 'amount': this.amount });
                console.log($store.form.seeds);
                this.resetForm();
                return;
            }
    
            this.error = true;
        },
        checkIfExist() {
            let index = $store.form.seeds.findIndex(item =>
                item.id === this.seedId
            );
    
            console.log(index);
            return index !== -1 ? true : false;
        },
        getSeedById() {
            let index = this.listSeeds.findIndex(item => item.id === this.seedId);
            if (index !== -1) {
                return this.listSeeds[index];
            }
        },
        resetForm() {
            this.seedId = '';
            this.amount = '';
        },
        remove(id) {
            let index = $store.form.seeds.findIndex(item =>
                item.id === id
            );
    
            if (index !== -1) {
                $store.form.seeds.splice(index, 1)
            }
        }
    }" class="max-w-4xl mx-auto"><!-- Card -->
        <div class="bg-white rounded-xl p-4 sm:p-7 dark:bg-neutral-800">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                    Data Bibit
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Lengkapi semua kolom dibawah ini.
                </p>
            </div>
            <form>
                <div class="grid gap-6 mb-6 md:grid-cols-5">
                    <div class="col-span-2">
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                            Bibit</label>
                        <div @on-item-selected="seedId = $event.detail;">
                            <livewire:utils.select-search callback="on-item-selected" value=""
                                :options="$this->getSeeds()" />
                        </div>
                        <span class="text-red-500" x-show="error">jenis bibit ini sudah ada di daftar.</span>

                        {{-- <input type="text" id="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="John" required /> --}}
                    </div>
                    <div class="col-span-2">
                        <label for=""
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                        <div class="relative">
                            <input x-model="amount" x-mask:dynamic="$money($input, ',')" type="text"
                                id="hs-input-with-leading-and-trailing-icon"
                                name="hs-input-with-leading-and-trailing-icon"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="0.00">
                            <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                <span class="text-gray-500 dark:text-neutral-500">bibit</span>
                            </div>
                        </div>
                        {{-- <input type="number" id="" x-model="amount"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="" required /> --}}
                    </div>
                    <div>
                        <button :disabled="seedId && amount ? false : true" @click="store();$dispatch('reset-value')"
                            type="button"
                            class="py-2.5 px-4 mt-7 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                            Simpan Bibit
                        </button>
                    </div>
                </div>
            </form>
            <template x-if="$store.form.isSubmit && $store.form.seeds.length == 0">
                <span class="text-red-500 text-sm">Data bibit harus diisi setidaknya 1 jenis</span>
            </template>
            <div x-show="$store.form.seeds.length > 0" class="bg-gray-50 p-4 shadow rounded-lg">
                <ul role="list" class="divide-y divide-gray-100">
                    <template x-for="i in $store.form.seeds">
                        <li class="flex items-center justify-between gap-x-6 py-5">
                            <div class="min-w-0">
                                <div class="flex gap-x-4">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">
                                            <a href="#" class="" x-html="i.name"></a>
                                        </p>
                                        <p class="flex text-xs font-semibold leading-5 text-gray-500">
                                            <a class="truncate" x-html="i.amount +' bibit'"></a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-none items-center gap-x-2">
                                <a @click="remove(i.id)"
                                    class="inline-flex rounded-lg p-2 bg-red-50 text-red-700  cursor-pointer">
                                    <x-heroicon-o-trash class="h-5 w-5" />
                                </a>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>

    </div>
    <!-- End Card -->
</div>

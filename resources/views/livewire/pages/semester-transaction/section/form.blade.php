<div>
    {{-- Stop trying to control. --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <div class="grid items-start grid-cols-3 py-4 gap-4" x-data="liveSearch()">
        <div class="col-span-2 bg-white shadow px-5 py-5">
            <div class="relative items-center">
                <div class="grid items-start grid-cols-2 py-4 gap-4 border-b border-gray-100">
                    <div class="font-bold text-lg">Data Barang</div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-bi-search class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                        </div>
                        <input type="text" id="simple-search" x-model="searchTerm"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Cari berdasarkan nama barang ... " required>
                    </div>
                </div>
                <ul class="grid w-full gap-6 pb-4 mt-5 select-none md:grid-cols-2">
                    <template x-for="good in paginatedData">
                        <li class="flex" x-data="{ goodCountInit: 0, price: 0, operator: '+' }">
                            <div :id="$id('btn-add')"
                                @click="
                            goodCountInit++;
                            operator='+';
                            updateFilteredData(good,operator);
                            dataArray=updateDetail(good,dataArray,operator);
                            "
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-green-200 rounded-tl-lg rounded-bl-lg cursor-pointer dark:hover:text-gray-300 dark:border-green-700 dark:peer-checked:text-green-500 peer-checked:border-green-600 peer-checked:text-green-600 hover:text-gray-600 hover:bg-green-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-green-700">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold capitalize" x-text="good.name">
                                    </div>
                                    <div class="w-full" x-text="good.isNew ? '-' : good.code"></div>
                                    <div class="font-bold"
                                        x-text="good.isNew ? '('+good.unit+')': '('+good.unit.name+')'"></div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-xl font-semibold" x-text="good.total ?? 0"></span>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="text-green-400 w-7 h-7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                    </svg> --}}
                                </div>
                            </div>
                            <button :id="$id('btn-add')" type="button"
                                @click="goodCountInit--;operator='-';updateFilteredData(good,operator);dataArray=updateDetail(good,dataArray,operator);"
                                class="flex items-center justify-center px-6 transition duration-200 bg-green-100 rounded-tr-lg rounded-br-lg cursor-pointer hover:bg-green-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6">
                                    <path fill-rule="evenodd"
                                        d="M3.75 12a.75.75 0 01.75-.75h15a.75.75 0 010 1.5h-15a.75.75 0 01-.75-.75z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </li>
                    </template>
                </ul>
            </div>

            <nav x-show="paginatedData.length > 0"
                class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                aria-label="Pagination">
                <div class="hidden sm:block">
                    <p class="text-sm text-gray-700">
                        Page
                        <span class="font-medium" x-text="currentPage"></span>
                        of
                        <span class="font-medium" x-text="totalPages"></span>
                    </p>
                </div>
                <div class="flex flex-1 justify-between sm:justify-end">
                    <a @click="prevPage" :disabled="currentPage === 1"
                        class="relative cursor-pointer inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Previous</a>
                    <a @click="nextPage" :disabled="currentPage === totalPages"
                        class="relative cursor-pointer ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</a>
                </div>
            </nav>

            <div x-cloak x-show="paginatedData.length == 0" class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>

                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Tidak ada data yang bisa ditampilkan.
                            <a onclick="document.getElementById('modalForm')._x_dataStack[0].show = true"
                                class="font-medium text-yellow-700 underline cursor-pointer hover:text-yellow-600">Silahkan
                                tambahkan data baru atau cari data lain.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div>
                <div class="relative shadow mb-4">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>

                    </div>
                    <input type="text" datepicker value="{{ $dateRequired }}" x-ref="datepicker"
                        id="default-datepicker"
                        class="block w-full border-0 py-2.5 pl-10 text-gray-900 font-bold ring-1 ring-inset ring-white placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-white sm:text-sm sm:leading-6"
                        placeholder="Tanggal dibutuhkan">
                </div>
            </div>
            <div class="p-4 bg-white border border-gray-200 shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-md font-bold leading-none text-gray-900 dark:text-white">RINCIAN BARANG</h5>
                    <a href="#" class="text-sm font-medium text-green-600 hover:underline dark:text-green-500">
                        {{-- View all --}}
                    </a>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <template x-for="item in dataArray">
                            <li class="py-3 cursor-pointer sm:py-4">
                                <div class="flex items-center">
                                    <div class="flex-1 min-w-0">
                                        <p @click="searchTerm=item.name"
                                            class="text-sm font-medium text-gray-900 truncate dark:text-white"
                                            x-text="item.name">
                                        </p>
                                        <p @click="searchTerm=item.name"
                                            class="text-sm text-gray-500 truncate dark:text-gray-400"
                                            x-text="item.isNew ? '-': item.code">
                                        </p>
                                        <div>
                                            {{-- <label for="price"
                                                class="block text-sm font-medium leading-6 text-gray-900">Estimasi
                                                harga</label> --}}
                                            <div class="relative mt-2 rounded-md shadow-sm">
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                                </div>
                                                <input x-mask:dynamic="$money($input, ',')"
                                                    x-model="item.price_estimate" type="text"
                                                    class="block w-full rounded-md border-0 py-1.5 pl-9 pr-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                                                    placeholder="Estimasi harga" aria-describedby="price-currency">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                                        x-text="item.isNew ? item.total +' '+ item.unit : item.total +' '+ item.unit.name">
                                    </div>
                                </div>
                            </li>
                        </template>
                        <template x-if="dataArray.length > 0">
                            <li>
                                <button wire:click="store(dataArray, $refs.datepicker.value)"
                                    class="flex-initial w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Proses Data
                                </button>
                            </li>

                        </template>
                    </ul>
                </div>
            </div>
        </div>

        {{-- modal form --}}
        <x-modal id="modalForm" maxWidth="md" wire:model="modalForm">
            <!-- Card Section -->
            {{-- <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto"><!-- Card --> --}}
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-800">
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Form Tambah Barang
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Lengkapi semua inputan.
                    </p>
                </div>

                <form>
                    <!-- Grid -->
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">


                        <div class="sm:col-span-3">
                            <label for="af-account-email"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Nama Barang
                            </label>
                        </div>
                        <div class="sm:col-span-9">
                            <input x-model="newItem.name" type="text"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Misal. Penggaris 30cm">
                        </div>
                        <!-- End Col -->
                        <div class="sm:col-span-3">
                            <label class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Spesifikasi
                            </label>
                        </div>
                        <div class="sm:col-span-9">
                            <textarea x-model="newItem.specification"
                                class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                rows="6" placeholder="Misal. bahan mika, ukuran panjang 30cm"></textarea>
                        </div>

                        <div class="sm:col-span-3">
                            <label for=""
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Jumlah dan Satuan
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input x-model="newItem.total" type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Misal. 300">
                                <input x-model="newItem.unit" type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Misal. Unit">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="af-account-email"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Estimasi Harga
                            </label>
                        </div>
                        <div class="sm:col-span-9">
                            {{-- <input x-mask:dynamic="$money($input)" type="text"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder=""> --}}
                            <div class="relative">
                                <input x-model="newItem.price_estimate" type="text"
                                    x-mask:dynamic="$money($input, ',')"
                                    class="peer py-2 px-4 ps-11 block w-full  border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="">
                                <div
                                    class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                    <span class="text-gray-500">Rp.</span>
                                    {{-- <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Grid -->

                    <div class="mt-5 flex justify-end gap-x-2">
                        <button @click="document.getElementById('modalForm')._x_dataStack[0].show = false"
                            type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                            Batal
                        </button>
                        <button @click="addNewItem" type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
            <!-- End Card -->
            {{-- </div> --}}
            <!-- End Card Section -->
        </x-modal>
    </div>

    <script>
        function updateDetail(searchObj, dataArray, operator) {
            // Cari indeks objek yang cocok
            let index = dataArray.findIndex(item =>
                item.code === searchObj.code && item.name === searchObj.name
            );

            // Jika objek ditemukan (indeks tidak -1), hapus objek tersebut
            let lastQty = 0;
            if (index !== -1) {
                lastQty = dataArray[index].total;
                dataArray.splice(index, 1);
            }

            // searchObj.total = operator == '+' ? lastQty + 1 : lastQty - 1;
            if (searchObj.total) {
                dataArray.push(searchObj);
            }

            return dataArray;
        }

        function liveSearch() {
            return {
                newItem: {
                    isNew: true,
                    name: '',
                    specification: '',
                    unit: '',
                    code: '',
                    total: 0,
                }, // untuk data barang baru
                dateEstimate: '',
                disabledButton: true,
                loadingState: false,
                goods: @js($goods),
                totalItem: 0,
                dataArray: @js($dataArray),
                searchTerm: "", // Variabel pencarian
                data: @js($goods), // Data JSON statis
                perPage: 12, // Jumlah item per halaman
                currentPage: 1,

                // Reset halaman ke 1 saat pencarian berubah
                init() {
                    this.$watch("searchTerm", () => {
                        this.currentPage = 1;
                    });
                },

                // Filter data berdasarkan searchTerm
                get filteredData() {
                    if (this.searchTerm === "") {
                        return this.data; // Jika input kosong, tampilkan semua data
                    }

                    let filtered = this.data.filter((item) =>
                        item.name
                        .toLowerCase()
                        .includes(this.searchTerm.toLowerCase())
                    );

                    console.log(this.dataArray);

                    return filtered;
                },

                // Data yang akan ditampilkan berdasarkan pagination
                get paginatedData() {
                    const start = (this.currentPage - 1) * this.perPage;
                    const end = this.currentPage * this.perPage;
                    return this.filteredData.slice(start, end);
                },

                // Total halaman
                get totalPages() {
                    return Math.ceil(
                        this.filteredData.length / this.perPage
                    );
                },

                // Navigasi ke halaman sebelumnya
                prevPage() {
                    if (this.currentPage > 1) {
                        this.currentPage--;
                    }
                },

                // Navigasi ke halaman berikutnya
                nextPage() {
                    if (this.currentPage < this.totalPages) {
                        this.currentPage++;
                    }
                },

                // update filtered data
                updateFilteredData(goods, operator) {
                    let index = this.filteredData.findIndex(item =>
                        item.code === goods.code && item.name === goods.name
                    );

                    // Jika objek ditemukan (indeks tidak -1), hapus objek tersebut
                    if (index !== -1) {
                        console.log('data ditemukan');
                        // console.log('datanya:', this.filteredData[index].name);
                        let total = this.filteredData[index].total ?? 0;

                        if (operator == '+') {
                            total++;
                        } else {
                            if (total) {
                                total--;
                            }
                        }

                        this.filteredData[index].total = total;
                    }
                },

                // add new good
                addNewItem() {
                    console.log('newItem', this.newItem)
                    this.dataArray.push(this.newItem);
                    this.data.push(this.newItem);
                    this.newItemReset();
                    document.getElementById('modalForm')._x_dataStack[0].show = false
                },

                newItemReset() {
                    this.newItem = {
                        isNew: true,
                        name: '',
                        specification: '',
                        unit: '',
                        code: '',
                        total: 0,
                    }
                }
            };
        }
    </script>
</div>

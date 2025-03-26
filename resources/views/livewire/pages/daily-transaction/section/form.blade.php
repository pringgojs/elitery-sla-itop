<div>
    {{-- Stop trying to control. --}}
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-blue-200 rounded-tl-lg rounded-bl-lg cursor-pointer dark:hover:text-gray-300 dark:border-blue-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-blue-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-blue-700">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold capitalize" x-text="good.name">
                                    </div>
                                    <div class="w-full" x-text="good.code"></div>
                                    <div class="font-bold" x-text="'('+good.unit.name+')'"></div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-xl font-semibold" x-text="good.total ?? 0"></span>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="text-blue-400 w-7 h-7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                    </svg> --}}
                                </div>
                            </div>
                            <button :id="$id('btn-add')" type="button"
                                @click="goodCountInit--;operator='-';updateFilteredData(good,operator);dataArray=updateDetail(good,dataArray,operator);"
                                class="flex items-center justify-center px-6 transition duration-200 bg-blue-100 rounded-tr-lg rounded-br-lg cursor-pointer hover:bg-blue-300">
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

            <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
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
        </div>


        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Rincian Barang</h5>
                <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                    {{-- View all --}}
                </a>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <template x-for="item in dataArray">
                        <li class="py-3 cursor-pointer sm:py-4" @click="searchTerm=item.name">
                            <div class="flex items-center">
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white"
                                        x-text="item.name">
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400" x-text="item.code">
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                                    x-text="item.total +' '+ item.unit.name">
                                </div>
                            </div>
                        </li>
                    </template>
                    <template x-if="dataArray.length > 0">
                        <li>
                            <button wire:click="store(dataArray)"
                                class="flex-initial w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Proses Data
                            </button>
                        </li>

                    </template>
                </ul>
            </div>
        </div>
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
                }
            };
        }
    </script>
</div>

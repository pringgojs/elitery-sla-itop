<div>
    <!-- Card Section -->
    <div class="max-w-4xl  mx-auto"><!-- Card -->
        <div class=" bg-gray-50  rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-800">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                    Data Kelompok
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Lengkapi semua kolom dibawah ini.
                </p>
            </div>

            <form x-data="{ form: $store.form }">
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                    <div class="sm:col-span-3">
                        <label for="" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Tanggal Kegiatan
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <input x-model="$store.form.dateTime" type="date"
                                class=" border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="">
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.dateTime">
                            <span class="text-red-500 text-sm">Tanggal
                                kegiatan harus diisi</span>
                        </template>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Jenis Kegiatan Tanam
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">

                            <select id="roles" x-model="$store.form.activityTypeId"
                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected>pilih jenis kegiatan</option>
                                @foreach ($activityTypes as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.activityTypeId">
                            <span class="text-red-500 text-sm">Jenis
                                kegiatan harus diisi</span>
                        </template>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Pelaksana Kegiatan (Nama Dinas/Instansi)
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <input x-model="$store.form.activityOrganizer" type="text"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="">

                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.activityOrganizer">
                            <span class="text-red-500 text-sm">Pelaksana
                                kegiatan harus diisi</span>
                        </template>
                    </div>
                    <!-- End Col -->
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Kabupaten
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <select id="regencies" x-model="$store.form.regencyId"
                                @change="$wire.getDistrict($store.form.regencyId)"
                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected>pilih kabupaten</option>
                                @foreach ($regencies as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.regencyId">
                            <span class="text-red-500 text-sm">Kabupaten
                                harus dipilih</span>
                        </template>
                    </div>
                    <!-- End Col -->
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Kecamatan
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <select id="regencies" x-model="$store.form.districtId"
                                @change="$wire.getVillage($store.form.districtId)"
                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected value="">pilih kecamatan</option>
                                @foreach ($districts as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.districtId">
                            <span class="text-red-500 text-sm">Kecamatan
                                harus dipilih</span>
                        </template>
                    </div>
                    <!-- End Col -->
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Desa
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <select id="villages" x-model="$store.form.villageId"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            <option selected value="">pilih desa</option>
                            @foreach ($villages as $item)
                                <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                            @endforeach
                        </select>
                        <template x-if="$store.form.isSubmit && !$store.form.villageId">
                            <span class="text-red-500 text-sm">Desa
                                harus dipilih</span>
                        </template>
                    </div>
                    <!-- End Col -->
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Dusun/Blok
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <input x-model="$store.form.areaDetail" type="text"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="">

                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.areaDetail">
                            <span class="text-red-500 text-sm">Dusun/blok
                                harus diisi</span>
                        </template>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Grid -->
            </form>
        </div>
    </div>
    <!-- End Card -->
</div>

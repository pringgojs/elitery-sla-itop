<div>


    @php
        $sourceImg = asset('images/ktp.png');
    @endphp
    <!-- Card Section -->
    <div class="max-w-4xl  mx-auto"><!-- Card -->
        <div class=" bg-gray-50  rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-800">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                    Detail Kegiatan
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Lengkapi semua kolom dibawah ini.
                </p>
            </div>

            <form x-data="{
                form: $store.form,
                imagePreview: $store.form.imagePreview ? $store.form.imagePreview : '{{ asset('images/ktp.png') }}',
                async handleFileChange(e) {
                    const file = e.target.files[0];
                    if (file) {
                        // Memeriksa tipe file, hanya menerima gambar
                        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                        if (!validImageTypes.includes(file.type)) {
                            alert('Hanya file gambar yang diperbolehkan!');
                            return; // Menghentikan proses jika file bukan gambar
            
                        }
            
                        // Jika file valid, lanjutkan dengan konversi dan preview
                        $store.form.activityImage = await this.convertFileToBase64(file);
                        this.imagePreview = URL.createObjectURL(file);
                        $store.form.imagePreview = this.imagePreview; // untuk validasi ketika edit tanpa ubah gambar
                        console.log($store.form.activityImage);
                    }
                },
                convertFileToBase64(file) {
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();
            
                        // Event ketika file selesai dibaca
                        reader.onload = () => {
                            resolve(reader.result);
                        }; // Event ketika terjadi kesalahan
                        reader.onerror = (error) => {
                            reject(error);
                        };
            
                        // Membaca file sebagai Data URL
                        reader.readAsDataURL(file);
                    });
                },
                setMarker() {
                    if ($store.form.latitude && $store.form.longitude) {
                        const lat = parseFloat($store.form.latitude);
                        const lng = parseFloat($store.form.longitude);
                        const latLng = {
                            lat: lat,
                            lng: lng
                        };
                        window.dispatchEvent(new CustomEvent('set-marker', {
                            detail: latLng
                        }));
                    }
                },
            
            }">
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Sumber Bibit
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <select id="roles" x-model="$store.form.seedSourceId"
                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected>pilih sumber bibit</option>
                                @foreach ($seedSources as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.seedSourceId">
                            <span class="text-red-500 text-sm">Sumber bibit
                                harus dipilih</span>
                        </template>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Sumber Dana
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <select id="roles" x-model="$store.form.budgetSourceId"
                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected>pilih sumber dana</option>
                                @foreach ($budgetSources as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.budgetSourceId">
                            <span class="text-red-500 text-sm">Sumber dana
                                harus dipilih</span>
                        </template>
                    </div>
                    <!-- End Col -->
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Luas Lahan (Ha)
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <div class="relative">
                                <input x-model="$store.form.landArea" x-mask:dynamic="$money($input, ',')"
                                    type="text" id="hs-input-with-leading-and-trailing-icon"
                                    name="hs-input-with-leading-and-trailing-icon"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                    <span class="text-gray-500 dark:text-neutral-500">Ha</span>
                                </div>
                            </div>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.landArea">
                            <span class="text-red-500 text-sm">Luas lahan
                                harus diisi</span>
                        </template>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Penanggung Jawab
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <input x-model="$store.form.picName" type="text"
                                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="">

                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.picName">
                            <span class="text-red-500 text-sm">Penanggung jawab kegiatan
                                harus diisi</span>
                        </template>
                    </div>
                    <!-- End Col -->
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Keterangan Kegiatan
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <textarea x-model="$store.form.activityNote"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                rows="3" placeholder=""></textarea>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.activityNote">
                            <span class="text-red-500 text-sm">Keterangan kegiatan
                                harus diisi</span>
                        </template>

                    </div>

                    {{-- <div class="sm:col-span-3">
                        <label x-ref="labelKtp" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Foto Kegiatan
                        </label>
                    </div> --}}
                    <!-- End Col -->

                    {{-- <div class="sm:col-span-9">
                        <div class="flex items-center gap-5">
                            <x-modal id="exampleModal" maxWidth="lg" wire:model="modalPreview">
                                <div class="p-6">
                                    <img id="preview-modal"
                                        class="inline-block w-auto h-72 rounded ring-2 ring-white dark:ring-neutral-900"
                                        :src="imagePreview" alt="Avatar">
                                </div>
                            </x-modal>

                            <img id="preview"
                                onclick="document.getElementById('exampleModal')._x_dataStack[0].show = true"
                                class="inline-block size-16 rounded ring-2 ring-white cursor-pointer dark:ring-neutral-900"
                                :src="imagePreview" alt="Avatar">
                            <div class="flex gap-x-2">
                                <div>
                                    <input x-ref="fileInput" @change="handleFileChange" type="file" id="imageInput"
                                        style="display: none" accept="image/*">
                                    <div id="uploadBtn" @click="$refs.fileInput.click()"
                                        class="py-2 px-3 inline-flex items-center cursor-pointer gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                            <polyline points="17 8 12 3 7 8" />
                                            <line x1="12" x2="12" y1="3" y2="15" />
                                        </svg>
                                        <span>
                                            Unggah foto kegiatan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.imagePreview">
                            <span class="text-red-500 text-sm">Foto kegiatan
                                harus diisi</span>
                        </template>
                    </div> --}}

                    <!-- End Col -->
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Pilih Lokasi Kegiatan di Peta
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="mb-5">
                            <input type="text" x-model="$store.form.latitude"
                                class="py-2 px-3 pe-11 border-gray-200 shadow-sm text-sm rounded-lg focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                id="latitude" placeholder="Latitude">
                            <input type="text" x-model="$store.form.longitude"
                                class="py-2 px-3 pe-11 border-gray-200 shadow-sm text-sm rounded-lg focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                id="longitude" placeholder="Longitude">
                            <div id="setMap"
                                class="py-2 px-3 inline-flex items-center cursor-pointer gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                @click="setMarker()">
                                <span>
                                    Set Koordinat
                                </span>
                            </div>
                        </div>
                        <template x-if="$store.form.isSubmit && !$store.form.latitude && !$store.form.longitude">
                            <span class="text-red-500 text-sm">Lokasi kegiatan
                                harus diisi</span>
                        </template>

                        @livewire('utils.maps', ['useOnClickMarker' => true, 'markers' => $markers])
                    </div>

                </div>
                <!-- End Grid -->
            </form>
        </div>
    </div>
    <!-- End Card -->
</div>

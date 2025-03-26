<div>
    <div x-data="{
        loading: false,
        currentIndex: 0,
        form: $store.form,
        store() {
            // Display an info toast with no title
            $store.form.isSubmit = true;
            console.log($store.form);
    
            if (!$store.form.dateTime || !$store.form.activityTypeId || !$store.form.activityOrganizer || !$store.form.regencyId ||
                !$store.form.districtId || !$store.form.villageId || !$store.form.areaDetail ||
                $store.form.seeds.length < 1 || !$store.form.budgetSourceId || !$store.form.seedSourceId ||
                !$store.form.picName || !$store.form.activityNote || !$store.form.latitude ||
                !$store.form.longitude || !$store.form.landArea) {
    
                alert('Semua kolom harus terisi');
                {{-- this.loading = false; --}}
                {{-- $store.form.isSubmit = false; --}}
    
                return;
            }
    
            this.$refs.btnSubmit.click();
            return;
        },
        initDataFromDatabase() {
            $store.form.dateTime = @js($form->dateTime);
            $store.form.activityTypeId = @js($form->activityTypeId);
            $store.form.activityOrganizer = @js($form->activityOrganizer);
            $store.form.regencyId = @js($form->regencyId);
            $store.form.districtId = @js($form->districtId);
            $store.form.villageId = @js($form->villageId);
            $store.form.areaDetail = @js($form->areaDetail);
            $store.form.seedSourceId = @js($form->seedSourceId);
            $store.form.budgetSourceId = @js($form->budgetSourceId);
            $store.form.picName = @js($form->picName);
            $store.form.activityNote = @js($form->activityNote);
            $store.form.imagePreview = @js($form->imagePreview);
            $store.form.latitude = @js($form->latitude);
            $store.form.longitude = @js($form->longitude);
            $store.form.landArea = @js($form->landArea);
            $store.form.seeds = @js($form->seeds);
            $store.form.id = @js($form->id);
            console.log('$store.form.seeds', $store.form.seeds);
            $store.form.isSubmit = false;
            this.loading = false;
        }
    }" x-init="initDataFromDatabase()"
        class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto  bg-white rounded-lg shadow-md dark:bg-neutral-800">
        <form>
            <input type="button" x-ref="btnSubmit" @click="loading=true;$wire.dispatch('store', {form})" class="hidden">

            <!-- Stepper -->
            <div data-hs-stepper='{"currentIndex": 1}'>
                <!-- Stepper Nav -->
                <ul class="relative flex flex-row gap-x-2">
                    <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group"
                        data-hs-stepper-nav-item='{
              "index": 1
            }'>
                        <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                            <span
                                class="size-7 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 dark:bg-neutral-700 dark:text-white dark:group-focus:bg-gray-600 hs-stepper-active:bg-green-600 hs-stepper-active:text-white hs-stepper-success:bg-green-600 hs-stepper-success:text-white hs-stepper-completed:bg-teal-500 hs-stepper-completed:group-focus:bg-teal-600 dark:hs-stepper-active:bg-green-500 dark:hs-stepper-success:bg-green-500 dark:hs-stepper-completed:bg-teal-500 dark:hs-stepper-completed:group-focus:bg-teal-600">
                                <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">1</span>
                                <svg class="hidden shrink-0 size-3 hs-stepper-success:block"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span class="ms-2 text-sm font-medium text-gray-800 dark:text-white">
                                Data Kelompok
                            </span>
                        </span>
                        <div
                            class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-green-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-600 dark:hs-stepper-success:bg-green-500 dark:hs-stepper-completed:bg-teal-500">
                        </div>
                    </li>

                    <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group"
                        data-hs-stepper-nav-item='{
              "index": 2
            }'>
                        <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                            <span
                                class="size-7 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 dark:bg-neutral-700 dark:text-white dark:group-focus:bg-gray-600 hs-stepper-active:bg-green-600 hs-stepper-active:text-white hs-stepper-success:bg-green-600 hs-stepper-success:text-white hs-stepper-completed:bg-teal-500 hs-stepper-completed:group-focus:bg-teal-600 dark:hs-stepper-active:bg-green-500 dark:hs-stepper-success:bg-green-500 dark:hs-stepper-completed:bg-teal-500 dark:hs-stepper-completed:group-focus:bg-teal-600">
                                <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">2</span>
                                <svg class="hidden shrink-0 size-3 hs-stepper-success:block"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span class="ms-2 text-sm font-medium text-gray-800 dark:text-white">
                                Data Bibit
                            </span>
                        </span>
                        <div
                            class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-green-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-600 dark:hs-stepper-success:bg-green-500 dark:hs-stepper-completed:bg-teal-500">
                        </div>
                    </li>

                    <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group"
                        data-hs-stepper-nav-item='{
                "index": 3
              }'>
                        <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                            <span
                                class="size-7 flex justify-center items-center shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 dark:bg-neutral-700 dark:text-white dark:group-focus:bg-gray-600 hs-stepper-active:bg-green-600 hs-stepper-active:text-white hs-stepper-success:bg-green-600 hs-stepper-success:text-white hs-stepper-completed:bg-teal-500 hs-stepper-completed:group-focus:bg-teal-600 dark:hs-stepper-active:bg-green-500 dark:hs-stepper-success:bg-green-500 dark:hs-stepper-completed:bg-teal-500 dark:hs-stepper-completed:group-focus:bg-teal-600">
                                <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">3</span>
                                <svg class="hidden shrink-0 size-3 hs-stepper-success:block"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span class="ms-2 text-sm font-medium text-gray-800 dark:text-white">
                                Detail Kegiatan
                            </span>
                        </span>
                        <div
                            class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-green-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-600 dark:hs-stepper-success:bg-green-500 dark:hs-stepper-completed:bg-teal-500">
                        </div>
                    </li>
                    <!-- End Item -->
                </ul>
                <!-- End Stepper Nav -->

                <!-- Stepper Content -->
                <div class="mt-5 sm:mt-8">
                    <!-- First Content -->
                    <div data-hs-stepper-content-item='{"index": 1 }'>
                        @livewire('pages.planting-activity.section.form-step1', ['form' => $form])
                    </div>
                    <!-- End First Content -->

                    <!-- First Content -->
                    <div data-hs-stepper-content-item='{"index": 2}' style="display: none;">
                        @livewire('pages.planting-activity.section.form-step2', ['form' => $form])
                    </div>
                    <!-- End First Content -->

                    <!-- First Content -->
                    <div data-hs-stepper-content-item='{"index": 3}' style="display: none;">
                        @livewire('pages.planting-activity.section.form-step3', ['form' => $form])
                    </div>
                    <!-- End First Content -->

                    <!-- Final Content -->
                    <div data-hs-stepper-content-item='{"isFinal": false}' style="display: none;">
                        <div
                            class="p-4 h-48 bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-xl dark:bg-neutral-700 dark:border-neutral-600">
                            <h3 class="text-gray-500 dark:text-neutral-400">
                                Final content
                            </h3>
                        </div>
                    </div>
                    <!-- End Final Content -->

                    <!-- Button Group -->
                    <div class="mt-5 flex justify-between items-center gap-x-2">
                        <button @click="currentIndex--;" type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-stepper-back-btn="">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                            Sebelumnya
                        </button>
                        <button @click="currentIndex++;" type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-stepper-next-btn="">
                            Selanjutnya
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </button>
                        <button @click="store" type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none"
                            :style="currentIndex != 2 || loading ? 'display: none;' : ''">
                            Selesai
                        </button>
                        <button type="reset"
                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-stepper-reset-btn="" style="display: none;">
                            Reset
                        </button>

                        <div x-show="loading">
                            @livewire('utils.loading')
                        </div>
                        {{-- <p class="text-red" x-html="currentIndex"></p> --}}
                    </div>
                    <!-- End Button Group -->
                </div>
                <!-- End Stepper Content -->
            </div>
            <!-- End Stepper -->
        </form>


    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('form', {
                // formData: {
                id: '',
                dateTime: '',
                activityTypeId: '',
                activityOrganizer: '',
                regencyId: '',
                districtId: '',
                villageId: '',
                areaDetail: '',
                seeds: [],
                seedSourceId: '',
                budgetSourceId: '',
                landArea: '',
                picName: '',
                activityNote: '',
                activityImage: '',
                latitude: '',
                longitude: '',
                isSubmit: false,
                imagePreview: '',
                // }
            });
            console.log('alipine ini setelah form')
        });
    </script>
</div>

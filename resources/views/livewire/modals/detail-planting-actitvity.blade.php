<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="relative z-50 bg-white rounded-lg shadow dark:bg-gray-700 w-full ">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 rounded-t md:p-5 dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ $plantingActivity->activity_organizer }}
            </h3>
            <button type="button" wire:click="$dispatch('closeModal')"
                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="static-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 space-y-4 md:p-5 w-full">
            <a href="#">
                <img class="rounded-t-lg" src="{{ asset('storage/' . $plantingActivity->activity_image) }}"
                    alt="" />
            </a>
            <div class="">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    </h5>
                </a>
                <!-- List Group -->
                <ul class="mt-3 flex flex-col">
                    @php
                        $items = [
                            [
                                'label' => 'Sumber Dana',
                                'value' => $plantingActivity->budgetSource->name,
                            ],
                            [
                                'label' => 'Luas Lahan (Ha)',
                                'value' => $plantingActivity->land_area,
                            ],
                            [
                                'label' => 'Penanggung Jawab',
                                'value' => $plantingActivity->pic_name,
                            ],
                        ];
                    @endphp
                    @foreach ($items as $item)
                        <li
                            class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                            <div class="flex items-center justify-between w-full">
                                <span>{{ $item['label'] }}</span>
                                <span class="font-bold">{{ $item['value'] }}</span>
                            </div>
                        </li>
                    @endforeach
                    <li
                        class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                        <div class="flex items-center justify-between w-full">
                            <span>Bibit</span>
                            <span class="font-bold">
                                @foreach ($plantingActivity->seeds as $item)
                                    {{ $item->seed->name }},
                                @endforeach
                            </span>
                        </div>
                    </li>
                </ul>
                <!-- End List Group -->
                <a href="#"
                    class="inline-flex items-center mt-3 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Detail
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

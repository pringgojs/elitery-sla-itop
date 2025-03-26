<div>
    <div x-data="{ open: false }" @set-open-detail.window="open = $event.detail" x-show="open" @click.away="open = false"
        class="fixed inset-0 flex z-50 justify-end">
        <!-- Background overlay -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50"></div>

        <!-- Drawer -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full" class="relative bg-white w-96 h-full shadow-xl">
            <div class="absolute left-0 top-0 -ml-8 flex pr-2 pt-4 sm:-ml-10 sm:pr-4">
                <button type="button" @click="open = false"
                    class="relative rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="absolute -inset-2.5"></span>
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Slide-over panel, show/hide based on slide-over state. -->
            <div class="h-full overflow-y-auto bg-white p-8">
                <div class="justify-end flex-initial ml-5 -mt-5" wire:loading wire:target='detail'>
                    @livewire('utils.loading')
                </div>
                <div class="space-y-6 pb-16">
                    <div>
                        <div class="aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg">
                            <img src="https://images.unsplash.com/photo-1582053433976-25c00369fc93?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=512&q=80"
                                alt="" class="object-cover">
                        </div>
                        <div class="mt-4 flex items-start justify-between">
                            <div>
                                <h2 class="text-base font-semibold leading-6 text-gray-900"><span
                                        class="sr-only">Details for </span>IMG_4985.HEIC {{ $id }}</h2>
                                <p class="text-sm font-medium text-gray-500">3.9 MB</p>
                            </div>
                            <button type="button"
                                class="relative ml-4 flex h-8 w-8 items-center justify-center rounded-full bg-white text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <span class="absolute -inset-1.5"></span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                <span class="sr-only">Favorite</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

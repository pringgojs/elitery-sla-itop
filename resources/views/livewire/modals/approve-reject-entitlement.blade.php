<div>
    <div
        class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
        <div class="sm:flex sm:items-start">
            <div
                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true" class="h-6 w-6 text-red-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z">
                    </path>
                </svg>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 id="headlessui-dialog-title-35" class="text-base font-semibold leading-6 text-gray-900">
                    {{ $title }}</h3>
                @if ($action == 'reject')
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Tulis alasan penolakan pada kolom dibawah ini!</p>
                        <input type="text" wire:model="reason_rejection" name="reason_rejection"
                            id="reason_rejection" placeholder=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">

                    </div>
                @endif
            </div>
        </div>
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">


            <button type="button" wire:click="submit"
                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                tabindex="0"> Submit </button>
            <button wire:click="close" type="button"
                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                Cancel </button>
            <div class="-mt-6 ml-2" wire:loading>
                @livewire('utils.loading')
            </div>
        </div>

    </div>

</div>

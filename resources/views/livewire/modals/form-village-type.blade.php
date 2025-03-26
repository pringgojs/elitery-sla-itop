<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="relative z-50 bg-white rounded-lg shadow dark:bg-gray-700 ">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 rounded-t md:p-5 dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ $id ? 'Perbaruhi  Jenis Desa' : 'Tambah Jenis Desa' }}
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
        <div class="p-4 space-y-4 md:p-5">
            <form wire:submit="store" class="space-y-4 md:space-y-6" autocomplete="off">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama</label>
                    <input type="text" wire:model="form.name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                        placeholder="Janti">
                    <div>
                        @error('form.name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="maxKasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Maximal
                        Kasi
                    </label>
                    <input type="number" wire:model="form.maxKasi" placeholder="2" autocomplete="off"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" />
                    <div>
                        @error('form.maxKasi')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="maxKaur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Maximal Kaur
                    </label>
                    <input type="number" wire:model="form.maxKaur"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                        placeholder="2">
                    <div>
                        @error('form.maxKaur')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex">
                    <button type="submit" wire:loading.attr="disabled" wire:target='store'
                        wire:loading.class.remove="bg-green-600"
                        class="flex-initial w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Submit
                    </button>
                    <div class="justify-end flex-initial ml-5 -mt-5" wire:loading wire:target='store'>
                        @livewire('utils.loading')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

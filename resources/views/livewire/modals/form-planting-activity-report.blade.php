<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="relative z-50 bg-white rounded-lg shadow dark:bg-gray-700 ">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 rounded-t md:p-5 dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Form Perkembangan Kegiatan Tanam
            </h3>
            <button type="button" wire:click="$dispatch('closeModal')"
                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div x-data="{ isAddStock: false }" class="p-4 space-y-4 md:p-5">
            <form wire:submit="store" class="space-y-4 md:space-y-6" autocomplete="off">
                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tanggal Laporan
                    </label>
                    <input type="date" wire:model="form.date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                        placeholder="">
                    <div>
                        @error('form.date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Laporan Kehidupan Tanaman</label>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Bibit</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Jumlah Hidup</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Jumlah Mati</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plantingActivity->seeds as $i => $item)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ $item->seed->name ?? '(deleted)' }} ({{ $item->amount ?? 0 }} bibit)</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">
                                            <input type="text" wire:model="form.aliveAmount.{{ $item->seed->id }}"
                                                required
                                                x-mask:dynamic="$input.startsWith('34') || $input.startsWith('37')? '9999 999999 99999' : '9999 9999 9999 9999'"
                                                class="w-full text-right border border-gray-300 px-2 py-1 focus:ring-green-600 focus:border-green-600 ">
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">
                                            <input type="text" wire:model="form.deadAmount.{{ $item->seed->id }}"
                                                required
                                                x-mask:dynamic="$input.startsWith('34') || $input.startsWith('37')? '9999 999999 99999' : '9999 9999 9999 9999'"
                                                class="w-full text-right border border-gray-300 px-2 py-1 focus:ring-green-600 focus:border-green-600 ">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        @foreach ($plantingActivity->seeds as $i => $item)
                            @error('form.deadAmount.' . $item->seed->id)
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            @error('form.aliveAmount.' . $item->seed->id)
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        @endforeach
                    </div>
                </div>
                <div>
                    <label for="report" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Keterangan
                    </label>
                    <div class="mt-1">
                        <textarea wire:model="form.note" id="report"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Masukkan laporan perkembangan kegiatan tanam"></textarea>
                    </div>
                </div>
                <div>

                </div>
                <div class="flex">
                    <button type="submit" wire:loading.attr="disabled" wire:target='store'
                        wire:loading.class.remove="bg-green-600"
                        class="flex-initial w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Simpan
                    </button>
                    <div class="justify-end flex-initial ml-5" wire:loading wire:target='store'>
                        @livewire('utils.loading')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

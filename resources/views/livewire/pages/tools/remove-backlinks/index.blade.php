<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Remove Backlinks</h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                {{-- <p>Pilih plan.</p> --}}
            </div>
            <form class="mt-5 sm:items-center">
                <div class="grid grid-cols-[1fr_auto_1fr_1fr] gap-4">
                    <div>
                        <div class="justify-left text-sm gap-x-5">
                            <label for="first_name"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-white">Database</label>
                            <select wire:model="database" wire:change="getTables" name="state"
                                class="inline-flex w-full px-4 py-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <option value="">Select Database</option>
                                @foreach ($databases as $item)
                                    <option value="{{ $item->Database }}">
                                        {{ $item->Database }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        {{-- <div class="grid grid-cols-3 gap-4"> --}}
                        <div class="justify-left text-sm gap-x-5">
                            <label for="first_name"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-white">Table</label>
                            <select wire:model="table" id="table" wire:change="getColumns" name="table"
                                class="inline-flex px-4 py-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <option value="">Select Table</option>
                                @foreach ($tables as $item)
                                    <option value="{{ $item->table_name ?? $item->TABLE_NAME }}"
                                        wire:key="item-table-{{ $item->table_name ?? $item->TABLE_NAME }}">
                                        {{ $item->table_name ?? $item->TABLE_NAME }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- tahun --}}

                        {{-- </div> --}}
                    </div>
                    <div>
                        {{-- <div class="grid grid-cols-3 gap-4"> --}}
                        <div class="justify-left text-sm gap-x-5">
                            <label for="column"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-white">Column</label>
                            <select wire:model="column" id="column" name="column"
                                class="inline-flex px-4 py-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <option value="">Select Column</option>
                                @foreach ($columns as $item)
                                    <option value="{{ $item->column_name }}"
                                        wire:key="item-column-{{ $item->column_name }}">
                                        {{ $item->column_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- tahun --}}

                        {{-- </div> --}}
                    </div>
                    <div>
                        <div class="grid grid-cols-6 gap-2">
                            <div class="col-start-4 col-span-2 flex justify-end items-center">
                                <button wire:click="process" type="button"
                                    class="mt-7 text-white bg-green-500 hover:bg-green-400 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                                    <x-lucide-scan-line class="w-6 h-5 me-2 -ms-1" />
                                    Scan
                                </button>
                            </div>
                            <div class="col-span-1 flex justify-center items-center mt-2" wire:loading>
                                @livewire('utils.loading')
                            </div>
                        </div>
                        {{-- <div class="justify-left text-sm gap-x-5"> --}}

                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        pre {
            white-space: pre-wrap;
            /* Menjaga format teks */
            word-wrap: break-word;
            /* Membungkus teks */
        }
    </style>
    @if ($output)
        <div class="mt-5 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <b class="text-md font-bold">Output</b>
                <pre>{{ $output }}</pre>
            </div>
        </div>
    @endif

</div>

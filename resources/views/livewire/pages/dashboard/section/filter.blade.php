<div>

    {{-- Do your work, then step back. --}}

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Filter</h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                {{-- <p>Pilih plan.</p> --}}
            </div>
            <form class="mt-5 sm:items-center">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-2">
                        <div class="justify-left text-sm gap-x-5">
                            <label for="first_name"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-white">State</label>
                            <select wire:model="state" wire:change="filter" name="state"
                                class="inline-flex w-full px-4 py-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <option value="">All State</option>
                                @foreach ($entitlements as $item)
                                    <option value="{{ $item }}">
                                        {{ ucwords(strtolower(str_replace('_', ' ', $item))) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- plan --}}
                    <div class="col-span-2">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="justify-left text-sm gap-x-5">
                                <label for="first_name"
                                    class="block mb-2 text-sm font-medium text-gray-400 dark:text-white">Plan</label>
                                <select wire:model="plan" id="plan" wire:change="filter" name="plan"
                                    class="inline-flex px-4 py-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <option value="">All Plan</option>
                                    @foreach ($plans as $item)
                                        <option value="{{ $item }}" wire:key="item-plan-{{ $item }}">
                                            {{ ucfirst($item) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- tahun --}}

                        </div>
                    </div>

                    <div class="col-span-2">
                        <div class="grid grid-cols-6 gap-2">
                            <div class="col-start-4 col-end-6"><button wire:click="export" type="button"
                                    class="ml-2 mt-7 text-white bg-green-500 hover:bg-green-400 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                                    <x-bytesize-download class="w-6 h-5 me-2 -ms-1" />
                                    Download
                                </button>
                            </div>
                            <div class="col-end-7 col-span-1 mt-2" wire:loading>
                                @livewire('utils.loading')
                            </div>
                        </div>
                        {{-- <div class="justify-left text-sm gap-x-5"> --}}

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

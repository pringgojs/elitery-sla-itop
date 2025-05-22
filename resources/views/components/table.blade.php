@props([
    'title' => '',
    'headers' => [],
    'table' => '',
    'footer' => '',
    'useSearch' => false,
])

<div x-data="{
    searchValue: '',
    search(value) {
        $wire.dispatch('search', { search: value });
        {{-- window.dispatchEvent(new CustomEvent('search', { detail: value })); --}}
    }
}" x-init="$watch('searchValue', value => search(value))">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="border rounded-lg shadow-sm p-6 bg-white dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex flex-col">
            <div class="grid grid-cols-3 gap-4 items-center">
                <div
                    class="col-span-2 p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    {{ $title }}
                </div>
                <div class="flex flex-col items-end justify-center">
                    @if ($useSearch)
                        <div class="flex flex-row items-center gap-2 mb-2">
                            <input type="text" x-model="searchValue" placeholder="Search..."
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-green-500 focus:border-green-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" />
                            <div wire:loading class="flex items-center justify-center">
                                @livewire('utils.loading', key(\Illuminate\Support\Str::random(10)))
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="-m-1.5 overflow-x-auto mb-5">

                <div class="p-1.5 min-w-full inline-block align-middle ">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">

                            <thead>
                                <tr>
                                    @foreach ($headers as $item)
                                        <th scope="col"
                                            class="px-6 py-3 text-xs text-left font-bold text-black uppercase dark:text-neutral-500">
                                            {{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                {{ $table ?? '' }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $footer ?? '' }}
        </div>
    </div>
</div>


@script
    <script>
        initFlowbite();
    </script>
@endscript

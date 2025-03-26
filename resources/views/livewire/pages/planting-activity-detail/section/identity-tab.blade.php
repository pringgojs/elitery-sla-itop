<div>
    {{-- Success is as dangerous as failure. --}}

    <div x-cloak class="bg-white  p-4 mt-5  relative overflow-hidden dark:bg-neutral-800">
        <div class="flex">
            <div class="mb-8 flex-auto">
                <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                    Data Kelompok
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    {{-- Lengkapi semua kolom dibawah ini dengan data yang sesungguhnya. --}}
                </p>
            </div>
            <div>
                {{-- {!! $form->village_staff->labelDataStatus() !!} --}}
            </div>
        </div>

        <form wire:submit="store" x-data="{
            isReadonly: false,
            setReadonly() {}
        }" x-init="if (isReadonly) {
            setReadonly()
        };">
            <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                @if (false)
                    <div class="overflow-hidden border shadow-sm mb-5 sm:rounded-lg">
                        <img onclick="document.getElementById('exampleModal')._x_dataStack[0].show = true"
                            id="preview"
                            class="inline-block w-full h-auto rounded ring-2 ring-white dark:ring-neutral-900"
                            src="" alt="Avatar">
                    </div>
                @endif

                @foreach ($this->getFields as $i => $item)
                    <!-- Grid -->
                    <div class="sm:col-span-3">
                        <label for="af-account-full-name"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            {{ $i }}
                        </label>
                    </div>
                    <!-- End Col -->
                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            {{-- <p class="text-gray-900">{{ $item }}</p> --}}
                            <input value="{{ $item }}" type="text"
                                class="bg-gray-50 border font-semibold border-gray-50 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                readonly>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
</div>

<div>
    <!-- Card Section -->
    {{-- <div class="max-w-4xl mx-auto"><!-- Card --> --}}
    <div class="bg-white">
        <div class="bg-gray-50 p-4 shadow rounded-lg">
            <ul role="list" class="divide-y divide-gray-100">
                @foreach ($form->seeds as $item)
                    <li class="flex items-center justify-between gap-x-6 py-5">
                        <div class="min-w-0">
                            <div class="flex gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm font-semibold leading-6 text-gray-900">
                                        <a href="#" class="">{{ $item->seed->name ?? '-' }}</a>
                                    </p>
                                    <p class="flex text-xs font-semibold leading-5 text-gray-500">
                                        <a class="truncate">{{ $item->amount }} bibit</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="flex flex-none items-center gap-x-2">
                            <a @click="remove(i.id)"
                                class="inline-flex rounded-lg p-2 bg-red-50 text-red-700  cursor-pointer">
                                <x-heroicon-o-trash class="h-5 w-5" />
                            </a>
                        </div> --}}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- </div> --}}
    <!-- End Card -->
</div>

<div>
    <x-table :headers="[
        'Agent Name',
        'Response Time L1',
        'Response Time L2',
        'Resolution Time',
        'Resolution Time Real',
        'Pending Time',
    ]" title="Agents">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($this->items as $index => $item)
                @php
                    // dd($item);
                @endphp
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item['name'] ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item['response_time_l1'] ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item['response_time_l2'] ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item['resolution_time'] ?? '-' }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item['resolution_time_real'] ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item['pending_time'] ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{ $this->items->links() }}
        </x-slot:footer>
    </x-table>
</div>

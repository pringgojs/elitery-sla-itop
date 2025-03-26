<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @livewire('pages.statistic-status-data.section.filter')

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300 mb-5">
            <thead class="bg-gray-200">
                <tr>
                    <th rowspan="2" class="border border-gray-300 px-4 py-2 text-center">No.</th>
                    <th rowspan="2" class="border border-gray-300 px-4 py-2 text-center">Desa</th>
                    <th colspan="{{ $statusData->count() }}" class="border border-gray-300 px-4 py-2 text-center">
                        Jumlah</th>
                    <th rowspan="2" class="border border-gray-300 px-4 py-2 text-center">Total</th>
                </tr>
                <tr>

                    @foreach ($statusData as $item)
                        <th class="border border-gray-300 px-4 py-2 text-center">{{ $item->name }}</th>
                    @endforeach
                </tr>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh data -->
                @foreach ($villages as $i => $item)
                    {{-- {{ dd($item) }} --}}
                    @php
                        $total = 0;
                    @endphp
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ ++$i }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->name }}</td>
                        @foreach ($statusData as $status)
                            @php
                                $count = $item->totalStaffByStatus($status->id);
                                $total += $count;
                            @endphp
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                {{ $count }}</td>
                        @endforeach
                        <td class="border border-gray-300 px-4 py-2">{{ $total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $villages->links() }}
    </div>
</div>

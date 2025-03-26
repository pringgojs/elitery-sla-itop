<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @livewire('pages.statistic.section.filter')

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300 mb-5">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-center">No.</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Desa</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Total Perangkat Desa</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Perangkat Mau Pensiun</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">BPD Mau Pensiun</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh data -->
                @foreach ($villages as $i => $item)
                    {{-- {{ dd($item) }} --}}
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ ++$i }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->staff_count }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->totalStaffRetiringSoon() }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->totalBpdRetiringSoon() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $villages->links() }}
    </div>
</div>

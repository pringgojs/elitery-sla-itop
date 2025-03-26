<div>
    {{-- Stop trying to control. --}}
    <div class="sm:flex sm:items-center mb-5 mx-auto">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Transaksi Harian</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            @can('transaksi.harian.create')
                <a href="{{ route('daily-transaction.create') }}" wire:navigate type="button"
                    class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buat
                    Baru</a>
            @endcan
        </div>
    </div>

    @livewire('pages.daily-transaction.section.table')
</div>

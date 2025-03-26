<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Jenis Bibit</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            @can('jenis.bibit.create')
                <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-seed'})" type="button"
                    class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buat
                    Baru</a>
            @endcan
        </div>
    </div>
    {{-- panggil component table.staff --}}
    {{-- <x-staff.table :$staffs :$staff /> --}}
    @livewire('pages.seed.section.table')
</div>

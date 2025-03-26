<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Perangkat Desa - {{ $option->name }}</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-village-staff', arguments: {position_type_id: '{{ $option->id }}'} })"
                type="button"
                class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buat
                Baru</a>
        </div>
    </div>
    <div class="bg-red-200 text-red-500"></div>
    <div class="bg-blue-200 text-blue-500"></div>
    <div class="bg-green-200 text-green-500"></div>

    {{-- panggil component table.staff --}}
    {{-- <x-staff.table :$staffs :$staff /> --}}
    @livewire('pages.village-staff.section.table', ['type' => $type])
</div>

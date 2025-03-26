<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Perangkat Desa Mendekati Pensiun</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
    </div>
    <div class="bg-red-200 text-red-500"></div>
    <div class="bg-blue-200 text-blue-500"></div>
    <div class="bg-green-200 text-green-500"></div>

    {{-- panggil component table.staff --}}
    {{-- <x-staff.table :$staffs :$staff /> --}}
    @livewire('pages.village-staff.section.table', ['isWillRetire' => true])
</div>

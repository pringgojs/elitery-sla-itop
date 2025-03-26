<div>
    {{-- The whole world belongs to you. --}}
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Data Perangkat Menunggu untuk Disetujui</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            {{-- <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-user' })" type="button"
            class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buat Baru</a> --}}
        </div>
    </div>

    {{-- @livewire('pages.report.section.filter') --}}
    @livewire('pages.village-staff.section.table', ['status' => key_option('diajukan')])
</div>

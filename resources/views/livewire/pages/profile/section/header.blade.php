<div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
        <div class="bg-white p-6">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="sm:flex sm:space-x-5">
                    <div class="flex-shrink-0">
                        <svg class="mx-auto h-20 w-20 rounded-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>

                    <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                        <p class="text-sm font-medium text-gray-600">Identitas,</p>
                        <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $staff->name ?? '**' }}</p>
                        <p class="text-sm font-medium text-gray-600">{{ $staff->position_name ?? '' }} -
                            {{ $staff->village->name ?? '' }} - {{ $staff->village->district->name ?? '' }}</p>
                    </div>
                </div>
                <div class="mt-5 flex justify-center sm:mt-0">
                    @if ($from == 'admin' && $form->village_staff->dataStatus->key != 'final')
                        <a onclick="document.getElementById('modalConfirm')._x_dataStack[0].show = true"
                            class="flex items-center mr-2 justify-center cursor-pointer rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm  hover:bg-green-700 focus:outline-none focus:bg-green-700">Finalisasi
                            Data
                        </a>
                    @endif
                    <a href="#"
                        class="flex items-center justify-center cursor-pointer rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Unduh
                        Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <x-modal id="modalConfirm" maxWidth="md" wire:model="modalConfirm">
        {{-- <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"> --}}

        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div
                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Konfirmasi
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Anda yakin ingin data sudah benar ? Data yang sudah disetujui
                            tidak bisa diedit lagi.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" <button wire:click="finalisasi" type="button"
                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 sm:ml-3 sm:w-auto">Ya,
                Finalisasi sekarang</button>
            <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5" wire:loading
                wire:target='finalisasi'>
                <x-loading />
            </div>
        </div>
        {{-- </div> --}}
    </x-modal>
</div>

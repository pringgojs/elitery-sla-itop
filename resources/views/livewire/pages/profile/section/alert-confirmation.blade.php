<div>
    {{-- Success is as dangerous as failure. --}}
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
                        <p class="text-sm text-gray-500">Anda yakin ingin data sudah benar ? Data akan
                            terkunci selama proses pengajuan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" <button wire:click="processFinal" type="button"
                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 sm:ml-3 sm:w-auto">Ya,
                Ajukan sekarang</button>
            <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5" wire:loading
                wire:target='processFinal'>
                <x-loading />
            </div>
        </div>
        {{-- </div> --}}
    </x-modal>
    <div
        class="flex flex-col bg-gray-200 border shadow-sm rounded-xl mb-10 border-gradient animate-border-gradient dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
        <div class="p-4 md:p-7">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                Penting!
            </h3>
            <p class="mt-2 text-gray-500 dark:text-neutral-400">
                Status data Anda saat ini masih <b>{{ $staff->dataStatus->name }}</b>, segera
                ajukan untuk difinalisasi oleh Pemdes.
            </p>
            @if ($staff->dataStatus->key == 'revisi')
                <p>Catatan revisi: <span class="text-red-600">{{ $staff->reason_note }}</span>
                </p>
            @endif
            <button onclick="document.getElementById('modalConfirm')._x_dataStack[0].show = true" type="button"
                class="inline-flex mt-2 w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 sm:w-auto">Ajukan
                Finalisasi</button>
        </div>
    </div>
</div>

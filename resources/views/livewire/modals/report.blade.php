<div>
    <x-modal maxWidth="md" id="modal-reporting" wire:model="modalReporting">
        <div class="bg-white shadow sm:rounded-lg" x-data="{
            year: '',
            title: '',
            action: '',
            updateTitle(t) {
                this.title = t.title;
                this.action = t.action;
                show = true
            },
            getThisYear() {
                const d = new Date();
                this.year = d.getFullYear();
            }
        }"
            @update-title-form-reporting.window="updateTitle(event.detail)" x-init="getThisYear()">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-base font-semibold text-gray-900" x-html="title"></h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>Silahkan pilih tahun untuk data yang akan diunduh.</p>
                    <span x-html="year"></span>
                </div>
                <form class="mt-5 sm:flex sm:items-center">
                    <div class="w-full sm:max-w-xs">
                        <input type="number" x-model="year" aria-label="year"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="2024">
                    </div>
                    <button type="button" wire:loading.attr="disabled" wire:loading.remove
                        wire:click="$dispatch(action, {year})"
                        class="mt-3 inline-flex w-full items-center justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 sm:ml-3 sm:mt-0 sm:w-auto">Unduh</button>
                    <div class="inline-flex ml-5" wire:loading>
                        @livewire('utils.loading')
                    </div>
                </form>
            </div>
        </div>

    </x-modal>
</div>

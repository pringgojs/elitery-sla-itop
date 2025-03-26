<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="relative z-50 bg-white rounded-lg shadow dark:bg-gray-700 ">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 rounded-t md:p-5 dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ $user_id ? 'Perbaruhi  User' : 'Tambah User' }}
            </h3>
            <button type="button" wire:click="$dispatch('closeModal')"
                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="static-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 space-y-4 md:p-5">
            <form x-data="{
                isCreateDbAccount: @entangle('is_create_db_account'),
                isCreateCpanelAccount: @entangle('is_create_cpanel_account')
            }" wire:submit="store" class="space-y-4 md:space-y-6" autocomplete="off">
                <div>
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama</label>
                    <input type="text" wire:model="form.name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                        placeholder="Pringgo D. Red">
                    <div>
                        @error('form.name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Username
                    </label>
                    <input type="text" wire:model="form.username" x-mask="aaaaaaaaaaaaaaaa" placeholder="Username "
                        autocomplete="off"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                    <div>
                        @error('form.username')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email
                    </label>
                    <input type="email" wire:model="form.email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                        placeholder="name@company.com">
                    <div>
                        @error('form.email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="roles"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                    <select id="roles" wire:model="form.role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                        <option selected>Choose a role</option>
                        @foreach ($roles as $item)
                            @if ($item->name == 'Super Admin' && !$isSuperAdmin)
                                @continue
                            @endif
                            <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('form.role')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- <div>
                    <label for="departments"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit/Departmen</label>
                    <select id="departments" wire:model="form.department"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                        <option selected>Choose a unit</option>
                        @foreach ($departments as $item)
                            <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('form.role')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}

                {{-- generate password --}}
                <div x-data="{
                    cpanelpassword: $wire.entangle('form.password').live,
                    copied: false,
                    disabledCopyButton: true
                }">
                    <label for="generate-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Password @if ($user_id)
                            (Optional)
                        @endif
                    </label>
                    <div class="flex">
                        <div class="relative w-full">
                            <input type="text" id="generate-password" wire:model='form.password'
                                x-model="cpanelpassword"
                                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg rounded-s-gray-100 rounded-s-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                placeholder="Password" />

                            <div id="tooltip-generate-password" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Tooltip content
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>

                            <button type="button" x-clipboard="cpanelpassword" @click="copied=true"
                                :disabled="cpanelpassword == '' ? disabledCopyButton = true : disabledCopyButton = false"
                                class="absolute top-0 end-0 py-2.5 px-4 h-full text-sm font-medium text-gray-900 bg-gray-100 rounded-e-lg border border-gray-300 dark:border-gray-700 dark:text-white hover:bg-gray-200 focus:ring-1 focus:outline-none focus:ring-green-600 focus:border-green-600 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                <svg class="w-6 h-6"
                                    :class="copied ? 'text-green-500 dark:text-green-400' : 'text-gray-800 dark:text-white'"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                        d="M9 8v3a1 1 0 0 1-1 1H5m11 4h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1v1m4 3v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-7.13a1 1 0 0 1 .24-.65L7.7 8.35A1 1 0 0 1 8.46 8H13a1 1 0 0 1 1 1Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="button" wire:click="$set('form.password', '{{ $this->generatePassword }}')"
                        @click="copied=false"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Generate Password
                    </button>
                </div>
                <div class="flex">
                    <button type="submit" wire:loading.attr="disabled" wire:target='store'
                        wire:loading.class.remove="bg-green-600"
                        class="flex-initial w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Submit
                    </button>
                    <div class="justify-end flex-initial ml-5" wire:loading wire:target='store'>
                        @livewire('utils.loading')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

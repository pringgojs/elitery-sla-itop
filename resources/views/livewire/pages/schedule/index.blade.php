<div>
    <div class="sm:flex sm:items-center mb-5 mx-auto">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Pengaturan Jadwal Transaksi Semester</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
    </div>

    <div id="schedule-form" x-data="initData()" @on-date-change="selectedDate=$event.detail" class="space-y-4 mb-3">
        <!-- Card 1 -->
        <div class="bg-white p-4 rounded-lg shadow">
            <ul role="list" class="divide-y divide-gray-100">
                {{-- @foreach ($keys as $item) --}}
                <li class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex items-start gap-x-3">
                            <p class="text-sm font-semibold leading-6 text-gray-900">Tanggal Pengajuan Dibuka</p>
                        </div>
                        <div class="mt-1 flex items-center gap-x-2 text-lg leading-5 text-green-500 font-bold">
                            <p class="whitespace-nowrap">
                                {{ date_format_human(option_get_name('jadwal_semester_buka')) }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-none items-center gap-x-4">
                        <a data-dropdown-toggle="dropdown-open-date-jadwal_semester_buka"
                            class="rounded-md bg-white cursor-pointer px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ">Ubah
                            Tanggal</a>
                    </div>
                    {{-- <div id="datepicker-inline" inline-datepicker data-date="02/25/2024"></div> --}}
                    <div id="dropdown-open-date-jadwal_semester_buka" class="z-10 hidden ">
                        <div class="py-1 capitalize" role="none">
                            <div class="block p-4 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                id="menu-item-1">

                                <x-datepicker wire:ignore id="datepicker-jadwal_semester_buka"
                                    callback="on-date-change"></x-datepicker>
                                @can('jadwal.transaksi.semester.edit')
                                    <x-button class="w-full mt-3 text-sm"
                                        @click="$wire.setDate('jadwal_semester_buka', selectedDate);selectedDate=''"><span
                                            class="mx-auto">Simpan</span></x-button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>

                <li class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex items-start gap-x-3">
                            <p class="text-sm font-semibold leading-6 text-gray-900">Tanggal Pengajuan Dibuka</p>
                        </div>
                        <div class="mt-1 flex items-center gap-x-2 text-lg leading-5 text-green-500 font-bold">
                            <p class="whitespace-nowrap">
                                {{ date_format_human(option_get_name('jadwal_semester_tutup')) }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-none items-center gap-x-4">
                        <a data-dropdown-toggle="dropdown-open-date-jadwal_semester_tutup"
                            class="rounded-md bg-white cursor-pointer px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 ">Ubah
                            Tanggal</a>
                    </div>
                    {{-- <div id="datepicker-inline" inline-datepicker data-date="02/25/2024"></div> --}}
                    <div id="dropdown-open-date-jadwal_semester_tutup" class="z-10 hidden ">
                        <div class="py-1 capitalize" role="none">
                            <div class="block p-4 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                id="menu-item-1">

                                <x-datepicker wire:ignore id="datepicker-jadwal_semester_tutup"
                                    callback="on-date-change"></x-datepicker>

                                @can('jadwal.transaksi.semester.edit')
                                    <x-button class="w-full mt-3 text-sm"
                                        @click="$wire.setDate('jadwal_semester_tutup', selectedDate);selectedDate=''"><span
                                            class="mx-auto">Simpan</span></x-button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>
                {{-- @endforeach --}}

            </ul>
        </div>
    </div>

    <script>
        // Parent component
        function initData() {
            return {
                selectedDate: '', // Variabel untuk menampung tanggal dari child
                handleDateChanged(event) {
                    console.log('event', event)
                    this.selectedDate = event.detail.value; // Update nilai dari event child
                }
            }
        }
    </script>
</div>


@script
    <script>
        Livewire.hook('morph.added', ({
            el,
            component
        }) => {
            initFlowbite();
            window.HSStaticMethods.autoInit();

        })
    </script>
@endscript

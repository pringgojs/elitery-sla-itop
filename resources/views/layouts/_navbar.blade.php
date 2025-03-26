<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600 ">
    <div x-data="{ styleOpen: 'position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(617px, 58px);' }" class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" class="h-10 mr-3" alt="Flowbite Logo" />
            {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Simonev</span> --}}
        </a>
        <div class="flex items-center md:order-2">
            {{-- notification --}}
            {{-- <button type="button"
                class="relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">View notifications</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                <div
                    class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
                    20</div>
            </button> --}}
            {{-- <template> --}}
            {{-- profile --}}
            <button type="button" data-dropdown-toggle="profile-user-dropdown"
                class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                <x-heroicon-o-user class="h-5 w-5 rounded-full mr-1" />
                <div class="w-32 truncate text-left">
                    {{ auth()->user()->name }}
                </div>
            </button>
            <!-- Dropdown -->
            <div class="z-50 my-4 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700"
                id="profile-user-dropdown">
                <ul class="py-2 font-medium" role="none">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">
                            <div class="inline-flex items-center">
                                <x-heroicon-o-user class="h-3.5 w-3.5 rounded-full mr-2" />
                                Akun
                            </div>
                        </a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">
                                <div class="inline-flex items-center">
                                    <x-heroicon-o-arrow-right class="h-3.5 w-3.5 rounded-full mr-2" />
                                    Keluar
                                </div>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
            {{-- </template> --}}
            <button type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-language" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-language">
            <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ url('/dashboard') }}" wire:navigate
                        class="block py-2 pl-3 pr-4 @if (request()->segment(1) == 'dashboard') text-blue-700 @else text-gray-900 @endif rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                        aria-current="page">Beranda</a>
                </li>
                {{-- @if (auth()->user()->hasRole('administrator')) --}}
                <li>
                    <button id="dropdownNavbar1Link" data-dropdown-toggle="dropdownNavbar1"
                        class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Master
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar1"
                        class="z-10 hidden mt-5 font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                            {{-- @can('unit.view') --}}
                            <li>
                                <a href="{{ route('option.index', ['type' => 'budget_source']) }}" wire:navigate
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sumber
                                    Anggaran</a>
                            </li>
                            <li>
                                <a href="{{ route('planting-activity.form') }}" wire:navigate
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Kegiatan
                                    penanaman
                            </li>
                            {{-- @endcan --}}
                            @can('satuan.barang.view')
                                <li>
                                    <a href="{{ route('unit.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Satuan
                                        Barang</a>
                                </li>
                            @endcan
                            @can('barang.view')
                                <li>
                                    <a href="{{ route('good.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Barang</a>
                                </li>
                            @endcan
                            @can('jadwal.transaksi.semester.view')
                                <li>
                                    <a href="{{ route('schedule.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Jadwal Transaksi Semester</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownTransaction" data-dropdown-toggle="dropdownTransactionItem"
                        class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Transaksi
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownTransactionItem"
                        class="z-10 hidden mt-5 font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">

                            @can('transaksi.harian.view')
                                <li>
                                    <a href="{{ route('daily-transaction.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pengeluaran
                                        Barang</a>
                                </li>
                            @endcan
                            @can('transaksi.permohonan.pengadaan.barang.view')
                                <li>
                                    <a href="{{ route('semester-transaction.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Permohonan
                                        Pengadaan
                                        Barang</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}


                <li>
                    <button id="dropdownNavbarLinkReport" data-dropdown-toggle="dropdownNavbarReport"
                        class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Laporan
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbarReport"
                        class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                            aria-labelledby="dropdownLargeButton">
                            @can('laporan.mutasi.barang.view')
                                <li>
                                    <a href="{{ route('history-transaction.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Data
                                        Mutasi
                                        Barang </a>
                                </li>
                            @endcan
                            @can('laporan.opname.barang.view')
                                <li>
                                    <a href="{{ route('stock-opname.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Opname
                                        Barang </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li>
                    <button id="dropdownUserManagement" data-dropdown-toggle="dropdownUser"
                        class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">User
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownUser"
                        class="z-10 hidden mt-5 font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                            aria-labelledby="dropdownLargeButton">
                            @can('user.view')
                                <li>
                                    <a href="{{ route('user.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">User</a>
                                </li>
                            @endcan

                            @can('role.view')
                                <li>
                                    <a href="{{ route('role.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Role</a>
                                </li>
                            @endcan
                            @can('user.view')
                                <li>
                                    <a href="{{ route('permission.index') }}" wire:navigate
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Permission</a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    initFlowbite()
</script>

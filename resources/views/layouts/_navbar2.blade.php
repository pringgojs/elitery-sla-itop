<!-- ========== HEADER ========== -->
<header
    class="sticky top-4 inset-x-0 before:absolute before:inset-0 before:max-w-screen-xl before:mx-2 before:lg:mx-auto before:rounded-[26px] before:border before:border-gray-200 dark:border-neutral-700 after:absolute after:inset-0 after:-z-[1] after:max-w-screen-xl after:mx-2 after:lg:mx-auto after:rounded-[26px] after:bg-white dark:bg-neutral-900 flex flex-wrap md:justify-start md:flex-nowrap z-20 w-full">
    <nav
        class="relative max-w-screen-xl w-full md:flex md:items-center md:justify-between md:gap-3 ps-5 pe-2 mx-2 lg:mx-auto py-2">
        <!-- Logo w/ Collapse Button -->
        <div class="flex items-center justify-between">
            <a class="flex-none font-semibold text-xl text-black focus:outline-none focus:opacity-80 dark:text-white"
                href="{{ url('/') }}" aria-label="Brand">
                <img src="{{ asset('images/logo.png') }}" class="h-10 mr-3" alt="Flowbite Logo" />

            </a>

            <!-- Collapse Button -->
            <div class="md:hidden">
                <button type="button"
                    class="hs-collapse-toggle relative size-9 flex justify-center items-center text-sm font-semibold rounded-full border border-gray-200 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    id="hs-header-classic-collapse" aria-expanded="false" aria-controls="hs-header-classic"
                    aria-label="Toggle navigation" data-hs-collapse="#hs-header-classic">
                    <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg class="hs-collapse-open:block shrink-0 hidden size-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>
            <!-- End Collapse Button -->
        </div>
        <!-- End Logo w/ Collapse Button -->

        <!-- Collapse -->
        <div id="hs-header-classic"
            class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block"
            aria-labelledby="hs-header-classic-collapse">
            <div
                class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                <div class="py-2 md:py-0 flex flex-col md:flex-row md:items-center md:justify-end gap-0.5 md:gap-1">
                    <a class="p-2 flex items-center text-sm text-blue-600 focus:outline-none focus:text-blue-600 dark:text-blue-500 dark:focus:text-blue-500"
                        href="{{ url('/dashboard') }}" wire:navigate aria-current="page">
                        <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                            <path
                                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                        Dashboard
                    </a>
                    <a class="p-2 flex items-center text-sm text-gray-800 focus:outline-none focus:text-blue-600 dark:text-blue-500 dark:focus:text-blue-500"
                        href="{{ route('ticket.index') }}" wire:navigate aria-current="page">
                        Ticket
                    </a>
                    @can('menu.management.user')
                        <!-- Dropdown -->
                        <div
                            class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] [--is-collapse:true] md:[--is-collapse:false] ">
                            <button id="dropdown-hs-laporan-user" type="button"
                                class="hs-dropdown-toggle w-full p-2 flex items-center text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 10 2.5-2.5L3 5" />
                                    <path d="m3 19 2.5-2.5L3 14" />
                                    <path d="M10 6h11" />
                                    <path d="M10 12h11" />
                                    <path d="M10 18h11" />
                                </svg>
                                Management User and Role
                                <svg class="hs-dropdown-open:-rotate-180 md:hs-dropdown-open:rotate-0 duration-300 shrink-0 size-4 ms-auto md:ms-1"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative w-full md:w-52 hidden z-10 top-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md before:absolute before:-top-4 before:start-0 before:w-full before:h-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                                role="menu" aria-orientation="vertical" aria-labelledby="dropdown-hs-laporan-user">
                                <div class="py-1 md:px-1 space-y-0.5">
                                    @can('user.view')
                                        <a class="py-2.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                            href="{{ route('user.index') }}" wire:navigate>
                                            User
                                        </a>
                                    @endcan
                                    @can('role.view')
                                        <a class="py-2.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                            href="{{ route('role.index') }}" wire:navigate>
                                            Role
                                        </a>
                                    @endcan
                                    @can('permission.view')
                                        <a class="py-2.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                            href="{{ route('permission.index') }}" wire:navigate>
                                            Permission
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <!-- End Dropdown -->
                    @endcan
                    <!-- Button Group -->
                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] [--is-collapse:true] md:[--is-collapse:false] ">

                        <div id="hs-header-classic-dropdown-logout"
                            class="hs-dropdown-toggle relative flex flex-wrap items-center gap-x-1.5 md:ps-2.5  md:ms-1.5 before:block before:absolute before:top-1/2 before:-start-px before:w-px before:h-4 before:bg-gray-300 before:-translate-y-1/2 dark:before:bg-neutral-700">
                            <a class="p-2 w-full flex items-center font-bold text-sm text-gray-900 hover:text-gray-500 focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                                href="#">
                                <svg class="shrink-0 size-4 me-3 md:me-2" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                {{ auth()->user()->name }}
                            </a>
                        </div>
                        <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative w-full md:w-52 hidden z-10 top-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md before:absolute before:-top-4 before:start-0 before:w-full before:h-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                            role="menu" aria-orientation="vertical"
                            aria-labelledby="hs-header-classic-dropdown-logout">
                            <div class="py-1 md:px-1 space-y-0.5">
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                        class="py-2.5 px-2 flex items-center text-sm text-gray-800 hover:text-gray-500 hover:bg-gray-100 rounded-lg focus:outline-none focus:text-gray-500 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500">
                                        Keluar
                                    </a>
                                </form>
                            </div>
                        </div>
                        <!-- End Button Group -->
                    </div>
                </div>
            </div>
            <!-- End Collapse -->
    </nav>
    <script>
        window.HSStaticMethods.autoInit();
        initFlowbite()
    </script>
</header>
<!-- ========== END HEADER ========== -->

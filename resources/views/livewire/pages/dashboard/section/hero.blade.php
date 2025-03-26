<div class="relative">
    <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
        <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 lg:pb-48 lg:pt-40 xl:col-span-6">
            <div class="mx-auto max-w-lg lg:mx-0">
                <h1
                    class="mt-24 text-pretty text-5xl font-semibold tracking-tight text-gray-900 bg-clip-text text-transparent bg-gradient-to-r from-blue-500 via-green-500 to-purple-500 animate-gradient drop-shadow-lg sm:mt-10 sm:text-7xl">
                    Selamat datang di sistem ATK</h1>
                <p class="mt-8 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">Sistem ini dibuat dan
                    dikembangkan untuk memudahkan layanan pengeluaran barang ATK di BBPG Provinsi Jawa Timur.
                </p>
                <div class="mt-10 flex items-center gap-x-6">
                    <a href="https://drive.google.com/file/d/1ytARwv1OkNRaAhDrnKOGc5VH9KJx5v8p/view" target="_blank"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Unduh
                        Panduan</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-sm/6 font-semibold text-gray-900">Login ke aplikasi <span
                                aria-hidden="true">→</span></a>
                    @endguest
                </div>
            </div>
        </div>
        <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0">
            <img class="aspect-[3/2] w-full rounded-lg shadow-lg bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
                src="https://images.unsplash.com/photo-1487017159836-4e23ece2e4cf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2102&q=80"
                alt="">
        </div>
    </div>
</div>

<nav class="fixed top-0 left-0 right-0 max-w-screen-xl mx-auto p-6 z-50">
    <div class="bg-white p-4 rounded-lg shadow-lg" x-data="{ navOpen: false, userOpen: false }">
        <div class="flex items-center justify-between flex-wrap md:flex-nowrap">
            <!-- Logo -->
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">
                    Admin
                </a>
            </div>

            <!-- Menu for desktop -->
            <div class="hidden md:flex items-center gap-6 text-sm">
                <a href="#" class="hover:bg-gray-200 px-3 py-2 rounded-md">Dashboard</a>
                <a href="#" class="hover:bg-gray-200 px-3 py-2 rounded-md">Projects</a>
                <a href="#" class="hover:bg-gray-200 px-3 py-2 rounded-md">Blog</a>
            </div>

            <div class="flex items-center gap-4">
                <!-- User Dropdown -->
                <div class="ml-3 relative" @click.away="userOpen = false">
                    <button @click="userOpen = !userOpen" type="button"
                        class="flex px-2 py-1 items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">Open user menu</span>
                        <span class="font-medium mr-2">{{ Auth::user()->name }}</span>
                        <i class="fa-regular fa-square-caret-down"></i>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="userOpen" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 text-gray-700"
                        style="display: none;">
                        <a href="" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
                        <form method="POST" action="">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>

                <!-- Hamburger for mobile -->
                <div class="flex md:hidden">
                    <button @click="navOpen = !navOpen" type="button" class="focus:outline-none focus:ring-2">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!navOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="navOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu (shown when navOpen = true) -->
        <div class="md:hidden space-y-1 mt-5" x-show="navOpen" x-transition style="display: none;">
            <a href="#" class="block px-4 py-2 rounded-md hover:bg-gray-200">Dashboard</a>
            <a href="#" class="block px-4 py-2 rounded-md hover:bg-gray-200">Projects</a>
            <a href="#" class="block px-4 py-2 rounded-md hover:bg-gray-200">Blog</a>
        </div>
    </div>
</nav>

<nav x-data="navHandler()" class="fixed top-0 left-0 right-0 max-w-screen-xl mx-auto p-6 z-50">
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <div class="flex items-center justify-between flex-wrap md:flex-nowrap">
            <!-- Title -->
            <div>
                <h1 class="text-lg font-medium">Bimaryan</h1>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center gap-6 text-sm">
                @php
                    $navItems = [
                        ['name' => 'Projects', 'route' => 'projects'],
                        ['name' => 'Blog', 'route' => 'blog'],
                        ['name' => 'About', 'route' => 'about'],
                        ['name' => 'Contact', 'route' => 'contact'],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}" data-route="{{ route($item['route']) }}"
                        @click.prevent="loadContent($event)" class="group relative text-base transition text-gray-700">
                        {{ $item['name'] }}
                        <span
                            class="absolute left-0 -bottom-0.5 h-0.5 bg-gray-700 transition-all duration-300 w-0 group-hover:w-full"></span>
                    </a>
                @endforeach
            </div>

            <!-- Mobile Toggle -->
            <div class="md:hidden">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-default" :aria-expanded="open">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition.duration.300ms class="mt-4 flex flex-col gap-4 md:hidden text-sm"
            id="navbar-default">
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" data-route="{{ route($item['route']) }}"
                    @click.prevent="loadContent($event)"
                    class="group relative text-base transition {{ request()->routeIs($item['route']) ? 'text-black font-semibold' : 'text-gray-700' }}">
                    {{ $item['name'] }}
                    <span
                        class="absolute left-0 -bottom-0.5 h-0.5 bg-gray-700 transition-all duration-300 {{ request()->routeIs($item['route']) ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            @endforeach
        </div>
    </div>
</nav>

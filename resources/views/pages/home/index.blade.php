<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/f74deb4653.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>Bimaryan.my.id</title>
</head>

<body class="bg-gray-100" x-data="{ isMobile: window.innerWidth < 768 }" x-init="window.addEventListener('resize', () => { isMobile = window.innerWidth < 768; })" x-cloak>
    @include('components.navbar.navbar-home')

    <!-- MODE HANDPHONE -->
    <section x-show="isMobile" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4" class="max-w-screen-xl mx-auto p-6 mt-10 pt-20 space-y-4">
        <div class="bg-white rounded-lg shadow-lg p-4 space-y-2">
            <div class="flex justify-center">
                <img src="{{ asset('images/profile/my.png') }}" class="w-50 h-50 rounded-full object-cover"
                    alt="foto saya" />
            </div>
            <h1 class="text-1xl text-center font-bold">Bima Ryan Alfarizi</h1>
            <p class="text-sm text-center text-gray-500">
                I'm a junior software engineer from Indonesia.
            </p>
        </div>
        <div id="page-content-mobile">
            @yield('content')
        </div>
    </section>
    <!-- END MODE HANDPHONE -->

    <!-- MODE PC -->
    <section x-show="!isMobile" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4" class="max-w-screen-xl mx-auto p-6 mt-10 pt-20">
        <div class="flex gap-2">
            <!-- PROFILE -->
            <div class="w-[400px]">
                <div class="bg-white rounded-lg shadow-lg p-4 space-y-4">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/profile/my.png') }}" class="w-50 h-50 rounded-full object-cover"
                            alt="foto saya" />
                    </div>
                    <div class="space-y-3">
                        <h1 class="text-1xl font-bold">Bima Ryan Alfarizi</h1>
                        <p class="text-sm">I'm a junior software engineer from Indonesia.</p>
                        <ul class="space-y-2">
                            <li>
                                <a class="text-sm hover:underline" target="_blank" rel="noopener noreferrer"
                                    href="https://www.bimaryan.my.id">
                                    <i class="fa-regular text-lg text-gray-500 fa-building mr-2"></i> BimaRyan.my.id
                                </a>
                            </li>
                            <li>
                                <a target="_blank" rel="noopener noreferrer" class="text-sm hover:underline">
                                    <i class="fa-solid text-lg fa-location-dot mr-2 text-gray-500"></i> Indramayu,
                                    Jawabarat, Indonesia
                                </a>
                            </li>
                            <li>
                                <a href="https://instagram.com/bima_ryan23" target="_blank" rel="noopener noreferrer"
                                    class="text-sm hover:underline">
                                    <i class="fa-brands text-lg fa-instagram mr-2 text-gray-500"></i> @bima_ryan23
                                </a>
                            </li>
                            <li>
                                <a href="https://tiktok.com/@bimz_2301" target="_blank" rel="noopener noreferrer"
                                    class="text-sm hover:underline">
                                    <i class="fa-brands text-lg fa-tiktok mr-2 text-gray-500"></i> @bimz_2301
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PROFILE -->

            <!-- CONTENT MODE PC -->
            <div id="page-content-pc" class="w-full">
                @yield('content')
            </div>
            <!-- END CONTENT MODE PC -->
        </div>
    </section>
    <!-- END MODE PC -->

    <!-- Script AJAX untuk SPA -->
    <script>
        function navHandler() {
            return {
                open: false,

                loadContent(event) {
                    event.preventDefault();
                    const target = event.target.closest('a');
                    if (!target) return;
                    const route = target.getAttribute('data-route');
                    if (!route) return;

                    fetch(route)
                        .then(res => res.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            // Cari konten di mobile atau PC
                            const newContent = doc.querySelector('#page-content-mobile') || doc.querySelector(
                                '#page-content-pc');
                            const isMobile = window.innerWidth < 768;
                            const currentContent = document.querySelector(isMobile ? '#page-content-mobile' :
                                '#page-content-pc');

                            if (newContent && currentContent) {
                                currentContent.innerHTML = newContent.innerHTML;
                            }

                            window.history.pushState({}, '', route);
                            this.setActiveLink();
                            this.open = false;
                        })
                        .catch(err => console.error('Load content error:', err));
                },

                loadInitialContent(route) {
                    fetch(route)
                        .then(res => res.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            const newContent = doc.querySelector('#page-content-mobile') || doc.querySelector(
                                '#page-content-pc');
                            const isMobile = window.innerWidth < 768;
                            const currentContent = document.querySelector(isMobile ? '#page-content-mobile' :
                                '#page-content-pc');

                            if (newContent && currentContent) {
                                currentContent.innerHTML = newContent.innerHTML;
                            }

                            window.history.replaceState({}, '', route);
                            this.setActiveLink();
                        })
                        .catch(err => console.error('Load initial content error:', err));
                },

                setActiveLink() {
                    const links = document.querySelectorAll('[data-route]');
                    links.forEach(link => {
                        const path = new URL(link.dataset.route, window.location.origin).pathname;
                        const isActive = window.location.pathname === path;

                        link.classList.toggle('text-black', isActive);
                        link.classList.toggle('font-semibold', isActive);
                        link.classList.toggle('text-gray-700', !isActive);

                        const span = link.querySelector('span');
                        if (span) {
                            span.classList.toggle('w-full', isActive);
                            span.classList.toggle('w-0', !isActive);
                        }
                    });
                },

                init() {
                    // Jika akses '/', otomatis load konten /profile
                    if (window.location.pathname === '/') {
                        this.loadInitialContent('/projects');
                    } else {
                        this.loadInitialContent(window.location.pathname);
                    }

                    window.addEventListener('popstate', () => {
                        this.loadInitialContent(window.location.pathname);
                    });
                }
            };
        }

        // Jalankan init saat DOM siap
        document.addEventListener('alpine:init', () => {
            Alpine.data('navHandler', navHandler);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>

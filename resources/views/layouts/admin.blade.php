<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Admin Prasi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.jpg') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/icon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body x-data="{ sidebarOpen: false }" class="bg-gray-50 text-gray-800 font-sans">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-gray-100 transform transition-transform duration-300 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-5 border-b border-gray-700">
                <h1 class="text-lg font-semibold tracking-widest text-yellow-400">PRASI ADMIN</h1>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Nav -->
            <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto text-sm">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <span>Produk</span>
                </a>

                <hr class="my-2 border-gray-700">

                <a href="{{ route('admin.social-media.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->routeIs('admin.social-media.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <span>Social Media</span>
                </a>

                <a href="{{ route('admin.ecommerce-links.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->routeIs('admin.ecommerce-links.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <span>E-Commerce Links</span>
                </a>

                <a href="{{ route('admin.news.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->routeIs('admin.news.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <span>News</span>
                </a>

                <a href="{{ route('admin.contact-messages.index') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md transition-colors {{ request()->routeIs('admin.contact-messages.*') ? 'bg-yellow-500 text-gray-900 font-semibold' : 'hover:bg-gray-800 text-gray-300' }}">
                    <span>Pesan Masuk</span>
                </a>

                <hr class="my-2 border-gray-700">

                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-800 text-gray-300">
                    <span>Lihat Website</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-3 w-full px-3 py-2 rounded-md hover:bg-gray-800 text-gray-300">
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- OVERLAY (MOBILE) -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-transition.opacity></div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col lg:ml-64">

            <!-- HEADER -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-40 shadow-sm">
                <div class="flex items-center justify-between h-16 px-6">
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h1 class="text-lg font-semibold">@yield('page-title', 'Dashboard')</h1>
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- MAIN BODY -->
            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-2 rounded-md text-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-2 rounded-md text-sm mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>

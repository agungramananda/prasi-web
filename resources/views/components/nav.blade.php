<header class="border-b border-brand-stone bg-white/90 backdrop-blur-sm sticky top-0 z-40" x-data="{ mobileMenuOpen: false }">
    <nav class="max-w-7xl mx-auto px-4 md:px-8 h-16 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-9 h-9 bg-brand-radial flex items-center justify-center">
                <span class="text-xs tracking-widest font-semibold text-brand-gold">PRASI</span>
            </div>
            <div class="flex flex-col leading-tight">
                <span class="text-sm uppercase tracking-[0.25em] text-brand-navy font-semibold">{{ __('Heritage You Can Hold') }}</span>
                <span class="text-[10px] tracking-wider text-brand-gold">{{ __('Etnik . Elegan . Timeless') }}</span>
            </div>
        </a>
        <button class="md:hidden p-2 rounded-md border border-brand-stone text-brand-navy" @click="mobileMenuOpen = !mobileMenuOpen">
            <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
        <div class="hidden md:flex items-center gap-1">
            @php($linkClasses = 'inline-flex items-center gap-2 px-4 py-2 text-sm rounded-md transition-colors duration-200')
            <a href="{{ route('home') }}" class="{{ $linkClasses }} {{ request()->routeIs('home') ? 'text-brand-gold bg-brand-navy/5' : 'text-brand-navy hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10.5 12 3l9 7.5"/><path d="M5 10v9a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1v-9"/></svg>
                <span>{{ __('Beranda') }}</span>
            </a>
            <a href="{{ route('about') }}" class="{{ $linkClasses }} {{ request()->routeIs('about') ? 'text-brand-gold bg-brand-navy/5' : 'text-brand-navy hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                <span>{{ __('Tentang') }}</span>
            </a>
            <a href="{{ route('products') }}" class="{{ $linkClasses }} {{ request()->routeIs('products') ? 'text-brand-gold bg-brand-navy/5' : 'text-brand-navy hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                <span>{{ __('Produk') }}</span>
            </a>
            <a href="{{ route('news.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('news.*') ? 'text-brand-gold bg-brand-navy/5' : 'text-brand-navy hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h13a2 2 0 0 1 2 2v12"/><path d="M7 8h9"/><path d="M7 12h9"/><path d="M7 16h9"/><path d="M3 20h16a2 2 0 0 0 2-2v-1H5a2 2 0 0 0-2 2v1z"/></svg>
                <span>{{ __('Berita') }}</span>
            </a>
            <a href="{{ route('contact') }}" class="{{ $linkClasses }} {{ request()->routeIs('contact') ? 'text-brand-gold bg-brand-navy/5' : 'text-brand-navy hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v2a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.08 4.18 2 2 0 0 1 4 2h2a2 2 0 0 1 2 1.72c.12.86.33 1.7.62 2.5a2 2 0 0 1-.45 2.11L7.1 9.9a16 16 0 0 0 6 6l1.57-1.07a2 2 0 0 1 2.11-.45c.8.29 1.64.5 2.5.62A2 2 0 0 1 22 16.92z"/></svg>
                <span>{{ __('Kontak') }}</span>
            </a>
            
            <div class="ml-4 flex items-center gap-2">
                @foreach(['id' => 'ID', 'en' => 'EN'] as $loc => $label)
                    <a href="{{ route('lang.switch', ['locale' => $loc, 'redirect' => request()->fullUrl()]) }}" class="text-xs px-2 py-1 rounded {{ app()->getLocale() === $loc ? 'bg-brand-navy text-brand-gold' : 'text-brand-navy hover:text-brand-gold border border-transparent hover:border-brand-stone' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>
    </nav>
    <div x-show="mobileMenuOpen" x-transition class="md:hidden border-t border-brand-stone bg-white">
        <div class="px-4 py-4 space-y-2">
            @php($mobileClasses='flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium')
            <a href="{{ route('home') }}" class="{{ $mobileClasses }} {{ request()->routeIs('home') ? 'bg-brand-navy/5 text-brand-gold' : 'text-brand-navy hover:bg-brand-navy/5 hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10.5 12 3l9 7.5"/><path d="M5 10v9a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1v-9"/></svg>
                <span>{{ __('Beranda') }}</span>
            </a>
            <a href="{{ route('about') }}" class="{{ $mobileClasses }} {{ request()->routeIs('about') ? 'bg-brand-navy/5 text-brand-gold' : 'text-brand-navy hover:bg-brand-navy/5 hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                <span>{{ __('Tentang') }}</span>
            </a>
            <a href="{{ route('products') }}" class="{{ $mobileClasses }} {{ request()->routeIs('products') ? 'bg-brand-navy/5 text-brand-gold' : 'text-brand-navy hover:bg-brand-navy/5 hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                <span>{{ __('Produk') }}</span>
            </a>
            <a href="{{ route('news.index') }}" class="{{ $mobileClasses }} {{ request()->routeIs('news.*') ? 'bg-brand-navy/5 text-brand-gold' : 'text-brand-navy hover:bg-brand-navy/5 hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h13a2 2 0 0 1 2 2v12"/><path d="M7 8h9"/><path d="M7 12h9"/><path d="M7 16h9"/><path d="M3 20h16a2 2 0 0 0 2-2v-1H5a2 2 0 0 0-2 2v1z"/></svg>
                <span>{{ __('Berita') }}</span>
            </a>
            <a href="{{ route('contact') }}" class="{{ $mobileClasses }} {{ request()->routeIs('contact') ? 'bg-brand-navy/5 text-brand-gold' : 'text-brand-navy hover:bg-brand-navy/5 hover:text-brand-gold' }}">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v2a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.08 4.18 2 2 0 0 1 4 2h2a2 2 0 0 1 2 1.72c.12.86.33 1.7.62 2.5a2 2 0 0 1-.45 2.11L7.1 9.9a16 16 0 0 0 6 6l1.57-1.07a2 2 0 0 1 2.11-.45c.8.29 1.64.5 2.5.62A2 2 0 0 1 22 16.92z"/></svg>
                <span>{{ __('Kontak') }}</span>
            </a>
            
            <div class="flex gap-2 pt-2">
                @foreach(['id' => 'ID', 'en' => 'EN'] as $loc => $label)
                    <a href="{{ route('lang.switch', ['locale' => $loc, 'redirect' => request()->fullUrl()]) }}" class="text-xs px-2 py-1 rounded border {{ app()->getLocale() === $loc ? 'bg-brand-navy text-brand-gold border-brand-navy' : 'border-brand-stone text-brand-navy hover:text-brand-gold' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>
    </div>
</header>

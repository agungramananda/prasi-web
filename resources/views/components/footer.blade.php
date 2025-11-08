<footer class="border-t border-brand-stone bg-white mt-16">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-10 grid gap-8 md:grid-cols-4">
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded bg-brand-radial flex items-center justify-center">
                    <span class="text-[10px] font-semibold tracking-widest text-brand-gold">PRASI</span>
                </div>
                <span class="text-sm font-medium tracking-wider text-brand-navy">{{ __('Heritage you can hold') }}</span>
            </div>
            <p class="text-xs leading-relaxed text-brand-navy/70">{{ __('Melestarikan tradisi Bali yang abadi.') }}</p>
        </div>
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-wider text-brand-navy mb-3">{{ __('Navigasi') }}</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-brand-gold">{{ __('Beranda') }}</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-brand-gold">{{ __('Tentang') }}</a></li>
                <li><a href="{{ route('products') }}" class="hover:text-brand-gold">{{ __('Produk') }}</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-brand-gold">{{ __('Kontak') }}</a></li>
            </ul>
        </div>
        @if(isset($socialMedia) && $socialMedia->count() > 0)
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-brand-navy mb-3">{{ __('Sosial') }}</h3>
                <ul class="space-y-2 text-sm">
                    @foreach($socialMedia as $social)
                        <li><a href="{{ $social->url }}" target="_blank" class="hover:text-brand-gold">{{ $social->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(isset($ecommerceLinks) && $ecommerceLinks->count() > 0)
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wider text-brand-navy mb-3">{{ __('Marketplace') }}</h3>
                <ul class="space-y-2 text-sm">
                    @foreach($ecommerceLinks as $link)
                        <li><a href="{{ $link->url }}" target="_blank" class="hover:text-brand-gold">{{ $link->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="border-t border-brand-stone/70 py-4 text-center">
        <p class="text-xs text-brand-navy/60">&copy; {{ date('Y') }} Prasi. {{ __('Semua Hak Dilindungi') }}</p>
    </div>
</footer>

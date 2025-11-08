@extends('layouts.app')

@section('title', __('Beranda'))

@section('content')

<section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-16 md:py-24 grid md:grid-cols-2 gap-10 items-center">
        <div>
                <h1 class="text-4xl md:text-5xl font-semibold tracking-tight text-brand-navy">{{ __('Suvenir Khas Bali Berbahan Dasar Daun Lontar') }}</h1>
                <p class="mt-4 text-brand-navy/70 text-lg leading-relaxed">{{ __('Bukan sekadar karya seni, tetapi warisan budaya Bali yang terus hidup dalam setiap genggaman') }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('products') }}" class="inline-flex items-center px-6 py-3 rounded-md bg-brand-gold text-brand-navy font-semibold shadow-subtle hover:shadow-elevated transition">{{ __('Belanja Sekarang') }}</a>
                    <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 rounded-md border border-brand-stone text-brand-navy hover:border-brand-gold hover:text-brand-gold transition">{{ __('Tentang Kami') }}</a>
                </div>
            <div class="mt-8 h-1 w-24 bg-brand-gold"></div>
        </div>
        <div class="aspect-[4/3] md:aspect-auto bg-brand-radial rounded-lg shadow-subtle overflow-hidden relative fade-in-up" data-animate>
           <img src="{{ asset('images/Prasi.jpg') }}" alt="{{ __('PRASI') }}" class="w-full h-full object-cover">
        </div>
    </div>
</section>

@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<section class="bg-brand-sand">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-14">
        <div class="flex items-end justify-between gap-6 mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-semibold text-brand-navy">{{ __('Produk Unggulan') }}</h2>
                <div class="mt-2 h-0.5 w-16 bg-brand-gold"></div>
            </div>
            <a href="{{ route('products') }}" class="text-sm text-brand-navy hover:text-brand-gold">{{ __('Lihat semua') }}</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProducts as $product)
            <div class="group bg-white rounded-lg border border-brand-stone/60 shadow-subtle hover:shadow-elevated transition overflow-hidden">
                <div class="h-56 bg-brand-sand/60 overflow-hidden">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->getTranslation('name', app()->getLocale()) }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition" loading="lazy" decoding="async" />
                    @else
                        <div class="h-full w-full flex items-center justify-center">
                            <span class="text-brand-navy/30 text-sm">{{ __('Tanpa gambar') }}</span>
                        </div>
                    @endif
                </div>
                <div class="p-5">
                    @if($product->category)
                        <span class="inline-block text-[10px] tracking-wider uppercase text-brand-navy/60">{{ $product->category }}</span>
                    @endif
                    <h3 class="mt-1 text-lg font-medium text-brand-navy group-hover:text-brand-gold transition">{{ $product->getTranslation('name', app()->getLocale()) }}</h3>
                    <p class="mt-2 text-sm text-brand-navy/70 line-clamp-2">{{ $product->getTranslation('description', app()->getLocale()) }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        @if($product->price)
                        <span class="text-brand-gold font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                        <a href="{{ route('products') }}" class="text-sm text-brand-navy hover:text-brand-gold">{{ __('Detail') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </section>
@endif

@if(isset($news) && $news->count() > 0)
<section class="bg-white" x-data="{ ready: false }" x-init="ready = true">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-14">
    <div class="flex items-end justify-between gap-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-semibold text-brand-navy fade-in-up" data-animate>{{ __('News') }}</h2>
            <div class="mt-2 h-0.5 w-16 bg-brand-gold fade-in" data-animate></div>
        </div>
        <a href="{{ route('news.index') }}" class="text-sm text-brand-navy hover:text-brand-gold fade-in" data-animate>{{ __('Lihat semua') }}</a>
    </div>
        <div class="mt-8 swiper-container gallery-swiper" data-gallery>
            <div class="swiper-wrapper">
                @foreach($news as $item)
                @php($excerpt = \Illuminate\Support\Str::limit(strip_tags($item->getTranslation('content', app()->getLocale())), 120))
                <div class="swiper-slide">
                    <a href="{{ route('news.show', $item->slug) }}" class="block group rounded-lg overflow-hidden border border-brand-stone/60 bg-brand-sand/40 relative h-72">
                        <img src="{{ $item->header_image_url }}" alt="News image" class="w-full h-full object-cover group-hover:scale-[1.03] transition" loading="lazy" decoding="async" />
                        @if($excerpt || $item->tags)
                        <div class="absolute left-0 bottom-0 w-full bg-black/40 backdrop-blur-sm p-3 text-xs text-white">
                            @if(is_array($item->tags) && count($item->tags))
                                <div class="mb-1 flex flex-wrap gap-1">
                                    @foreach($item->tags as $tag)
                                        <span class="inline-block bg-brand-gold text-brand-navy/90 px-2 py-0.5 rounded text-[10px]">#{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if($excerpt)
                                <div class="text-white/80 line-clamp-2">{{ $excerpt }}</div>
                            @endif
                        </div>
                        @endif
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-prev after:!text-lg"></div>
            <div class="swiper-button-next after:!text-lg"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif

<!-- CTA minimal -->
<section class="bg-brand-sand fade-in-up" data-animate>
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-14 text-center">
        <h3 class="text-2xl md:text-3xl font-semibold text-brand-navy">{{ __('Heritage you can hold') }}</h3>
        <p class="mt-3 text-brand-navy/70 max-w-2xl mx-auto">{{ __('Setiap karya membawa jiwa tradisi Bali. Diciptakan dengan penuh ketelitian, menjaga warisan budaya tetap hidup di genggamanmu.') }}</p>
        <div class="mt-6">
            <a href="{{ route('products') }}" class="inline-flex items-center px-6 py-3 rounded-md bg-brand-gold text-brand-navy font-semibold shadow-subtle hover:shadow-elevated transition">{{ __('Jelajahi Koleksi') }}</a>
        </div>
    </div>
</section>

@endsection
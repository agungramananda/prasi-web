@extends('layouts.app')

@section('title', __('Produk Kami'))

@section('content')

<!-- Page Header (minimal) -->
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <h1 class="text-3xl md:text-4xl font-semibold text-brand-navy">{{ __('Koleksi Produk') }}</h1>
        <div class="mt-2 h-0.5 w-16 bg-brand-gold"></div>
    <p class="mt-4 text-brand-navy/70 max-w-3xl">{{ __('Suvenir khas Bali yang dibuat dengan detail, memadukan tradisi dan gaya modern. Pilih favoritmu.') }}</p>
    </div>
</section>

<!-- Products Grid -->
<section class="bg-brand-sand">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
        
        @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="group bg-white rounded-lg border border-brand-stone/60 shadow-subtle hover:shadow-elevated transition overflow-hidden">
                @if($product->image)
                <div class="h-64 overflow-hidden bg-brand-sand/60">
                <img src="{{ $product->image_url }}" 
                    alt="{{ $product->getTranslation('name', app()->getLocale()) }}" 
                    loading="lazy" decoding="async"
                    class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300">
                </div>
                @else
                <div class="h-64 bg-brand-sand flex items-center justify-center">
                    <span class="text-brand-navy/30 text-sm">{{ __('Tanpa gambar') }}</span>
                </div>
                @endif
                
                <div class="p-6">
                    @if($product->category)
                    <span class="inline-block text-[10px] tracking-wider uppercase text-brand-navy/60 mb-2">
                        {{ $product->category }}
                    </span>
                    @endif
                    
                    <h3 class="text-lg font-medium text-brand-navy mb-1 group-hover:text-brand-gold transition-colors">
                        {{ $product->getTranslation('name', app()->getLocale()) }}
                    </h3>
                    
                    <p class="text-brand-navy/70 text-sm mb-4 line-clamp-3">
                        {{ $product->getTranslation('description', app()->getLocale()) }}
                    </p>
                    
                    @if($product->price)
                    <div class="mt-4">
                        <span class="text-base font-semibold text-brand-gold">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $products->links() }}
        </div>

        @else
        <div class="text-center py-16">
            <div class="text-5xl text-brand-navy/10 mb-4">📦</div>
            <h3 class="text-xl font-semibold text-brand-navy mb-2">{{ __('Belum Ada Produk') }}</h3>
            <p class="text-brand-navy/60">{{ __('Produk akan segera tersedia') }}</p>
        </div>
        @endif

    </div>
</section>

<!-- E-commerce Links Section -->
@if($ecommerceLinks->count() > 0)
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-semibold text-brand-navy mb-3">
                {{ __('Belanja di Platform Favorit Anda') }}
            </h2>
            <p class="text-brand-navy/70">{{ __('Produk kami juga tersedia di berbagai marketplace terpercaya') }}</p>
        </div>
        
        <div class="flex flex-wrap justify-center gap-4">
            @foreach($ecommerceLinks as $link)
            <a href="{{ $link->url }}" 
               target="_blank"
               class="flex items-center px-6 py-3 bg-white rounded-md border border-brand-stone hover:border-brand-gold shadow-subtle hover:shadow-elevated transition">
                <span class="font-medium text-brand-navy">{{ $link->name }}</span>
                <svg class="w-5 h-5 ml-2 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

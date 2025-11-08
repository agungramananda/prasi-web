@extends('layouts.app')

@section('title', $item->getTranslation('name', app()->getLocale()))

@section('content')
<article class="max-w-5xl mx-auto px-4 md:px-8 py-12">
    <div class="mb-6">
        <a href="{{ route('products') }}" class="text-sm text-brand-navy hover:text-brand-gold">← {{ __('Kembali ke Produk') }}</a>
    </div>

    <header class="mb-8">
        <h1 class="text-3xl md:text-4xl font-semibold text-brand-navy">{{ $item->getTranslation('name', app()->getLocale()) }}</h1>
        @if($item->category)
            <div class="mt-2 text-sm text-brand-navy/60">{{ $item->category }}</div>
        @endif
    </header>

    @if($item->image_url)
    <figure class="mb-10 rounded-lg overflow-hidden border border-brand-stone/60 shadow-subtle">
        <img src="{{ $item->image_url }}" alt="{{ $item->getTranslation('name', app()->getLocale()) }}" class="w-full max-h-[480px] object-cover" />
    </figure>
    @endif

    <div class="prose max-w-none prose-img:rounded-md prose-headings:font-semibold prose-a:text-brand-gold">
        {!! $item->getTranslation('description', app()->getLocale()) !!}
    </div>

    @if($item->price)
    <div class="mt-6">
        <span class="text-2xl font-semibold text-brand-gold">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
    </div>
    @endif

    @if($related->count())
    <section class="mt-16">
        <h2 class="text-xl font-semibold text-brand-navy mb-4">{{ __('Produk Lainnya') }}</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($related as $r)
            <a href="{{ route('products.show', $r->slug) }}" class="group bg-white rounded-lg border border-brand-stone/60 shadow-subtle hover:shadow-elevated overflow-hidden flex flex-col">
                <div class="h-40 bg-brand-sand/50 overflow-hidden">
                    @if($r->image_url)
                        <img src="{{ $r->image_url }}" alt="{{ $r->getTranslation('name', app()->getLocale()) }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition" />
                    @else
                        <div class="h-full w-full flex items-center justify-center text-brand-navy/40 text-xs">{{ __('Tanpa gambar') }}</div>
                    @endif
                </div>
                <div class="p-4 flex-1 flex flex-col">
                    <h3 class="font-medium text-brand-navy line-clamp-2 group-hover:text-brand-gold">{{ $r->getTranslation('name', app()->getLocale()) }}</h3>
                    <p class="mt-2 text-xs text-brand-navy/70 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($r->getTranslation('description', app()->getLocale())), 90) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

</article>
@endsection

@extends('layouts.app')

@section('title', $item->title)

@section('content')
<article class="max-w-5xl mx-auto px-4 md:px-8 py-12">
    <div class="mb-6">
        <a href="{{ route('news.index') }}" class="text-sm text-brand-navy hover:text-brand-gold">← {{ __('Kembali ke News') }}</a>
    </div>
    <header class="mb-8">
    <h1 class="text-3xl md:text-4xl font-semibold text-brand-navy">{{ $item->getTranslation('title', app()->getLocale()) }}</h1>
        <div class="mt-3 flex flex-wrap items-center gap-4 text-sm text-brand-navy/60">
            <span>{{ $item->published_at? $item->published_at->format('d M Y H:i') : __('Draft') }}</span>
            @if(is_array($item->tags) && count($item->tags))
                <span class="flex flex-wrap gap-2 items-center">
                    @foreach($item->tags as $tag)
                        <a href="{{ route('news.index', ['tag' => $tag]) }}" class="px-2 py-0.5 rounded bg-brand-gold text-[11px] text-brand-navy/90 hover:brightness-110">#{{ $tag }}</a>
                    @endforeach
                </span>
            @endif
        </div>
    </header>
    @if($item->header_image_url)
    <figure class="mb-10 rounded-lg overflow-hidden border border-brand-stone/60 shadow-subtle">
        <img src="{{ $item->header_image_url }}" alt="{{ $item->title }}" class="w-full max-h-[480px] object-cover" />
    </figure>
    @endif

    <div class="prose max-w-none prose-img:rounded-md prose-headings:font-semibold prose-a:text-brand-gold">
        {!! $item->getTranslation('content', app()->getLocale()) !!}
    </div>

    @if($related->count())
    <section class="mt-16">
        <h2 class="text-xl font-semibold text-brand-navy mb-4">{{ __('Berita Lainnya') }}</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($related as $r)
            <a href="{{ route('news.show', $r->slug) }}" class="group bg-white rounded-lg border border-brand-stone/60 shadow-subtle hover:shadow-elevated overflow-hidden flex flex-col">
                <div class="h-40 bg-brand-sand/50 overflow-hidden">
                    @if($r->header_image_url)
                        <img src="{{ $r->header_image_url }}" alt="{{ $r->title }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition" />
                    @else
                        <div class="h-full w-full flex items-center justify-center text-brand-navy/40 text-xs">{{ __('Tanpa gambar') }}</div>
                    @endif
                </div>
                <div class="p-4 flex-1 flex flex-col">
                    <div class="text-[11px] uppercase tracking-wide text-brand-navy/50 mb-1">{{ $r->published_at ? $r->published_at->format('d M Y') : __('Draft') }}</div>
            <h3 class="font-medium text-brand-navy line-clamp-2 group-hover:text-brand-gold">{{ $r->getTranslation('title', app()->getLocale()) }}</h3>
            <p class="mt-2 text-xs text-brand-navy/70 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($r->getTranslation('content', app()->getLocale())), 90) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</article>
@endsection

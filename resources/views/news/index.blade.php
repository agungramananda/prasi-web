@extends('layouts.app')

@section('title', __('News'))

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <h1 class="text-3xl font-semibold text-brand-navy">{{ __('News') }}</h1>
    <div class="mt-2 h-0.5 w-20 bg-brand-gold"></div>

    @if($news->count() === 0)
        <div class="mt-10 p-10 text-center rounded bg-white border border-brand-stone/60 text-brand-navy/70">{{ __('Tidak ada berita') }}</div>
    @else
    <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($news as $item)
            <article class="group bg-white rounded-lg border border-brand-stone/60 shadow-subtle hover:shadow-elevated transition overflow-hidden flex flex-col">
                <div class="h-48 bg-brand-sand/50 overflow-hidden">
                    @if($item->header_image_url)
                        <img src="{{ $item->header_image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-[1.03] transition" />
                    @else
                        <div class="h-full w-full flex items-center justify-center text-brand-navy/40 text-sm">{{ __('Tanpa gambar') }}</div>
                    @endif
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <div class="text-xs uppercase tracking-wide text-brand-navy/50 mb-1">{{ $item->published_at ? $item->published_at->format('d M Y') : __('Draft') }}</div>
                    <h2 class="font-semibold text-brand-navy line-clamp-2"><a href="{{ route('news.show', $item->slug) }}" class="hover:text-brand-gold">{{ $item->getTranslation('title', app()->getLocale()) }}</a></h2>
                    <p class="mt-2 text-sm text-brand-navy/70 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($item->getTranslation('content', app()->getLocale())), 150) }}</p>
                    @if(is_array($item->tags) && count($item->tags))
                    <div class="mt-3 flex flex-wrap gap-1">
                        @foreach($item->tags as $tag)
                            <a href="{{ route('news.index', ['tag' => $tag]) }}" class="px-2 py-0.5 rounded bg-brand-gold text-[10px] text-brand-navy/90 hover:brightness-110">{{ $tag }}</a>
                        @endforeach
                    </div>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('news.show', $item->slug) }}" class="inline-flex items-center text-sm text-brand-navy hover:text-brand-gold">{{ __('Baca selengkapnya') }} →</a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-10">{{ $news->links() }}</div>
    @endif
</div>
@endsection

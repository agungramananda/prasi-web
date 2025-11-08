@extends('layouts.admin')

@section('title', __('News'))

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-10">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-brand-navy">{{ __('News') }}</h1>
        <a href="{{ route('admin.news.create') }}"
           class="px-4 py-2 rounded-md bg-brand-gold text-brand-navy font-medium shadow-subtle hover:shadow-elevated">
            + {{ __('Tambah') }}
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.news.index') }}" class="mb-6 flex flex-wrap gap-3 items-end">
        {{-- Search --}}
        <div>
            <label class="block text-xs font-medium mb-1 text-brand-navy/70">{{ __('Cari') }}</label>
            <input type="text" name="q" value="{{ $search ?? '' }}"
                   placeholder="{{ __('Judul atau konten') }}"
                   class="px-3 py-2 rounded border border-brand-stone/60 bg-white shadow-subtle 
                          focus:outline-none focus:ring-2 focus:ring-brand-gold/50 text-sm" />
        </div>

        {{-- Buttons --}}
        <div class="flex gap-2">
            <button class="px-4 h-10 rounded-md bg-brand-gold text-brand-navy font-semibold shadow-subtle 
                           hover:shadow-elevated text-sm">
                {{ __('Filter') }}
            </button>

            @if(($search ?? false) || ($tag ?? false))
                <a href="{{ route('admin.news.index') }}"
                   class="px-4 h-10 flex items-center rounded-md border border-brand-stone text-brand-navy text-sm 
                          hover:border-brand-gold hover:text-brand-gold">
                    {{ __('Reset') }}
                </a>
            @endif
        </div>
    </form>

    {{-- No Data --}}
    @if($news->count() === 0)
        <div class="p-10 text-center rounded bg-white border border-brand-stone/60 text-brand-navy/70">
            {{ __('Belum Ada Data') }}
        </div>
    @else
        {{-- News Grid --}}
        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($news as $item)
                <div class="group bg-white rounded-lg border border-brand-stone/50 shadow-subtle hover:shadow-elevated transition overflow-hidden flex flex-col">

                    {{-- Header Image with overlay badges --}}
                    <div class="relative overflow-hidden bg-brand-sand/20">
                        <div class="aspect-[16/9] w-full bg-center bg-cover transition-transform group-hover:scale-[1.03]" style="background-image: url('{{ $item->header_image_url ?? '' }}')">
                            @if(!$item->header_image_url)
                                <div class="w-full h-full flex items-center justify-center text-brand-navy/40 text-sm">{{ __('No image') }}</div>
                            @endif
                        </div>

                        {{-- Date / Draft badge --}}
                        <div class="absolute left-3 top-3">
                            <span class="inline-flex items-center px-2 py-1 rounded bg-white/90 text-xs font-semibold text-brand-navy/80">
                                {{ $item->published_at ? $item->published_at->format('d M Y') : __('DRAFT') }}
                            </span>
                        </div>

                        {{-- Action buttons small (delete) --}}
                        <div class="absolute right-3 top-3 flex items-center space-x-2">
                            <a href="{{ route('admin.news.edit', $item) }}" class="inline-flex items-center justify-center w-8 h-8 rounded bg-white/90 text-brand-navy hover:bg-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded bg-white/90 text-red-600 hover:bg-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- News Content --}}
                    <div class="p-4 flex-1 flex flex-col">
                        <h2 class="font-semibold text-brand-navy text-lg leading-snug mb-2 line-clamp-2">{{ $item->title }}</h2>

                        <p class="mt-1 text-sm text-brand-navy/70 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 140) }}</p>

                        {{-- Tags --}}
                        @if(is_array($item->tags) && count($item->tags))
                            <div class="mt-3 flex flex-wrap gap-1">
                                @foreach($item->tags as $tag)
                                    <span class="px-2 py-0.5 rounded bg-brand-gold text-[10px] text-brand-navy/90">#{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Footer (Status + optional preview) --}}
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-medium {{ $item->is_active ? 'text-green-600' : 'text-red-600' }}">{{ $item->is_active ? __('Aktif') : __('Nonaktif') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $news->links() }}
        </div>
    @endif
</div>
@endsection

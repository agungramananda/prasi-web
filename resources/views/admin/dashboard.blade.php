@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-10">
    <!-- Stat Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @php($cards = [
            ['label' => 'Produk', 'value' => $stats['products'], 'sub' => $stats['active_products'].' aktif'],
            ['label' => 'Produk Unggulan', 'value' => $stats['featured_products'], 'sub' => null],
            ['label' => 'News', 'value' => $stats['news'], 'sub' => null],
            ['label' => 'Pesan', 'value' => $stats['messages'], 'sub' => $stats['unread_messages'].' belum dibaca'],
            ['label' => 'Social Media', 'value' => $stats['social_media'], 'sub' => null],
            ['label' => 'E-Commerce', 'value' => $stats['ecommerce_links'], 'sub' => null],
        ])
        @foreach($cards as $c)
        <div class="rounded-lg border border-brand-stone/40 bg-white shadow-subtle p-4 flex flex-col">
            <div class="flex items-start justify-between">
                <div class="text-sm tracking-wide text-brand-navy/60 uppercase">{{ $c['label'] }}</div>
            </div>
            <div class="mt-2 text-2xl font-semibold text-brand-navy">{{ $c['value'] }}</div>
            @if($c['sub'])<div class="mt-1 text-xs text-brand-navy/50">{{ $c['sub'] }}</div>@endif
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Products -->
        <div class="lg:col-span-2 rounded-lg border border-brand-stone/40 bg-white shadow-subtle">
            <div class="px-5 py-4 border-b border-brand-stone/30 flex items-center justify-between">
                <h2 class="text-base font-semibold text-brand-navy">Produk Terbaru</h2>
                <a href="{{ route('admin.products.index') }}" class="text-xs text-brand-navy/60 hover:text-brand-gold">Lihat semua</a>
            </div>
            <div class="p-5">
                @if($recent_products->count() > 0)
                <ul class="divide-y divide-brand-stone/30">
                    @foreach($recent_products as $product)
                    <li class="py-3 flex items-center justify-between">
                        <div class="flex items-center gap-3 min-w-0">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->getTranslation('name', app()->getLocale()) }}" class="w-12 h-12 rounded object-cover border border-brand-stone/40">
                            @else
                                <div class="w-12 h-12 rounded bg-brand-sand flex items-center justify-center text-xs text-brand-navy/50">No Img</div>
                            @endif
                            <div class="min-w-0">
                                <div class="font-medium text-brand-navy truncate">{{ $product->getTranslation('name', app()->getLocale()) }}</div>
                                <div class="text-xs text-brand-navy/50">Rp {{ number_format($product->price,0,',','.') }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-xs">
                            @if($product->is_featured)
                                <span class="px-2 py-1 rounded bg-brand-gold/20 text-brand-navy">Unggulan</span>
                            @endif
                            <span class="px-2 py-1 rounded {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-sm text-brand-navy/50 text-center py-6">Belum ada produk.</p>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="rounded-lg border border-brand-stone/40 bg-white shadow-subtle flex flex-col">
            <div class="px-5 py-4 border-b border-brand-stone/30">
                <h2 class="text-base font-semibold text-brand-navy">Aksi Cepat</h2>
            </div>
            <div class="p-5 space-y-3">
                <a href="{{ route('admin.products.create') }}" class="group flex items-center justify-between w-full px-4 py-2 rounded-md border border-brand-stone/40 hover:border-brand-gold hover:bg-brand-gold/5 text-sm font-medium text-brand-navy transition">
                    <span>Tambah Produk</span>
                    <span class="text-brand-gold group-hover:scale-110 transition">＋</span>
                </a>
                <a href="{{ route('admin.news.create') }}" class="group flex items-center justify-between w-full px-4 py-2 rounded-md border border-brand-stone/40 hover:border-brand-gold hover:bg-brand-gold/5 text-sm font-medium text-brand-navy transition">
                    <span>Tambah News</span>
                    <span class="text-brand-gold group-hover:scale-110 transition">＋</span>
                </a>
                <a href="{{ route('admin.social-media.create') }}" class="group flex items-center justify-between w-full px-4 py-2 rounded-md border border-brand-stone/40 hover:border-brand-gold hover:bg-brand-gold/5 text-sm font-medium text-brand-navy transition">
                    <span>Tambah Social Media</span>
                    <span class="text-brand-gold group-hover:scale-110 transition">＋</span>
                </a>
                <a href="{{ route('admin.ecommerce-links.create') }}" class="group flex items-center justify-between w-full px-4 py-2 rounded-md border border-brand-stone/40 hover:border-brand-gold hover:bg-brand-gold/5 text-sm font-medium text-brand-navy transition">
                    <span>Tambah E-Commerce Link</span>
                    <span class="text-brand-gold group-hover:scale-110 transition">＋</span>
                </a>
                <a href="{{ route('admin.contact-messages.index') }}" class="group flex items-center justify-between w-full px-4 py-2 rounded-md border border-brand-stone/40 hover:border-brand-gold hover:bg-brand-gold/5 text-sm font-medium text-brand-navy transition">
                    <span>Pesan Masuk</span>
                    <span class="text-brand-gold group-hover:scale-110 transition">→</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="group flex items-center justify-between w-full px-4 py-2 rounded-md border border-brand-stone/40 hover:border-brand-gold hover:bg-brand-gold/5 text-sm font-medium text-brand-navy transition">
                    <span>Preview Website</span>
                    <span class="text-brand-gold group-hover:scale-110 transition">↗</span>
                </a>
            </div>
            <div class="mt-auto px-5 py-4 border-t border-brand-stone/30 text-xs text-brand-navy/60 space-y-1">
                <div class="flex items-center justify-between"><span>Media Sosial</span><span class="font-medium text-brand-navy">{{ $stats['social_media'] }}</span></div>
                <div class="flex items-center justify-between"><span>E-Commerce</span><span class="font-medium text-brand-navy">{{ $stats['ecommerce_links'] }}</span></div>
            </div>
        </div>
    </div>
</div>

@endsection

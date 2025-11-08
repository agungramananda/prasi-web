@extends('layouts.app')

@section('title', __('Tentang Kami'))

@section('content')

<section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <h1 class="text-3xl md:text-4xl font-semibold text-brand-navy">{{ __('Tentang Prasi') }}</h1>
        <div class="mt-2 h-0.5 w-16 bg-brand-gold"></div>
    <p class="mt-4 text-brand-navy/70 max-w-3xl">{{ __('Suvenir Khas Bali Berbahan Dasar Daun Lontar') }}</p>
    </div>
</section>

<section class="py-16 bg-brand-sand">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="relative">
                    <div class="relative rounded-xl border border-brand-stone bg-white p-8 shadow-subtle">
                        <div class="aspect-square rounded-lg overflow-hidden bg-brand-sand flex items-center justify-center">
                            <img src="{{ asset('images/Prasi.jpg') }}" alt="{{ __('PRASI') }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="order-1 lg:order-2">
                <h2 class="text-3xl md:text-4xl font-semibold text-brand-navy mb-6">{{ __('Cerita Kami') }}</h2>
                <div class="space-y-4 text-brand-navy/80 leading-relaxed">
                    <p>{{ __('Paragraf Cerita 1') }}</p>
                    <p>{{ __('Paragraf Cerita 2') }}</p>
                    <p>{{ __('Paragraf Cerita 3') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-semibold text-brand-navy mb-4">{{ __('Nilai-Nilai Kami') }}</h2>
            <p class="text-brand-navy/70 max-w-2xl mx-auto">
                {{ __('Prinsip yang memandu setiap langkah kami dalam melestarikan budaya Bali') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Value 1 -->
            <div class="group bg-white rounded-lg border border-brand-stone p-8 shadow-subtle hover:shadow-elevated transition">
                <div class="w-14 h-14 rounded-md bg-brand-sand flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-brand-navy mb-2 group-hover:text-brand-gold transition-colors">
                    {{ __('Keaslian Terjamin') }}
                </h3>
                <p class="text-brand-navy/70 leading-relaxed">
                    {{ __('Setiap produk adalah 100% autentik, dibuat langsung oleh pengrajin lokal Bali dengan teknik tradisional yang telah diwariskan turun-temurun.') }}
                </p>
            </div>

            <!-- Value 2 -->
            <div class="group bg-white rounded-lg border border-brand-stone p-8 shadow-subtle hover:shadow-elevated transition">
                <div class="w-14 h-14 rounded-md bg-brand-sand flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-brand-navy mb-2 group-hover:text-brand-gold transition-colors">
                    {{ __('Pemberdayaan Lokal') }}
                </h3>
                <p class="text-brand-navy/70 leading-relaxed">
                    {{ __('Kami berkomitmen mendukung ekonomi lokal dengan memberikan kompensasi yang adil dan berkelanjutan kepada setiap pengrajin yang bermitra dengan kami.') }}
                </p>
            </div>

            <!-- Value 3 -->
            <div class="group bg-white rounded-lg border border-brand-stone p-8 shadow-subtle hover:shadow-elevated transition">
                <div class="w-14 h-14 rounded-md bg-brand-sand flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-brand-navy mb-2 group-hover:text-brand-gold transition-colors">
                    {{ __('Pelestarian Budaya') }}
                </h3>
                <p class="text-brand-navy/70 leading-relaxed">
                    {{ __('Melestarikan warisan budaya Bali adalah misi utama kami. Setiap pembelian Anda turut berkontribusi dalam menjaga tradisi tetap hidup.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Mission Section -->
<section class="py-16 bg-brand-sand">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="rounded-xl border border-brand-stone bg-white p-10 text-center shadow-subtle">
                <h2 class="text-3xl md:text-4xl font-semibold text-brand-navy mb-6">{{ __('Misi Kami') }}</h2>
                <p class="text-brand-navy/80 text-lg leading-relaxed mb-6">{{ __('"Menjadi Pelopor Karya Kreatif Berbasis Seni Prasi Bali yang Inovatif, Berdaya Saing Global  dan Tetap Menjaga Nilai Luhur Budaya Lokal sebagai Identitas Bangsa."') }}</p>
                <div class="mx-auto h-0.5 w-16 bg-brand-gold"></div>
            </div>
        </div>
    </div>
</section>

<!-- Our Team -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-semibold text-brand-navy mb-4">{{ __('Tim Kami') }}</h2>
            <p class="text-brand-navy/70 max-w-2xl mx-auto">{{ __('Kenalan dengan tim di balik Prasi.') }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center bg-white rounded-lg border border-brand-stone p-6 shadow-subtle">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/31.png') }}" alt="Darmika Susilawati" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-brand-navy">Darmika Susilawati</h3>
                <p class="text-sm text-brand-navy/70 mb-3">{{ __('CHIEF EXECUTIVE OFFICER') }}</p>
            </div>

            <div class="text-center bg-white rounded-lg border border-brand-stone p-6 shadow-subtle">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/32.png') }}" alt="Bima Kumara Dwi Atmaja, S.H., M.H" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-brand-navy">Bima Kumara Dwi Atmaja, S.H., M.H</h3>
                <p class="text-sm text-brand-navy/70 mb-3">{{ __('PROJECT SUVERVISOR') }}</p>
            </div>

            <div class="text-center bg-white rounded-lg border border-brand-stone p-6 shadow-subtle">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/33.png') }}" alt="Rama Yatranajaya" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-brand-navy">Rama Yatranajaya</h3>
                <p class="text-sm text-brand-navy/70 mb-3">{{ __('CHIEF OPERATING OFFICER') }}</p>
            </div>

            <div class="text-center bg-white rounded-lg border border-brand-stone p-6 shadow-subtle">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/34.png') }}" alt="Wayan Nia" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-brand-navy">Wayan Nia</h3>
                <p class="text-sm text-brand-navy/70 mb-3">{{ __('CHIEF FINANCIAL OFFICER') }}</p>
            </div>

            <div class="text-center bg-white rounded-lg border border-brand-stone p-6 shadow-subtle">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/35.png') }}" alt="Devabhrata" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-brand-navy">Devabhrata</h3>
                <p class="text-sm text-brand-navy/70 mb-3">{{ __('CHIEF MARKETING OFFICER') }}</p>
            </div>

            <div class="text-center bg-white rounded-lg border border-brand-stone p-6 shadow-subtle">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4">
                    <img src="{{ asset('images/36.png') }}" alt="Ngakan Arta" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-brand-navy">Ngakan Arta</h3>
                <p class="text-sm text-brand-navy/70 mb-3">{{ __('CHIEF HUMAN & RISK OFFICER') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- How We Work Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-semibold text-brand-navy mb-4">{{ __('Bagaimana Kami Bekerja') }}</h2>
            <p class="text-brand-navy/70 max-w-2xl mx-auto">{{ __('Proses sederhana kami memastikan kualitas, keberlanjutan, dan pelestarian budaya') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center p-6 bg-white rounded-lg border border-brand-stone shadow-subtle">
                <div class="mx-auto w-14 h-14 rounded-md bg-brand-sand flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l6 6-6 6M21 7l-6 6 6 6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-brand-navy mb-2">{{ __('Rancangan & Konsep') }}</h3>
                <p class="text-sm text-brand-navy/70">{{ __('Kami mulai dari ide yang menghormati tradisi lokal dan kebutuhan pasar modern.') }}</p>
            </div>

            <div class="text-center p-6 bg-white rounded-lg border border-brand-stone shadow-subtle">
                <div class="mx-auto w-14 h-14 rounded-md bg-brand-sand flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-brand-navy mb-2">{{ __('Sumber Bahan Lokal') }}</h3>
                <p class="text-sm text-brand-navy/70">{{ __('Bahan dipilih dari sumber berkelanjutan untuk menjaga lingkungan dan nilai budaya.') }}</p>
            </div>

            <div class="text-center p-6 bg-white rounded-lg border border-brand-stone shadow-subtle">
                <div class="mx-auto w-14 h-14 rounded-md bg-brand-sand flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 20h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-brand-navy mb-2">{{ __('Kerajinan oleh Pengrajin') }}</h3>
                <p class="text-sm text-brand-navy/70">{{ __('Dikerjakan tangan oleh pengrajin berpengalaman yang menjaga teknik tradisional.') }}</p>
            </div>

            <div class="text-center p-6 bg-white rounded-lg border border-brand-stone shadow-subtle">
                <div class="mx-auto w-14 h-14 rounded-md bg-brand-sand flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-brand-navy mb-2">{{ __('Pengiriman & Dukungan') }}</h3>
                <p class="text-sm text-brand-navy/70">{{ __('Pengiriman dapat diandalkan, dengan layanan pelanggan yang siap membantu setiap saat.') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-brand-sand">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-semibold text-brand-navy mb-6">{{ __('Bergabung dalam Misi Kami') }}</h2>
            <p class="text-brand-navy/70 text-lg mb-8">
                {{ __('Setiap produk yang Anda beli membantu melestarikan budaya Bali') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products') }}" class="px-8 py-3 bg-brand-gold text-brand-navy font-semibold rounded-md shadow-subtle hover:shadow-elevated transition">
                    {{ __('Lihat Produk Kami') }}
                </a>
                <a href="{{ route('contact') }}" class="px-8 py-3 border border-brand-stone text-brand-navy rounded-md hover:border-brand-gold hover:text-brand-gold transition">
                    {{ __('Hubungi Kami') }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

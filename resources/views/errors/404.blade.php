@extends('layouts.app')

@section('title', '404 - ' . __('Halaman Tidak Ditemukan'))

@section('content')

<section class="min-h-screen flex items-center justify-center py-16 px-6">
    <div class="max-w-4xl mx-auto text-center">
        
        <!-- 404 Illustration -->
        <div class="relative mb-8">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-64 h-64 bg-gradient-to-br from-[#D4AF37]/20 to-[#F4E4B7]/20 rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative">
                <!-- Large 404 Number -->
                <div class="text-9xl md:text-[12rem] font-bold bg-gradient-to-r from-[#0B1E3D] to-[#1a3a5c] bg-clip-text text-transparent mb-4">
                    404
                </div>
                
                <!-- Decorative Elements -->
                <div class="flex items-center justify-center space-x-4 mb-8">
                    <div class="w-12 h-0.5 bg-gradient-to-r from-transparent to-[#D4AF37]"></div>
                    <span class="text-[#D4AF37] text-2xl">❋</span>
                    <div class="w-12 h-0.5 bg-gradient-to-l from-transparent to-[#D4AF37]"></div>
                </div>
            </div>
        </div>

        <!-- Error Message -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-[#0B1E3D] mb-4">
                {{ __('Halaman Tidak Ditemukan') }}
            </h1>
            <p class="text-lg text-gray-600 mb-2">
                {{ __('Maaf, halaman yang Anda cari tidak dapat ditemukan.') }}
            </p>
            <p class="text-gray-500">
                {{ __('Mungkin halaman telah dipindahkan atau URL yang Anda masukkan salah.') }}
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="{{ route('home') }}" 
               class="px-8 py-4 bg-gradient-to-r from-[#D4AF37] to-[#F4E4B7] text-[#0B1E3D] font-semibold rounded-lg 
                      hover:from-[#F4E4B7] hover:to-[#D4AF37] transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    {{ __('Kembali ke Beranda') }}
                </span>
            </a>
            <a href="{{ route('products') }}" 
               class="px-8 py-4 bg-[#0B1E3D] text-white font-semibold rounded-lg 
                      hover:bg-[#1a3a5c] transition-all duration-300 shadow-lg transform hover:-translate-y-1">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    {{ __('Lihat Produk') }}
                </span>
            </a>
        </div>

        <!-- Quick Links -->
        <div class="border-t border-gray-200 pt-8">
            <p class="text-sm text-gray-600 mb-4">{{ __('Atau jelajahi halaman lainnya:') }}</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('about') }}" class="text-[#D4AF37] hover:text-[#0B1E3D] font-medium transition-colors">
                    {{ __('Tentang Kami') }}
                </a>
                <span class="text-gray-300">•</span>
                <a href="{{ route('contact') }}" class="text-[#D4AF37] hover:text-[#0B1E3D] font-medium transition-colors">
                    {{ __('Hubungi Kami') }}
                </a>
                @if($socialMedia->count() > 0)
                <span class="text-gray-300">•</span>
                <a href="{{ $socialMedia->first()->url }}" target="_blank" class="text-[#D4AF37] hover:text-[#0B1E3D] font-medium transition-colors">
                    {{ __('Media Sosial') }}
                </a>
                @endif
            </div>
        </div>

    </div>
</section>

@endsection

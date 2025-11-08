@extends('layouts.app')

@section('title', __('Hubungi Kami'))

@section('content')

<!-- Page Header (minimal) -->
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <h1 class="text-3xl md:text-4xl font-semibold text-brand-navy">{{ __('Hubungi Kami') }}</h1>
        <div class="mt-2 h-0.5 w-16 bg-brand-gold"></div>
    <p class="mt-4 text-brand-navy/70 max-w-3xl">{{ __('Ada pertanyaan atau kolaborasi? Tim kami siap membantu.') }}</p>
    </div>
</section>

<!-- Contact Content -->
<section class="py-16 bg-brand-sand">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Contact Information -->
            <div>
                <h2 class="text-2xl md:text-3xl font-semibold text-brand-navy mb-6">{{ __('Informasi Kontak') }}</h2>
                <p class="text-brand-navy/70 mb-8">
                    {{ __('Hubungi kami melalui salah satu channel di bawah ini. Tim kami akan dengan senang hati membantu Anda.') }}
                </p>

                <div class="space-y-6">
                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-md bg-white border border-brand-stone flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-brand-navy mb-1">{{ __('Email') }}</h3>
                            <a href="mailto:p2mw.prasi@gmail.com" class="text-brand-navy/70 hover:text-brand-gold transition-colors">
                                p2mw.prasi@gmail.com
                            </a>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-md bg-white border border-brand-stone flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-brand-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-brand-navy mb-1">{{ __('Telepon') }}</h3>
                            <a href="tel:+6281222818271" class="text-brand-navy/70 hover:text-brand-gold transition-colors">
                                +62 812-2281-8271
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                @if($socialMedia->count() > 0)
                <div class="mt-12">
                    <h3 class="font-semibold text-brand-navy mb-4">{{ __('Ikuti Kami') }}</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($socialMedia as $social)
                        <a href="{{ $social->url }}" target="_blank"
                           class="flex items-center px-4 py-2 bg-white border border-brand-stone rounded-md hover:border-brand-gold hover:text-brand-gold transition">
                            <span class="font-medium">{{ $social->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- E-commerce Links -->
                @if($ecommerceLinks->count() > 0)
                <div class="mt-8">
                    <h3 class="font-semibold text-brand-navy mb-4">{{ __('Toko Online Kami') }}</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($ecommerceLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" class="flex items-center px-4 py-2 bg-white border border-brand-stone rounded-md hover:border-brand-gold transition">
                            <span class="text-brand-navy">{{ $link->platform }}</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-lg border border-brand-stone shadow-subtle p-8">
                <h2 class="text-2xl font-semibold text-brand-navy mb-6">{{ __('Kirim Pesan') }}</h2>
                
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    @if (session('status'))
                        <div class="p-4 rounded-md bg-green-100 text-green-800 text-sm">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="p-4 rounded-md bg-red-100 text-red-800 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <!-- Honeypot field: keep it hidden from users -->
                    <div class="hidden" aria-hidden="true">
                        <label for="website">Website</label>
                        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                    </div>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-brand-navy mb-2">{{ __('Nama Lengkap *') }}</label>
               <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border border-brand-stone rounded-md focus:ring-2 focus:ring-brand-gold focus:border-transparent">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-brand-navy mb-2">{{ __('Email *') }}</label>
               <input type="email" name="email" id="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border border-brand-stone rounded-md focus:ring-2 focus:ring-brand-gold focus:border-transparent">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-brand-navy mb-2">{{ __('Telepon') }}</label>
               <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                               class="w-full px-4 py-3 border border-brand-stone rounded-md focus:ring-2 focus:ring-brand-gold focus:border-transparent">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-brand-navy mb-2">{{ __('Subjek *') }}</label>
               <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                               class="w-full px-4 py-3 border border-brand-stone rounded-md focus:ring-2 focus:ring-brand-gold focus:border-transparent">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-brand-navy mb-2">{{ __('Pesan *') }}</label>
                        <textarea name="message" id="message" rows="5" required
                                  class="w-full px-4 py-3 border border-brand-stone rounded-md focus:ring-2 focus:ring-brand-gold focus:border-transparent">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-brand-gold text-brand-navy font-semibold rounded-md shadow-subtle hover:shadow-elevated transition">{{ __('Kirim Pesan') }}</button>
                </form>
            </div>

        </div>
    </div>

    <a href="https://wa.me/6281222818271" target="_blank" rel="noopener noreferrer" aria-label="{{ __('Chat via WhatsApp') }}"
        class="fixed bottom-6 right-6 z-50 bg-[#25D366] hover:bg-[#1ebe57] text-white p-4 rounded-full shadow-lg flex items-center justify-center focus:outline-none focus:ring-4 focus:ring-[#25D366]/30">
        <span class="sr-only">{{ __('Chat via WhatsApp') }}</span>
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
            <path d="M20.52 3.477A11.949 11.949 0 0012 .5C6.21.5 1.5 5.21 1.5 11c0 1.936.5 3.754 1.446 5.369L.5 23.5l7.329-2.026A11.95 11.95 0 0012 22.5c5.79 0 10.5-4.71 10.5-10.5 0-3.02-1.162-5.797-3.98-8.523z" stroke="none" fill="white"/>
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.472-.148-.672.15-.198.297-.766.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.255-.462-2.39-1.48-.885-.788-1.48-1.761-1.653-2.058-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.173.198-.297.298-.495.099-.198.033-.372-.016-.52-.05-.149-.672-1.612-.921-2.206-.243-.579-.49-.5-.672-.51l-.573-.01c-.198 0-.52.074-.793.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.076c.149.198 2.095 3.2 5.076 4.487 3.55 1.7 3.55 1.134 4.19 1.064.132-.02.855-.35.977-.69.123-.347.123-.644.086-.69-.036-.044-.273-.149-.57-.297z" stroke="none" fill="#075e54"/>
        </svg>
    </a>
</section>

@endsection

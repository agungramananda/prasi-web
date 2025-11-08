@props([
    'title' => null,
    'subtitle' => null,
    'actions' => null,
])
<div {{ $attributes->merge(['class' => 'p-6 bg-white rounded-lg border border-brand-stone shadow-subtle']) }}>
    @if($title)
        <h3 class="font-medium text-brand-navy">{{ __($title) }}</h3>
    @endif
    @if($subtitle)
        <p class="mt-2 text-sm text-brand-navy/70">{{ __($subtitle) }}</p>
    @endif
    {{ $slot }}
    @if($actions)
        <div class="mt-4">{{ $actions }}</div>
    @endif
</div>

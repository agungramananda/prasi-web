@props([
    'enIds' => '',            // Comma-separated list of EN field input IDs to monitor
    'confirm' => true,        // Whether to show a confirm dialog on submit if EN empty
    'autoCopy' => true,       // Copy ID value into EN field on blur if EN empty
    'copySourceIds' => '',    // Comma-separated list of ID field IDs to watch for auto-copy
    'warningMessage' => 'English translations are empty. Submit anyway?',
])

<div x-data="{ tab: 'id', enEmpty: true }"
     x-init="() => {
                const ids = ($el.dataset.enIds || '').split(',').map(s=>s.trim()).filter(Boolean);
                const srcIds = ($el.dataset.copySourceIds || '').split(',').map(s=>s.trim()).filter(Boolean);
        const check = () => {
            enEmpty = ids.length ? ids.every(id => {
                const el = document.getElementById(id);
                return !el || !el.value || !el.value.trim();
            }) : false;
        };
        check();
        ids.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', check);
                el.addEventListener('blur', check);
                el.addEventListener('change', check);
            }
        });
                if ($el.dataset.autoCopy === 'true') {
                    srcIds.forEach(srcId => {
                        const srcEl = document.getElementById(srcId);
                        if (srcEl) {
                            srcEl.addEventListener('blur', () => {
                                ids.forEach(enId => {
                                    const enEl = document.getElementById(enId);
                                    if (enEl && !enEl.value.trim() && srcEl.value.trim()) {
                                        enEl.value = srcEl.value;
                                        enEl.dispatchEvent(new Event('input'));
                                    }
                                });
                            });
                        }
                    });
                }
        const form = $el.closest('form');
                if (form && $el.dataset.confirm === 'true') {
                    form.addEventListener('submit', (e) => {
                        if (enEmpty) {
                            if (!confirm($el.dataset.warningMessage || 'English translations are empty. Submit anyway?')) {
                                e.preventDefault();
                            }
                        }
                    });
                }
     }"
         data-en-ids="{{ $enIds }}"
         data-copy-source-ids="{{ $copySourceIds }}"
         data-confirm="{{ $confirm ? 'true' : 'false' }}"
         data-auto-copy="{{ $autoCopy ? 'true' : 'false' }}"
         data-warning-message="{{ $warningMessage }}"
     class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex gap-2">
            <button type="button"
                    @click="tab='id'"
                    :class="tab==='id' ? 'bg-brand-gold text-brand-navy' : 'bg-brand-stone/20 text-brand-navy hover:bg-brand-stone/30'"
                    class="px-3 py-1 text-xs font-semibold rounded">Indonesia</button>
            <button type="button"
                    @click="tab='en'"
                    :class="tab==='en' ? 'bg-brand-gold text-brand-navy' : 'bg-brand-stone/20 text-brand-navy hover:bg-brand-stone/30'"
                    class="relative px-3 py-1 text-xs font-semibold rounded">
                English
                <span x-show="enEmpty" class="absolute -top-1 -right-1 h-2 w-2 rounded-full bg-red-500"></span>
            </button>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-500">Isi minimal bahasa Indonesia</span>
            <span x-show="enEmpty" class="text-xs text-red-600">EN empty — fallback active</span>
        </div>
    </div>

    <div x-show="tab==='id'" x-transition>
        {{ $id ?? '' }}
    </div>
    <div x-show="tab==='en'" x-transition>
        {{ $en ?? '' }}
    </div>
</div>

@extends('layouts.admin')

@section('title', __('Edit News'))

@section('content')
<div class="max-w-3xl mx-auto px-4 md:px-8 py-10">
    <h1 class="text-2xl font-semibold text-brand-navy mb-6">{{ __('Edit News') }}</h1>
    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800 text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-brand-stone/60 rounded-lg p-5 space-y-6" x-data="newsForm()" x-init="init('{{ addslashes($news->getTranslation('title','id')) }}','{{ addslashes($news->slug) }}')">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm text-brand-navy/70 mb-2">{{ __('Title') }}</label>
            <x-locale-tabs en-ids="title_en" copy-source-ids="title_id">
                <x-slot name="id">
                    <input id="title_id" type="text" name="title_id" x-model="title" @input="syncSlug()" class="w-full border rounded px-3 py-2" value="{{ old('title_id', $news->getTranslation('title','id')) }}" required />
                </x-slot>
                <x-slot name="en">
                    <input id="title_en" type="text" name="title_en" class="w-full border rounded px-3 py-2" value="{{ old('title_en', $news->getTranslation('title','en')) }}" />
                </x-slot>
            </x-locale-tabs>
        </div>
        <div>
            <label class="block text-sm text-brand-navy/70 mb-1">Slug</label>
            <input type="text" name="slug" x-model="slug" class="w-full border rounded px-3 py-2" value="{{ old('slug', $news->slug) }}" placeholder="{{ __('Otomatis dari judul jika kosong') }}" />
            <p class="mt-1 text-[11px] text-brand-navy/50" x-show="slug">Preview: <span class="font-mono" x-text="slug"></span></p>
        </div>
        <div>
            <label class="block text-sm text-brand-navy/70 mb-1">{{ __('Header Image') }}</label>
            @if($news->header_image_url)
                <img src="{{ $news->header_image_url }}" alt="current" class="mb-2 h-40 w-full object-cover rounded" />
            @endif
            <input type="file" name="header_image" accept="image/*" class="w-full border rounded px-3 py-2" />
        </div>
        <div>
            <label class="block text-sm text-brand-navy/70 mb-2">{{ __('Content') }}</label>
            <x-locale-tabs en-ids="content_en" copy-source-ids="content_id" :confirm="false">
                <x-slot name="id">
                    <input id="content_id" type="hidden" name="content_id" value="{{ old('content_id', $news->getTranslation('content','id')) }}">
                    <trix-editor input="content_id" class="trix-content min-h-[240px] bg-white"></trix-editor>
                </x-slot>
                <x-slot name="en">
                    <input id="content_en" type="hidden" name="content_en" value="{{ old('content_en', $news->getTranslation('content','en')) }}">
                    <trix-editor input="content_en" class="trix-content min-h-[240px] bg-white"></trix-editor>
                </x-slot>
            </x-locale-tabs>
        </div>
        <div>
            <label class="block text-sm text-brand-navy/70 mb-1">{{ __('Tags') }}</label>
            <div x-data="tagInput()" x-init="init('{{ addslashes(old('tags', is_array($news->tags) ? implode(', ', $news->tags) : '')) }}')" class="border rounded px-2 py-2 flex flex-wrap gap-2">
                <template x-for="(t,i) in tags" :key="i">
                    <span class="flex items-center gap-1 bg-brand-gold/20 text-brand-navy text-xs px-2 py-1 rounded">
                        <span>#<span x-text="t"></span></span>
                        <button type="button" @click="remove(i)" class="text-brand-navy/50 hover:text-red-600">×</button>
                    </span>
                </template>
                <input x-ref="input" @keydown.enter.prevent="add()" @keydown.tab.prevent="add()" placeholder="{{ __('Tambah tag lalu Enter') }}" class="flex-1 min-w-[120px] px-2 py-1 text-sm focus:outline-none" />
                <input type="hidden" name="tags" :value="tags.join(', ')" />
            </div>
            <p class="mt-1 text-[11px] text-brand-navy/50">{{ __('Gunakan huruf, angka, tanda hubung. Enter untuk menambah.') }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" id="is_active" {{ $news->is_active ? 'checked' : '' }} />
                <label for="is_active">{{ __('Is Active') }}</label>
            </div>
            <!-- Published At removed: updates will set published_at to now() (publish immediately) -->
            <div></div>
        </div>
        <div>
            <button class="px-5 py-2 rounded-md bg-brand-gold text-brand-navy font-medium">{{ __('Update') }}</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css" />
@endpush
@push('scripts')
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<script>
function slugify(text){return text.toString().toLowerCase().trim().replace(/[^a-z0-9\-\s]/g,'').replace(/\s+/g,'-').replace(/\-+/g,'-');}
function newsForm(){return {title:'', slug:'', init(t,s){ this.title=t; this.slug=s; }, syncSlug(){ if(!this.slug || this.slug === slugify(this.title)) { this.slug = slugify(this.title); } }} }
function tagInput(){return {tags:[], init(initial){ if(initial){ this.tags = initial.split(',').map(t=>t.trim()).filter(Boolean); } }, add(){ const val=this.$refs.input.value.trim().replace(/^#/,''); if(!val) return; if(!/^[a-zA-Z0-9\-]+$/.test(val)) { this.$refs.input.value=''; return; } if(!this.tags.includes(val)) this.tags.push(val); this.$refs.input.value=''; }, remove(i){ this.tags.splice(i,1); } } }
</script>
@endpush

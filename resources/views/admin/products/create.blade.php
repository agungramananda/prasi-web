@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk Baru')

@section('content')

<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                
                <!-- Translations: Tabbed via component -->
                <x-locale-tabs en-ids="name_en,description_en">
                    <x-slot:id>
                        <label for="name_id" class="block text-sm font-medium text-gray-700">Nama Produk (ID) *</label>
                        <input type="text" name="name[id]" id="name_id" value="{{ old('name.id') }}" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-gold focus:border-transparent @error('name.id') border-red-500 @enderror">
                        @error('name.id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        <label for="description_id" class="block text-sm font-medium text-gray-700 mt-5">Deskripsi (ID) *</label>
                        <textarea name="description[id]" id="description_id" rows="4" required class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-gold focus:border-transparent @error('description.id') border-red-500 @enderror">{{ old('description.id') }}</textarea>
                        @error('description.id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </x-slot:id>
                    <x-slot:en>
                        <label for="name_en" class="block text-sm font-medium text-gray-700">Nama Produk (EN)</label>
                        <input type="text" name="name[en]" id="name_en" value="{{ old('name.en') }}" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-gold focus:border-transparent @error('name.en') border-red-500 @enderror">
                        @error('name.en')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        <label for="description_en" class="block text-sm font-medium text-gray-700 mt-5">Deskripsi (EN)</label>
                        <textarea name="description[en]" id="description_en" rows="4" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-gold focus:border-transparent @error('description.en') border-red-500 @enderror">{{ old('description.en') }}</textarea>
                        @error('description.en')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </x-slot:en>
                </x-locale-tabs>

                <!-- Price & Category -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) *</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent @error('price') border-red-500 @enderror">
                        @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <input type="text" name="category" id="category" value="{{ old('category') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent @error('category') border-red-500 @enderror">
                        @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#D4AF37] focus:border-transparent @error('image') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF (Max: 2MB)</p>
                    @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Checkboxes -->
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="w-4 h-4 text-[#D4AF37] border-gray-300 rounded focus:ring-[#D4AF37]">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                            Jadikan Produk Unggulan
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-4 h-4 text-[#D4AF37] border-gray-300 rounded focus:ring-[#D4AF37]">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Aktifkan Produk
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-[#D4AF37] to-[#F4E4B7] text-[#0B1E3D] font-semibold rounded-lg hover:from-[#F4E4B7] hover:to-[#D4AF37] transition-all">
                        Simpan Produk
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
